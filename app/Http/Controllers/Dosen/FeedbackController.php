<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Lecturer;
use App\Models\Periode;
use App\Models\Reply;
use App\Notifications\ReplyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $dosenId = auth()->id();
        $feedback = Feedback::with([
            'category', 'class', 'user', 'reply'
        ])->whereHas('class', function($query) use ($dosenId){
            $query->whereHas('lecturer', function($query) use ($dosenId){
                $query->where('id', $dosenId);
            });
        })->get();

        // dd($feedback);

        $wait = Feedback::where('status', 'sent')->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })->get();
        $read = Feedback::where('status', 'read')->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })->get();
        $process = Feedback::where('status', 'response')->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })->get();
        $done = Feedback::where('status', 'done')->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })->get();
        
        $category = Category::where('for', 'feedback')->get();

        $sortBy = $request->get('sort');

        if($sortBy === 'latest'){
            $feedback = Feedback::orderBy('created_at', 'desc')->whereHas('class.lecturer', function($query) use ($dosenId){
                $query->where('id', $dosenId);
            })->get();
        } 
        elseif($sortBy === 'oldest') {
            $feedback = Feedback::orderBy('created_at', 'asc')->whereHas('class.lecturer', function($query) use ($dosenId){
                $query->where('id', $dosenId);
            })->get();
        } else {
            $feedback = Feedback::orderBy('created_at', 'desc')->whereHas('class.lecturer', function($query) use ($dosenId){
                $query->where('id', $dosenId);
            })->get();
        }


        $listPeriod = Periode::all();
        // dd($periodeData);
        $sortByPeriod = $request->get('period');

        $periode = DB::table('period')->where('periode', $sortByPeriod)->first();

        if($periode)
        {
            $feedback = Feedback::whereBetween('created_at', [$periode->periode_start, $periode->periode_end])->get();
            dd($feedback);
        } 
        else
        {
            //
        }         
        // dd($periodeData);
        // dd($periode['periode']);

        return view('dosen.feedback.index', [
            'feedback' => $feedback,
            'wait' => $wait,
            'read' => $read,
            'process' => $process,
            'done' => $done,
            'sortBy' => $sortBy,
            'category' => $category,
            'period' => $listPeriod
        ]);
    }

    public function byCategory(Request $request, $categoryName)
    {
        $dosenId = Auth::id();
        $category = Category::where('name', $categoryName)->firstOrFail();
        // dd($category);
        $listCategory = Category::where('for', 'feedback')->get();

        $feedback = Feedback::where('category_id', $category->id)->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })->get();

        // dd($feedback);

        // dd($feedback);
        $wait = $feedback->where('status', 'sent')->values();
        $read = $feedback->where('status', 'read')->values();
        $process = $feedback->where('status', 'response')->values();
        $done = $feedback->where('status', 'done')->values();

        $listCategory = Category::where('for', 'feedback')->get();

        $periode = Periode::all();

        $sortBy = $request->get('sort');

        if($sortBy === 'latest'){
            $feedback = Feedback::orderBy('created_at', 'desc')->where('category_id', $category->id)->where('user_id', auth()->id())->get();
        } 
        elseif($sortBy === 'oldest') {
            $feedback = Feedback::orderBy('created_at', 'asc')->where('category_id', $category->id)->where('user_id', auth()->id())->get();
        } else {
            $feedback = Feedback::orderBy('created_at', 'desc')->where('category_id', $category->id)->where('user_id', auth()->id())->get();
        }

        return view('dosen.feedback.filter.filter', [
            'feedback' => $feedback,
            'wait' => $wait,
            'read' => $read,
            'process' => $process,
            'done' => $done,
            'category' => $listCategory,
            'categoryName' => $category,
            'period' => $periode
        ]);
    }

    public function detail($id)
    {

        $feedback = Feedback::with([
            'user', 'category', 'class', 'reply'
        ])
        ->findOrFail($id);
        
        // dd($reply_dosen);
        
        $feedback->date = now();
        
        if($feedback->status == 'sent'){
            $feedback->status = 'read';
        }

        $feedback->save();

        return view('dosen.feedback.detail.detail2', [
            'feedback' => $feedback,
        ]);
    }

    public function l_send_reply(ReplyRequest $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        $data = $request->all();

        $data['feedback_id'] = $feedback->id;

        $feedback->status = 'response';

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = $file->getClientOriginalName();

            $path = $file->storeAs('replies', $filename, 'public');

            $data['attachment'] = $path;
        }

        Reply::create($data);

        // dd($reply);
        $feedback->save();

        $feedback->user->notify(new ReplyNotification($feedback));

        // dd($rep);

        return redirect()->route('lecturer.feedback.detail', $id);
    }


}

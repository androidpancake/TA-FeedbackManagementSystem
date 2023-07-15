<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Reply;
use App\Notifications\LabReplyNotification;
use App\Notifications\ReplyLabNotification;
use App\Notifications\ReplyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $labId = Auth::id();
        $feedback = Feedback::with([
            'category', 'class', 'user', 'reply'
        ])->whereHas('class.lab', function($query) use ($labId){
            $query->where('id', $labId);
        })
        ->get();

        // dd($feedback);


        $wait = Feedback::where('status', 'sent')->whereHas('class.lab', function($query) use ($labId){
            $query->where('id', $labId);
        })->get();
        $read = Feedback::where('status', 'read')->whereHas('class.lab', function($query) use ($labId){
            $query->where('id', $labId);
        })->get();
        $process = Feedback::where('status', 'response')->whereHas('class.lab', function($query) use ($labId){
            $query->where('id', $labId);
        })->get();
        $done = Feedback::where('status', 'done')->whereHas('class.lab', function($query) use ($labId){
            $query->where('id', $labId);
        })->get();
        
        // dd($process);

        $sortBy = $request->get('sort');

        if($sortBy === 'latest'){
            $feedback = Feedback::orderBy('created_at', 'desc')->whereHas('class.lecturer', function($query) use ($labId){
                $query->where('id', $labId);
            })->get();
        }
        elseif($sortBy === 'oldest') {
            $feedback = Feedback::orderBy('created_at', 'asc')->whereHas('class.lecturer', function($query) use ($labId){
                $query->where('id', $labId);
            })->get();
        } else {
            $feedback = Feedback::orderBy('created_at', 'desc')->whereHas('class.lecturer', function($query) use ($labId){
                $query->where('id', $labId);
            })->get();
        }

        $category = Category::where('for', 'feedback')->get();

        return view('lab.feedback.index', [
            'feedback' => $feedback,
            'wait' => $wait,
            'read' => $read,
            'process' => $process,
            'done' => $done,
            'sortBy' => $sortBy,
            'category' => $category
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

        return view('lab.feedback.detail', [
            'feedback' => $feedback,
        ]);
    }

    public function lab_send_reply(ReplyRequest $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        $data = $request->all();

        $data['feedback_id'] = $feedback->id;

        $feedback->status = 'response';

        Reply::create($data);

        // dd($reply);
        $feedback->save();

        $feedback->user->notify(new ReplyLabNotification($feedback));

        // dd($feedback);

        return redirect()->route('lab.feedback.detail', $id);
    }
}

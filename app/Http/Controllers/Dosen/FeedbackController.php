<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use App\Models\Feedback;
use App\Models\Lecturer;
use App\Models\Reply;
use App\Notifications\ReplyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class FeedbackController extends Controller
{
    public function index(Request $request, $dosenId)
    {
        $dosen = Lecturer::findOrFail(auth()->id());

        // dd($dosen->id);
        // $feedback = Feedback::with([
        //     'user', 'category', 'class'
        // ])->where('feedback','feedback.class_id', '=', 'class.lecturer_id', '=', $dosen)->get();
        

        $feedbacks = Feedback::with([
            'category', 'class', 'user'
        ])->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })

        // dd($feedbacks);
        // ->join('class', 'feedback.class_id', '=', 'class.id')
        // ->where('class.lecturer_id', '=', $dosen->id)
        // ->join('users', 'feedback.user_id', '=', 'users.id')
        // ->where('lecturer.id', '=', $dosen->id)
        // ->select('feedback.*')
        ->get();

        // dd(count($feedbacks));
    
        // dd($feedbacks);

        $wait = Feedback::where('status', 'sent')->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })->get();
        $read = Feedback::where('status', 'read')->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })->get();
        $done = Feedback::where('status', 'done')->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })->get();

        $sortBy = $request->get('sort');

        if($sortBy === 'latest'){
            $feedbacks = Feedback::orderBy('created_at', 'desc')->where('user_id', auth()->id())->get();
        } 
        elseif($sortBy === 'oldest') {
            $feedbacks = Feedback::orderBy('created_at', 'asc')->where('user_id', auth()->id())->get();
        } else {
            $feedbacks = Feedback::orderBy('created_at', 'desc')->where('user_id', auth()->id())->get();
        }

        return view('dosen.feedback.index', [
            'feedback' => $feedbacks,
            'wait' => $wait,
            'read' => $read,
            'done' => $done,
            'sortBy' => $sortBy
        ]);
    }

    public function detail($id)
    {
        // $dosen = Reply::join('lecturer','replies.lecturer_id','=','lecturer.id')
        // ->where('lecturer.lecturer')
        // ->select('lecturer.name');

        // dd($dosen);

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

        return view('dosen.feedback.detail.detail', [
            'feedback' => $feedback,
        ]);
    }

    public function l_send_reply(ReplyRequest $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        $data = $request->all();

        $data['feedback_id'] = $feedback->id;

        $feedback->status = 'response';

        Reply::create($data);

        // dd($reply);
        $feedback->save();

        $feedback->user->notify(new ReplyNotification($feedback));

        // dd($feedback);

        return redirect()->route('lecturer.feedback.detail', $id);
    }


}

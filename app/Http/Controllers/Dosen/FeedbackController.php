<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use App\Models\Feedback;
use App\Models\Lecturer;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function index($dosenId)
    {
        $dosen = Lecturer::findOrFail(auth()->id());

        // dd($dosen->id);
        // $feedback = Feedback::with([
        //     'user', 'category', 'class'
        // ])->where('feedback','feedback.class_id', '=', 'class.lecturer_id', '=', $dosen)->get();
        
        // dd($feedback);

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

        // dd($feedbacks);
    
        // dd($feedbacks);

        return view('dosen.feedback.index', [
            'feedback' => $feedbacks
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
        
        // dd($feedback->reply);
        // dd($reply_dosen);
        
        $feedback->date = now();
        
        if($feedback->status != 'done'){
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

        $feedback->save();

        // dd($feedback);

        return redirect()->route('lecturer.feedback.detail', $id);
    }


}

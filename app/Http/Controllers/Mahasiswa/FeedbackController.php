<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Http\Requests\ReplyRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Lecturer;
use App\Models\LecturerReply;
use App\Models\Reply;
use App\Models\User;
use GrahamCampbell\ResultType\Error;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->id())
        ->get();
        // dd($user->id);

        $feedback = Feedback::with([
            'user', 'class', 'category'
        ])
        // ->where('feedback', 'feedback.class_id','=','mahasiswa_kelas.class_id','=', 'mahasiswa_kelas.user_id', '=', auth()->id())
        ->get();
        // dd($feedback);

        // foreach($feedback as $data){
        //     '<br>' . $data->user->name  . '<br>';
        //     '<br>' . $data->class->name  . '<br>';
        //     '<br>' . $data->category->name  . '<br>';
        // }
        

        // $testdata = Lecturer::with([
        //     'course', 'feedback'
        // ])
        // ->join('lecturer','lecturer.id','=','feedback.lecturer_id')
        // ->where('user_id', auth()->id())->get();
        
        $wait = Feedback::where('status', 'sent')->count();
        $read = Feedback::where('status', 'read')->count();
        $done = Feedback::where('status', 'done')->count();

        return view('mahasiswa.feedback.index', [
            'feedback' => $feedback,
            'wait' => $wait,
            'read' => $read,
            'done' => $done
            // 'test' => $testdata
        ]);
    }

    public function choice(Request $request)
    {
        if($request->input('page') === "dosen"){
            return redirect()->route('mahasiswa.feedback.create.dosen');
        } else {
            return redirect()->route('mahasiswa.feedback.create.lab');
        }
    }

    public function dosen()
    {
        $user = User::find(auth()->id());

        $kelas = $user->class()->get();

        // dd($kelas);

        $category = Category::all();
        
        return view('mahasiswa.feedback.create.dosen.create', [
            'user' => $user,
            'class' => $kelas,
            'category'  => $category
        ]);
    }

    public function lab()
    {
        return view('mahasiswa.feedback.create.lab.create');
    }


    public function store(FeedbackRequest $request)
    {
        $data = $request->all();
        if(empty($request['date'])){
            $data['date'] = now();
        }
        $data['date'] = now();

        if(empty($checkbox)){
            $request['anonymous'] = 0;

        }

        if($request->hasFile('file')){
            $file = $request->file('file');

            $path = $file->store('feedback_files', 'public');

            $data['file'] = $path;
        }
            

        $data['user_id'] = Auth::user()->id;

        Feedback::create($data);


        // dd($data);
        return redirect()->route('mahasiswa.feedback.index');
    }

    public function detail($id)
    {
        // $dosen = Reply::join('lecturer','replies.lecturer_id','=','lecturer.id')
        // ->where('lecturer.lecturer')
        // ->select('lecturer.name');

        // dd($dosen);

        $feedback = Feedback::with([
            'user', 'category', 'class', 'reply'
        ])->findOrFail($id);
        
        // dd($feedback);

        // dd($feedback->lecturer_reply);
        
        // dd($reply_dosen);

        return view('mahasiswa.feedback.detail.detail', [
            'feedback' => $feedback,
        ]);
    }

    public function m_send_reply(ReplyRequest $request, $feedbackId)
    {
        // $reply = new Reply();

        // $reply->feedback_id = $request->feedback_id;
        // $reply->reply = $request->reply;
        // $reply->user_id = $request->user_id;
        // $reply->lecturer_id = $request->lecturer_id;
        // $reply->save();
        $feedback = Feedback::findOrFail($feedbackId);
        $data = $request->all();

        $data['feedback_id'] = $feedback->id;

        Reply::create($data);

        return redirect()->route('mahasiswa.feedback.detail', $feedbackId);
    }

    public function close_feedback($feedbackId)
    {
        $feedback = Feedback::findOrFail($feedbackId);

        $feedback->status = 'done';

        $feedback->save();

        return redirect()->route('mahasiswa.feedback.detail', $feedbackId);
    }

    public function destroy($feedbackId)
    {
        $feedback = Feedback::findOrFail($feedbackId);

        $feedback->delete();

        return redirect()->route('mahasiswa.feedback.index');
    }
}

<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Http\Requests\ReplyRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Lab;
use App\Models\Lecturer;
use App\Models\LecturerReply;
use App\Models\Periode;
use App\Models\Reply;
use App\Models\User;
use App\Notifications\FeedbackDoneNotification;
use App\Notifications\FeedbackNotification;
use App\Notifications\LabReplyNotification;
use App\Notifications\LecturerReplyNotification;
use App\Notifications\ReplyNotification;
use GrahamCampbell\ResultType\Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $feedback = Feedback::with([
            'user',
            'class',
            'category',
            'reply'
        ])
            ->where('user_id', auth()->id())
            ->get();

        // dd($feedback);
        // dd(count($feedback));

        $wait = Feedback::where('status', 'sent')->where('user_id', auth()->id())->get();
        $read = Feedback::where('status', 'read')->where('user_id', auth()->id())->get();
        $process = Feedback::where('status', 'response')->where('user_id', auth()->id())->get();
        $done = Feedback::where('status', 'done')->where('user_id', auth()->id())->get();

        $sortBy = $request->get('sort');

        if ($sortBy === 'latest') {
            $feedback = Feedback::orderBy('created_at', 'desc')->where('user_id', auth()->id())->get();
        } elseif ($sortBy === 'oldest') {
            $feedback = Feedback::orderBy('created_at', 'asc')->where('user_id', auth()->id())->get();
        } else {
            $feedback = Feedback::orderBy('created_at', 'desc')->where('user_id', auth()->id())->get();
        }

        $category = Category::where('for', 'feedback')->get();

        $periode = Periode::all();
        // dd($periode[1]);
        $sortByPeriod = $request->get('periode');

        return view('mahasiswa.feedback.index2', [
            'feedback' => $feedback,
            'wait' => $wait,
            'read' => $read,
            'process' => $process,
            'done' => $done,
            'sortBy' => $sortBy,
            'category' => $category,
            'period' => $periode
            // 'test' => $testdata
        ]);
    }

    public function byCategory(Request $request, $categoryName)
    {
        $category = Category::where('name', $categoryName)->firstOrFail();
        // dd($category);
        $listCategory = Category::where('for', 'feedback')->get();

        $feedback = Feedback::where('category_id', $category->id)->get();

        // dd($feedback);
        $wait = $feedback->where('status', 'sent')->where('user_id', auth()->id())->values();
        $read = $feedback->where('status', 'read')->where('user_id', auth()->id())->values();
        $process = $feedback->where('status', 'response')->where('user_id', auth()->id())->values();
        $done = $feedback->where('status', 'done')->where('user_id', auth()->id())->values();


        $sortBy = $request->get('sort');

        if ($sortBy === 'latest') {
            $feedback = Feedback::orderBy('created_at', 'desc')->where('category_id', $category->id)->where('user_id', auth()->id())->get();
        } elseif ($sortBy === 'oldest') {
            $feedback = Feedback::orderBy('created_at', 'asc')->where('category_id', $category->id)->where('user_id', auth()->id())->get();
        } else {
            $feedback = Feedback::orderBy('created_at', 'desc')->where('category_id', $category->id)->where('user_id', auth()->id())->get();
        }

        return view('mahasiswa.feedback.filter.filter', [
            'feedback' => $feedback,
            'wait' => $wait,
            'read' => $read,
            'process' => $process,
            'done' => $done,
            'category' => $listCategory,
            'categoryName' => $category
        ]);
    }

    public function choice(Request $request)
    {

        if ($request->input('page') === "lab") {
            return redirect()->route('mahasiswa.feedback.create.lab');
        } elseif ($request->input('page') === "dosen") {
            return redirect()->route('mahasiswa.feedback.create.dosen');
        }
        // dd($request->input('page'));


    }

    public function dosen()
    {
        $user = User::find(auth()->id());

        $kelas = $user->class()->whereNotNull('lecturer_id')->get();

        // dd($kelas);

        $category = Category::where('for', 'feedback')->get();

        return view('mahasiswa.feedback.create.dosen.create', [
            'user' => $user,
            'class' => $kelas,
            'category'  => $category
        ]);
    }

    public function lab()
    {
        $user = User::find(auth()->id());

        $kelas = $user->class()->whereNotNull('lab_id')->get();

        // dd($kelas);

        $category = Category::where('for', 'feedback')->get();

        return view('mahasiswa.feedback.create.lab.create', [
            'user' => $user,
            'class' => $kelas,
            'category' => $category
        ]);
    }


    public function store(FeedbackRequest $request)
    {
        $data = $request->all();
        if (empty($request['date'])) {
            $data['date'] = now();
        }
        $data['date'] = now();

        if (empty($checkbox)) {
            $request['anonymous'] = 0;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            $path = $file->storeAs('file', $filename, 'public');

            $data['file'] = $path;
        }


        $user_id = $data['user_id'] = Auth::user()->id;

        if (Feedback::userLimitFeedback($user_id, $data['kelas_id'])) {
            return redirect()->back()->with('error', 'Anda sudah mencapai batas maksimal pengiriman per-hari');
        }

        $feedback = Feedback::create($data);

        $class = $feedback->class;

        if ($class->lecturer) {
            $dosen = Lecturer::find($feedback->class->lecturer->id);
            $dosen->notify(new FeedbackNotification($feedback));
        }
        if ($class->lab) {
            $lab = Lab::find($feedback->class->lab->id);
            $lab->notify(new FeedbackNotification($feedback));
        }

        return redirect()->route('mahasiswa.feedback.index');
    }

    public function detail($id)
    {
        $feedback = Feedback::with([
            'user',
            'category',
            'class',
            'reply'
        ])->findOrFail($id);

        $filename = $feedback->file_name;
        $filesize = $feedback->file_size;
        $fileExtension = $feedback->file_extension;
        // dd($filename);
        return view('mahasiswa.feedback.detail.detail2', [
            'feedback' => $feedback,
            'filename' => $filename,
            'filesize' => $filesize,
            'fileextension' => $fileExtension
        ]);
    }

    public function m_send_reply(ReplyRequest $request, $feedbackId)
    {
        $feedback = Feedback::findOrFail($feedbackId);
        $data = $request->all();

        $data['feedback_id'] = $feedback->id;

        if ($request->hasFile('attachment')) {

            $files = $request->file('attachment');
            $attachment = [];

            foreach ($files as $file)
                $path = $file->store(
                    'replies',
                    'public'
                );
            $attachment[] = [
                'path' => $path,
                'name' => $file->getClientOriginalName()
            ];
        }

        $data['attachment'] = json_encode($attachment);

        Reply::create($data);

        if ($feedback->class->lecturer) {
            $feedback->class->lecturer->notify(new LecturerReplyNotification($feedback));
        }

        if ($feedback->class->lab) {
            $feedback->class->lab->notify(new LabReplyNotification($feedback));
        }

        return redirect()->route('mahasiswa.feedback.detail', $feedbackId);
    }

    public function mahasiswa_reply(ReplyRequest $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        $data = $request->all();

        $data['feedback_id'] = $feedback->id;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = $file->getClientOriginalName();

            $path = $file->storeAs('replies', $filename, 'public');

            $data['attachment'] = $path;
        }



        Reply::create($data);

        if ($feedback->class->lecturer) {
            $feedback->class->lecturer->notify(new LecturerReplyNotification($feedback));
        }

        if ($feedback->class->lab) {
            $feedback->class->lab->notify(new LabReplyNotification($feedback));
        }

        return redirect()->route('mahasiswa.feedback.detail', $id);
    }

    public function close_feedback($feedbackId)
    {
        $feedback = Feedback::findOrFail($feedbackId);

        $feedback->status = 'done';
        $feedback->closed_date = now();

        $feedback->save();

        if ($feedback->class->lecturer) {
            $feedback->class->lecturer->notify(new FeedbackDoneNotification($feedback));
        } elseif ($feedback->class->lab) {
            $feedback->class->lab->notify(new FeedbackDoneNotification($feedback));
        }

        return redirect()->route('mahasiswa.feedback.detail', $feedback->id);
    }

    public function destroy($feedbackId)
    {
        $feedback = Feedback::findOrFail($feedbackId);

        $feedback->delete();

        return redirect()->route('mahasiswa.feedback.index');
    }
}

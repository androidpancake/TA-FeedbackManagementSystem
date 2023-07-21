<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComplainReplyRequest;
use App\Http\Requests\ComplaintRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\complaintReply;
use App\Notifications\complaintDoneNotification;
use App\Notifications\ComplaintNotification;
use App\Notifications\UserComplaintReplyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $complaint = Complaint::with([
            'user', 'category'
        ])
            ->where('user_id', auth()->id())
            ->get();

        $wait = Complaint::where('status', 'sent')->where('user_id', auth()->id())->get();
        $read = Complaint::where('status', 'read')->where('user_id', auth()->id())->get();
        $process = Complaint::where('status', 'process')->where('user_id', auth()->id())->get();
        $done = Complaint::where('status', 'done')->where('user_id', auth()->id())->get();

        $sortBy = $request->get('sort');

        if ($sortBy === 'latest') {
            $complaint = Complaint::orderBy('created_at', 'desc')->where('user_id', auth()->id())->get();
        } elseif ($sortBy === 'oldest') {
            $complaint = Complaint::orderBy('created_at', 'asc')->where('user_id', auth()->id())->get();
        } else {
            $complaint = Complaint::orderBy('created_at', 'desc')->where('user_id', auth()->id())->get();
        }

        $category = Category::where('for', 'complaint')->get();

        return view('mahasiswa.complaint.index', [
            'complaint' => $complaint,
            'wait' => $wait,
            'read' => $read,
            'process' => $process,
            'done' => $done,
            'sortBy' => $sortBy,
            'category' => $category
        ]);
    }

    public function byCategory($categoryName)
    {
        $category = Category::where('name', $categoryName)->firstOrFail();

        $listCategory = Category::where('for', 'complaint')->get();
        // dd($listCategory);
        $complaint = Complaint::where('category_id', $category->id)->get();

        $wait = $complaint->where('status', 'sent')->where('user_id', auth()->id())->values();
        $read = $complaint->where('status', 'read')->where('user_id', auth()->id())->values();
        $process = $complaint->where('status', 'response')->where('user_id', auth()->id())->values();
        $done = $complaint->where('status', 'done')->where('user_id', auth()->id())->values();

        return view('mahasiswa.complaint.filter.filter', [
            'categoryName' => $category,
            'complaint' => $complaint,
            'wait' => $wait,
            'read' => $read,
            'process' => $process,
            'done' => $done,
            'category' => $listCategory
        ]);
    }

    public function create()
    {
        $category = Category::where('for', 'complaint')->get();
        return view('mahasiswa.complaint.create', [
            'category' => $category
        ]);
    }

    public function create_complaint()
    {
        return view('mahasiswa.complaint.create');
    }

    public function store(ComplaintRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            $path = $file->storeAs('complaint_files', $filename, 'public');

            $data['file'] = $path;
            $data['file_size'] = $file->getSize();
        }


        $data['user_id'] = Auth::user()->id;

        $complaint = Complaint::create($data);

        $admins = Admin::all();

        // dd($admins);
        foreach ($admins as $admin) {
            $admin->notify(new ComplaintNotification($complaint));
        }

        return redirect()->route('mahasiswa.complaint.index');
    }

    // public function store2(ComplaintRequest $request)
    // {
    //     $data = $request->all();

    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');

    //         // Mendapatkan ukuran file
    //         $data['file_size'] = $file->getSize();
    //         // Mendapatkan ekstensi/format file
    //         $data['file_extension'] = $file->getClientOriginalExtension();
    //         // Mendapatkan nama file asli
    //         $data['file_name'] = $file->getClientOriginalName();

    //         // Membuat nama file unik untuk penyimpanan
    //         $newFileName = time() . '_' . $data['file_name'];

    //         // Pindahkan file ke direktori penyimpanan
    //         $file->move(public_path('storage/complaint_files'), $newFileName);

    //         $data['file_path'] = 'storage/complaint_files/' . $newFileName;
    //     }


    //     $data['user_id'] = Auth::user()->id;

    //     $complaint = Complaint::create($data);

    //     $admins = Admin::all();

    //     // dd($admins);
    //     foreach ($admins as $admin) {
    //         $admin->notify(new ComplaintNotification($complaint));
    //     }

    //     return redirect()->route('mahasiswa.complaint.index');
    // }


    public function detail($id)
    {
        $complaint = Complaint::with([
            'user', 'category', 'complaint_reply'
        ])->findOrFail($id);

        // dd($complaint);

        return view('mahasiswa.complaint.detail2', [
            'complaint' => $complaint
        ]);
    }

    public function send_complaint_reply(ComplainReplyRequest $request, $complaintId)
    {
        $complaint = Complaint::findOrFail($complaintId);
        $data = $request->all();

        $data['complaint_id'] = $complaint->id;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = $file->getClientOriginalName();

            $path = $file->storeAs('complaint_replies', $filename, 'public');

            $data['attachment'] = $path;
            $data['file_size'] = $file->getSize();
        }

        complaintReply::create($data);
        // dd($complaint->admin);
        $admins = Admin::all();
        foreach ($admins as $admin) {
            $admin->notify(new UserComplaintReplyNotification($complaint));
        }

        return redirect()->route('mahasiswa.complaint.detail', $complaintId);
    }

    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);

        $complaint->delete();

        return redirect()->route('mahasiswa.complaint.index');
    }

    public function done($id)
    {
        $complaint = Complaint::findOrFail($id);

        $complaint->status = 'done';

        $complaint->save();

        $admins = Admin::all();

        foreach ($admins as $admin) {
            $admin->notify(new complaintDoneNotification($complaint));
        }

        return redirect()->route('mahasiswa.complaint.detail', $id);
    }
}

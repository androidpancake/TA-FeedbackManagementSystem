<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComplainReplyRequest;
use App\Http\Requests\ComplaintRequest;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\complaintReply;
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
        $done = Complaint::where('status', 'done')->where('user_id', auth()->id())->get();
        
        $sortBy = $request->get('sort');

        if($sortBy === 'latest'){
            $complaint = Complaint::orderBy('created_at', 'desc')->where('user_id', auth()->id())->get();
        } 
        elseif($sortBy === 'oldest') {
            $complaint = Complaint::orderBy('created_at', 'asc')->where('user_id', auth()->id())->get();
        } else {
            $complaint = Complaint::orderBy('created_at', 'desc')->where('user_id', auth()->id())->get();
        }

        return view('mahasiswa.complaint.index', [
            'complaint' => $complaint,
            'wait' => $wait,
            'read' => $read,
            'done' => $done,
            'sortBy' => $sortBy
        ]);
    }

    public function create()
    {
        $category = Category::whereBetween('id', [6,9])->get();
        return view('mahasiswa.complaint.create', [
            'category' => $category
        ]);
    }

    public function store(ComplaintRequest $request)
    {
        $data = $request->all();

        if($request->hasFile('file')){
            $file = $request->file('file');

            $path = $file->store('complaint_files', 'public');

            $data['file'] = $path;
        }
            

        $data['user_id'] = Auth::user()->id;

        Complaint::create($data);

        return redirect()->route('mahasiswa.complaint.index');

    }

    public function detail($id)
    {
        $complaint = Complaint::with([
            'user', 'category', 'complaint_reply'
        ])->findOrFail($id);

        return view('mahasiswa.complaint.detail', [
            'complaint' => $complaint
        ]);
    }

    public function send_complaint_reply(ComplainReplyRequest $request, $complaintId)
    {
        $complaint = Complaint::findOrFail($complaintId);
        $data = $request->all();

        $data['complaint_id'] = $complaint->id;

        complaintReply::create($data);

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

        return redirect()->route('mahasiswa.complaint.detail', $id);
    }
}

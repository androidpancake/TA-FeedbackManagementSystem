<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComplainReplyRequest;
use App\Models\Complaint;
use App\Models\complaintReply;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $complaint = Complaint::with([
            'category', 'user', 'admin'
        ])->get();
        
        $wait = Complaint::where('status', 'sent')->get();
        $read = Complaint::where('status', 'read')->get();
        $done = Complaint::where('status', 'done')->get();
        
        $sortBy = $request->get('sort');

        if($sortBy === 'latest'){
            $complaint = Complaint::orderBy('created_at', 'desc')->get();
        } 
        elseif($sortBy === 'oldest') {
            $complaint = Complaint::orderBy('created_at', 'asc')->get();
        } else {
            $complaint = Complaint::orderBy('created_at', 'desc')->get();
        }

        return view('admin.complaint.index', [
            'complaint' => $complaint,
            'wait' => $wait,
            'read' => $read,
            'done' => $done,
            'sortBy' => $sortBy
        ]);

    }

    public function detail($id)
    {
        $complaint = Complaint::with([
            'user', 'category', 'admin', 'complaint_reply'
        ])->findOrFail($id);
        
        // dd($complaint->complaint_reply->admin);
        $complaint->date = now();

        if($complaint->status == 'sent'){
            $complaint->status = 'read';
        } 

        $complaint->save();

        return view('admin.complaint.detail', [
            'complaint' => $complaint
        ]);
    }

    public function a_send_complaint_reply(ComplainReplyRequest $request, $complaintId)
    {
        $complaint = Complaint::findOrFail($complaintId);
        $data = $request->all();

        $data['complaint_id'] = $complaint->id;

        $complaint->status = 'response';

        complaintReply::create($data);

        $complaint->save();

        // dd($complaint);

        return redirect()->route('admin.complaint.detail', $complaintId);
    }
}

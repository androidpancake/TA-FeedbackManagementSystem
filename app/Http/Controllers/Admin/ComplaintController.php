<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComplainReplyRequest;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\complaintReply;
use App\Notifications\AdminReplyNotification;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::where('for', 'complaint')->get();
        $complaint = Complaint::with([
            'category', 'user', 'admin', 'complaint_reply'
        ])->get();
        
        $wait = Complaint::where('status', 'sent')->get();
        $read = Complaint::where('status', 'read')->get();
        $process = Complaint::where('status', 'response')->get();
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

        return view('admin.complaint.index2', [
            'complaint' => $complaint,
            'category' => $category,
            'wait' => $wait,
            'read' => $read,
            'process' => $process,
            'done' => $done,
            'sortBy' => $sortBy
        ]);

    }

    public function byCategory(Request $request, $categoryName)
    {
        $category = Category::where('name', $categoryName)->firstOrFail();

        // dd($category);

        $listCategory = Category::where('for', 'complaint')->get();

        $complaint = Complaint::where('category_id', $category->id)->get();
        
        $wait = $complaint->where('status', 'sent')->values();
        $read = $complaint->where('status', 'read')->values();
        $process = $complaint->where('status', 'response')->values();
        $done = $complaint->where('status', 'done')->values();

        $sortBy = $request->get('sort');

        if($sortBy === 'latest'){
            $complaint = Complaint::orderBy('created_at', 'desc')->where('category_id', $category->id)->where('user_id', auth()->id())->get();
        } 
        elseif($sortBy === 'oldest') {
            $complaint = Complaint::orderBy('created_at', 'asc')->where('category_id', $category->id)->where('user_id', auth()->id())->get();
        } else {
            $complaint = Complaint::orderBy('created_at', 'desc')->where('category_id', $category->id)->where('user_id', auth()->id())->get();
        }

        return view('admin.complaint.filter.filter', [
            'category' => $category,
            'listCategory' => $listCategory,
            'complaint' => $complaint,
            'wait' => $wait,
            'read' => $read,
            'process' => $process,
            'done' => $done
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

        return view('admin.complaint.detail2', [
            'complaint' => $complaint
        ]);
    }

    public function a_send_complaint_reply(ComplainReplyRequest $request, $complaintId)
    {
        $complaint = Complaint::findOrFail($complaintId);
        $data = $request->all();

        $data['complaint_id'] = $complaint->id;

        $complaint->status = 'response';

        if($request->hasFile('attachment')){

            $data['attachment'] = $request->file('attachment')->store(
                'complaint_replies', 'public'
            );
        }

        $reply = complaintReply::create($data);

        $complaint->save();

        // dd($reply->admin->name);

        $complaint->user->notify(new AdminReplyNotification($complaint));

        // dd($complaint);

        return redirect()->route('admin.complaint.detail', $complaintId);
    }
}

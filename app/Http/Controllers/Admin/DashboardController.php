<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $recentComplaint =  Complaint::with([
            'category', 'user', 'admin', 'complaint_reply'
        ])
        ->latest()
        ->take(5)
        ->get();
        
        $complaints = Complaint::join('category', 'complaint.category_id','=','category.id')
        ->select('category.name', DB::raw('count(*) as count'))
        ->groupBy('complaint.category_id', 'category.name')
        ->get();

        $complaintDaily = Complaint::select(DB::raw('CONCAT(DAY(date), " ", MONTHNAME(date)) as day'), DB::raw('count(*) as total_complaints'))
        ->groupBy('day')
        ->orderByRaw('DATE_FORMAT(date, "%m-%d") ASC')
        ->pluck('total_complaints', 'day');

        // dd($complaintDaily);

        if($complaintDaily->isEmpty())
        {
            $complaintDailyArray = [];
        }

        foreach($complaintDaily as $day => $count){
            $complaintDailyArray[] = [
                'day' => $day,
                'count' => $count,
            ];
        }

        $countComplaintSent = Complaint::where('status', 'sent')->count();
        $countComplaintRead = Complaint::where('status', 'read')->count();
        $countComplaintResponse = Complaint::where('status', 'response')->count();
        $countComplaintDone = Complaint::where('status', 'done')->count();

        // dd($complaintDailyArray);
        // $dates = $complaintDaily->pluck('date')->map(function ($date) {
        //     return Carbon::parse($date)->format('Y-m-d');
        // });
        // $counts = $complaintDaily->pluck('count');
        // dd($complaints);
        

        if($complaints->isEmpty())
        {
            $complaintCategory = [];
        }

        foreach($complaints as $data){
            $complaintCategory[] = [
                'name' => $data->name,
                'count' => $data->count
            ];
        }

        // dd($complaintCategory);

        return view('admin.dashboard.index', [
            'complaint' => $complaints,
            'recentComplaint' => $recentComplaint,
            'complaintCategory' => $complaintCategory,
            'complaintDaily' => $complaintDailyArray,
            'complaintSent' => $countComplaintSent,
            'complaintRead' => $countComplaintRead,
            'complaintResponse' => $countComplaintResponse,
            'complaintDone' => $countComplaintDone
        ]);
    }
}

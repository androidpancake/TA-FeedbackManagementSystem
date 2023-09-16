<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $labId = auth()->id();

        $recentFeedback = Feedback::with([
            'category', 'class', 'user', 'reply'
        ])->whereHas('class.lab', function($query) use ($labId){
            $query->where('id', $labId);
        })
        ->latest()
        ->get();

        $lab = Auth::user();
        $recentSurveys = Survey::with([
            'class.user','responses' 
        ])
        ->whereHas('class.lab', function($query) use ($lab){
            $query->where('id', $lab->id);
        })
        ->latest()
        ->get();

        $recentSurveys->each(function ($survey) {
            $now = now();
            if ($now->between($survey->date, $survey->limit_date)) {
                $survey->remaining_time = $now->diffInRealHours($survey->limit_date);
            } else {
                $survey->remaining_time = '0';
            }
    
            $survey->commentCount = $survey->responses()->whereNotNull('comment')->count();
            $survey->avgrating = round($survey->responses()->average('rating'), 1);
            
            return $survey;
        });

        // dd($recentSurveys);

        $feedbacks = Feedback::join('category', 'feedback.category_id', '=', 'category.id')
        ->join('class', 'feedback.kelas_id', '=', 'class.id')
        ->join('lab', 'class.lab_id', '=', 'lab.id')
        ->where('lab.id', $labId)
        ->select('category.name', DB::raw('count(*) as count'))
        ->groupBy('feedback.category_id', 'category.name')
        ->get();
        if($feedbacks->isEmpty()){
            $feedbackByCategory = [];
        } else {
            foreach($feedbacks as $data){
                $feedbackByCategory[] = [
                    'name' => $data->name,
                    'count' => $data->count
                ];
            }
        }

        $feedbackDaily = Feedback::select(DB::raw('CONCAT(DAY(date), " ", MONTHNAME(date)) as day'), DB::raw('count(*) as total_feedback'))
        ->whereHas('class.lab', function($query) use ($labId){
            $query->where('id', $labId);
        })
        ->groupBy('day')
        ->orderByRaw('DATE_FORMAT(date, "%m-%d") ASC')
        ->pluck('total_feedback', 'day');

        if($feedbackDaily->isEmpty()){
            $feedbackDailyArray = [];
        } else {
            foreach($feedbackDaily as $day => $count){
                $feedbackDailyArray[] = [
                    'day' => $day,
                    'count' => $count,
                ];
            }
        }

        $wait = Feedback::where('status', 'sent')->whereHas('class.lecturer', function($query) use ($labId){
            $query->where('id', $labId);
        })->get();
        $read = Feedback::where('status', 'read')->whereHas('class.lecturer', function($query) use ($labId){
            $query->where('id', $labId);
        })->get();
        $process = Feedback::where('status', 'response')->whereHas('class.lecturer', function($query) use ($labId){
            $query->where('id', $labId);
        })->get();
        $done = Feedback::where('status', 'done')->whereHas('class.lecturer', function($query) use ($labId){
            $query->where('id', $labId);
        })->get();
        // dd($feedbackDailyArray);

        // dd($feedbackByCategory);
        return view('lab.dashboard.index', [
            'wait' => $wait,
            'read' => $read,
            'process' => $process,
            'done' => $done,
            'feedbacks' => $feedbacks,
            'feedbackByCategory' => $feedbackByCategory,
            'feedbackDaily' => $feedbackDailyArray,
            'recentFeedback' => $recentFeedback,
            'recentSurvey' => $recentSurveys
        ]);
    }
}

<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Lecturer;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $dosenId = auth()->id();

        $recentFeedback = Feedback::with([
            'category', 'class', 'user', 'reply'
        ])->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })
        ->latest()
        ->get();
        
        $dosen = Auth::user();
        $recentSurveys = Survey::with([
            'class.user','responses' 
        ])
        ->whereHas('class.lecturer', function($query) use ($dosen){
            $query->where('id', $dosen->id);
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

        $feedbacks = Feedback::join('category', 'feedback.category_id', '=', 'category.id')
        ->join('class', 'feedback.kelas_id', '=', 'class.id')
        ->join('lecturer', 'class.lecturer_id', '=', 'lecturer.id')
        ->where('lecturer.id', $dosenId)
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
        ->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
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
        
        $feedback = Feedback::with([
            'category', 'class', 'user', 'reply'
        ])->whereHas('class', function($query) use ($dosenId){
            $query->whereHas('lecturer', function($query) use ($dosenId){
                $query->where('id', $dosenId);
            });
        })->get();

        // dd($feedback);

        $wait = Feedback::where('status', 'sent')->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })->get();
        $read = Feedback::where('status', 'read')->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })->get();
        $process = Feedback::where('status', 'response')->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })->get();
        $done = Feedback::where('status', 'done')->whereHas('class.lecturer', function($query) use ($dosenId){
            $query->where('id', $dosenId);
        })->get();

        return view('dosen.dashboard.index', [
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

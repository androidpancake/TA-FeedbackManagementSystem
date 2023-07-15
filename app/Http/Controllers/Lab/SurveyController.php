<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Http\Requests\SurveyRequest;
use App\Models\Kelas;
use App\Models\Lab;
use App\Models\Survey;
use App\Notifications\LabSurveyNotification;
use App\Notifications\SurveyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class SurveyController extends Controller
{
    public function index()
    {
        $labClass = Lab::with('class.course')->find(auth()->id());
        $lab = Auth::user();
        $surveys = Survey::with([
            'class.user','responses' 
        ])
        ->whereHas('class.lab', function($query) use ($lab){
            $query->where('id', $lab->id);
        })
        ->paginate(10);

        $surveys->getCollection()->transform(function ($survey) {
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

        $course = $labClass->class->pluck('course');

        if (request()->has('start_date') && request()->has('end_date')) {
            $startDate = request()->input('start_date');
            $endDate = request()->input('end_date');
    
            $surveys = $surveys->whereBetween('date', [$startDate, $endDate]);
        }

        return view('lab.survey.index', [
            'surveys' => $surveys,
            'course' => $course
        ]);
    }

    public function search(Request $request)
    {
        if (request()->has('start_date') && request()->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
    
            $surveys = Survey::whereBetween('date', [$startDate, $endDate])->paginate(10);
        }
        // dd($surveys);

        return view('lab.survey.filter.survey', compact('surveys'));
    }

    public function getAllSurvey()
    {   
        $lab = Auth::user();

        $surveys = Survey::with([
            'class.user','responses' 
        ])
        ->whereHas('class.lab', function($query) use ($lab){
            $query->where('id', $lab->id);
        })  
        ->paginate(10);

        $surveys->getCollection()->transform(function ($survey) {
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

        return view('lab.survey.filter.survey', compact('surveys'));
    }
    public function getSurveyByClass($id)
    {
        $surveys = Survey::where('kelas_id', $id)->paginate(10);

        return view('lab.survey.filter.survey', compact('surveys'));
    }

    public function create()
    {
        $lab = Lab::with('class.course')->find(auth()->id());
        $course = $lab->class->pluck('course');

        // dd($course);
        return view('lab.survey.create', [
            'course' => $course
        ]);
    }

    public function getKelas($id)
    {
        $lab = auth()->id();
        $kelas = Kelas::where('lab_id', $lab)->where('course_id', $id)->pluck('name', 'id');
        return json_encode($kelas);

        // dd($kelas);
    }

    public function store(SurveyRequest $request)
{
        $data = $request->all();

        $data['date'] = now();
        $data['limit_date'] = now()->addDay();

        $survey = Survey::create($data);

        // dd($survey);
        // dd($survey->class_id);
        $class = Kelas::find($survey->kelas_id);
        // dd($class);
        $students = $class->user;
        // dd($students);
        foreach($students as $student){
            Notification::send($student, new LabSurveyNotification($survey));
        }
        $survey->url = url('mahasiswa/quicksurvey/fill_survey', $survey->id);
        $survey->save();         
        // dd($survey->class_id);


        return redirect()->route('lab.survey.success', $survey->id);
    }

    public function success($id)
    {
        $survey = Survey::findOrFail($id);
        return view('lab.survey.success', [
            'survey' => $survey
        ]);
    }

    public function detail($id)
    {
        $survey = Survey::with([
            'responses', 'class'
        ])->findOrFail($id);
        
        $responses = $survey->responses;

        // dd($responses->where('additional'));

        // $additional = explode(',', $responses->additional);
        
        $totalResponses = 0;
        $ratingsCount = [];
        $ratingsPercentage = [];
        $totalRating = 0;
        
        if($responses->isNotEmpty()){
            $totalResponses = $responses->count();
        
            for ($i = 1; $i <= 5; $i++) {
                $ratingsCount[$i] = $responses->where('rating', $i)->count();
                $ratingsPercentage[$i] = $totalResponses > 0 ? ($ratingsCount[$i] / $totalResponses) * 100 : 0;
                $totalRating += $i * $ratingsCount[$i];
            }
        }

        $averageRating = $totalResponses > 0 ? round($totalRating / $totalResponses, 1) : 0;
        
        krsort($ratingsCount); //sort kebalik dari 5
        krsort($ratingsPercentage);

        $survey->averageRating = $averageRating;
        $survey->ratingsCount = $ratingsCount;
        $survey->ratingsPercentage = $ratingsPercentage;
            
        $commentCount = $survey->responses()->whereNotNull('comment')->count();

        return view('lab.survey.detail', [
            'ratingsCount' => $ratingsCount,
            'ratingPrecentage' => $ratingsPercentage,
            'commentCount' => $commentCount,
            'survey' => $survey
        ]);
    }
}

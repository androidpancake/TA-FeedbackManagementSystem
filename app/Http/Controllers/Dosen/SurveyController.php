<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\SurveyRequest;
use App\Models\Kelas;
use App\Models\Lecturer;
use App\Models\Survey;
use App\Models\User;
use App\Notifications\SurveyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use SimpleSoftwareIO\QrCide\Facades\QrCode;

class SurveyController extends Controller
{
    public function index()
    {
        $dosen = Auth::user();
        $surveys = Survey::with([
            'class.user','responses' 
        ])
        ->whereHas('class.lecturer', function($query) use ($dosen){
            $query->where('id', $dosen->id);
        })
        ->get()
        ->map(function ($survey){
            $now = now();
            if($now->between($survey->date, $survey->limit_date)){
                $survey->remaining_time = $now->diffInHours($survey->limit_date);
            } else {
                $survey->remaining_time = 'Survey telah selesai';
            }

            return $survey;
        });

        foreach($surveys as $survey){
            $survey->commentCount = $survey->responses()->whereNotNull('comment')->count();
            $survey->avgrating = round($survey->responses()->average('rating'),1);
        }

        return view('dosen.survey.index', [
            'survey' => $surveys,
        ]);
    }

    public function create()
    {
        $lecturer = Lecturer::with('class.course')->find(auth()->id());
        $course = $lecturer->class->pluck('course');

        // dd($course);
        return view('dosen.survey.create', [
            'course' => $course
        ]);
    }

    public function getKelas($id)
    {
        $lecturer = auth()->id();
        $kelas = Kelas::where('lecturer_id', $lecturer)->where('course_id', $id)->pluck('name', 'id');
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
            Notification::send($student, new SurveyNotification($survey));
        }
        $survey->url = url('mahasiswa/quicksurvey/fill_survey', $survey->id);
        $survey->save();         
        // dd($survey->class_id);


        return redirect()->route('lecturer.survey.success', $survey->id);
    }

    public function success($id)
    {
        $survey = Survey::findOrFail($id);
        return view('dosen.survey.success', [
            'survey' => $survey
        ]);
    }

    public function detail($id)
    {
        $survey = Survey::with([
            'responses', 'class'
        ])->findOrFail($id);
        
        $responses = $survey->responses;
        
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

        return view('dosen.survey.detail', [
            'ratingsCount' => $ratingsCount,
            'ratingPrecentage' => $ratingsPercentage,
            'commentCount' => $commentCount,
            'survey' => $survey
        ]);
    }
}

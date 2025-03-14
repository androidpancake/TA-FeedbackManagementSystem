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
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use SimpleSoftwareIO\QrCide\Facades\QrCode;

class SurveyController extends Controller
{
    public function index(Request $request)
    {
        $lecturer = Lecturer::with('class.course')->find(auth()->id());
        $dosen = Auth::user();

        $surveys = Survey::with([
            'class.user',
            'responses'
        ])
            ->whereHas('class.lecturer', function ($query) use ($dosen) {
                $query->where('id', $dosen->id);
            })->orderBy('created_at', 'desc')
            ->paginate(10);

        $type = $request->get('type');

        if ($type === 'online') {
            $surveys = Survey::where('type', 'online')->paginate(10);
        } elseif ($type === 'onsite') {
            $surveys = Survey::where('type', 'onsite')->paginate(10);
        }


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

        $course = $lecturer->class->pluck('course');

        if (request()->has('start_date') && request()->has('end_date')) {
            $startDate = request()->input('start_date');
            $endDate = request()->input('end_date');

            $surveys = $surveys->whereBetween('date', [$startDate, $endDate]);
        }


        return view('dosen.survey.index', [
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

        return view('dosen.survey.filter.survey', compact('surveys'));
    }

    public function getSurveyByType(Request $request, $type)
    {
        try {
            //code...
            $dosen = Auth::user();

            $type = $request->get('type');

            if ($type === 'online') {
                $surveys = Survey::where('type', 'online')->whereHas('class.lecturer', function ($query) use ($dosen) {
                    $query->where('id', $dosen);
                })->get()->paginate(10);
                // dd($surveys);

            } elseif ($type === 'onsite') {
                $surveys = Survey::where('type', 'onsite')->whereHas('class.lecturer', function ($query) use ($dosen) {
                    $query->where('id', $dosen);
                })->get()->paginate(10);
            } else {
                $surveys = Survey::where('type', 'onsite')->whereHas('class.lecturer', function ($query) use ($dosen) {
                    $query->where('id', $dosen);
                })->get()->paginate(10);
            }

            return view('dosen.survey.filter.survey', compact('surveys'));
        } catch (Exception $e) {
            Log::error($e);

            // Return an error response
            return response()->json(['error' => 'error'], 500);
        }
    }

    public function getAllSurvey()
    {
        $dosen = Auth::user();

        $surveys = Survey::with([
            'class.user',
            'responses'
        ])
            ->whereHas('class.lecturer', function ($query) use ($dosen) {
                $query->where('id', $dosen->id);
            })
            ->where('type', 'onsite')
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

        return view('dosen.survey.filter.survey', compact('surveys'));
    }
    public function getSurveyByClass($id)
    {
        $surveys = Survey::where('kelas_id', $id)->paginate(10);

        return view('dosen.survey.filter.survey', compact('surveys'));
    }

    public function create()
    {
        $lecturer = Lecturer::with('class.course')->find(auth()->id());
        $course = $lecturer->class->pluck('course');

        // dd($course);
        return view('dosen.survey.create', [
            'course' => $course,
            'lecturer' => $lecturer
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

        // dd($survey->class_id);
        $class = Kelas::find($survey->kelas_id);
        // dd($class);
        $students = $class->user;
        // dd($students);
        foreach ($students as $student) {
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
            'responses',
            'class'
        ])->findOrFail($id);

        $responses = $survey->responses;

        // dd($responses->where('additional'));

        // $additional = explode(',', $responses->additional);

        $totalResponses = 0;
        $ratingsCount = [];
        $ratingsPercentage = [];
        $totalRating = 0;

        if ($responses->isNotEmpty()) {
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

    public function delete($id)
    {
        $survey = Survey::findOrFail($id);

        $survey->delete();

        return redirect()->route('lecturer.survey.index');
    }
}

<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Feedback;
use App\Models\Kelas;
use App\Models\Lecturer;
use App\Models\Response;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $dosen = Lecturer::with('class.course')->find(auth()->id());

        $course = $dosen->class->pluck('course');
        $courses = $dosen->class->pluck('course')->unique();

        // dd($course);

        $courseCounts = [];

        foreach ($course as $course) {
            $classCount = $dosen->class->where('course_id', $course->id)->count();
            $courseCounts[$course->id] = $classCount;
        }

        // dd($courses);

        return view('dosen.course.index', [
            'course' => $courses,
            'courseCounts' => $courseCounts,
        ]);
    }

    public function class($courseId)
    {

        // $countFeedback = Feedback::join('class', 'feedback.class_id', '=', 'class.id')
        // ->join('course', 'class.course_id', '=', 'course.id')
        // ->select('class.id', DB::raw('count(feedback.id) as feedback_count'))
        // ->groupBy('class.id')
        // ->get();
        // dd($countFeedback);

        $course = Course::findOrFail($courseId);

        // dd($course->id);

        $classes = Kelas::with(['course', 'lecturer', 'survey.responses'])
            ->where('course_id', $courseId)
            ->where('lecturer_id', auth()->id())
            ->get();

        $classes->each(function ($class) {
            $class->average_rating = $class->responses->avg('rating');
        });

        // dd($classes);


        // $feedbacks = Feedback::join('class', 'feedback.class_id', '=', 'class.id')
        // ->join('course', 'class.course_id', '=', 'course.id')
        // ->select('course.name as course_name', 'class.name as class_name', 'class.id as class_id', DB::raw('count(feedback.id) as feedback_count'))
        // ->groupBy('course_name', 'class_name', 'class.id', 'feedback.id')
        // ->where('class.lecturer_id', '=', auth()->id())
        // ->get();

        // dd($feedbacks);

        $feedback_count = Kelas::withCount('feedback')->find($courseId);

        $class_user_count = Kelas::withCount('user')->find($courseId);

        $survey_count = Kelas::withCount('survey')->find($courseId);

        return view('dosen.course.class', [
            'course' => $course,
            'feedback' => $feedback_count,
            'class' => $classes,
            'user_count' => $class_user_count,
            'survey_count' => $survey_count
        ]);
    }

    public function feedback_class($id)
    {
        $class = Kelas::with([
            'survey.responses'
        ])->findOrFail($id);

        $averageRating = $class->responses->avg('rating');

        // dd($averageRating);

        // dd($class);
        $feedback = Feedback::with([
            'class',
            'user',
            'reply'
        ])
            ->where('kelas_id', $id)
            ->paginate(10);

        // dd($feedback);
        $feedbackCount = $feedback->total();

        $surveys = Survey::with([
            'responses'
        ])->where('kelas_id', $id)
            ->paginate(10)
            ->through(function ($survey) {
                $now = now();
                if ($now->between($survey->date, $survey->limit_date)) {
                    $survey->remaining_time = $now->diffInHours($survey->limit_date);
                } else {
                    $survey->remaining_time = 'Survey telah selesai';
                }

                return $survey;
            });

        $countSurvey = $surveys->total();

        foreach ($surveys as $survey) {
            $survey->commentCount = $survey->responses()->whereNotNull('comment')->count();
            $survey->avgrating = round($survey->responses()->average('rating'), 1);
        }


        return view('dosen.feedback.class.index', [
            'class' => $class,
            'feedback' => $feedback,
            'count' => $feedbackCount,
            'survey' => $surveys,
            'count_survey' => $countSurvey,
            'avg_rating' => $averageRating
        ]);
    }
}

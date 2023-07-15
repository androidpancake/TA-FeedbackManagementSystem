<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Feedback;
use App\Models\Kelas;
use App\Models\Lab;
use App\Models\Survey;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $lab = Lab::with('class.course')->find(auth()->id());

        $course = $lab->class->pluck('course');
        $courses = $lab->class->pluck('course')->unique();

        $courseCounts = [];

        foreach ($course as $course) {
            $classCount = $lab->class->where('course_id', $course->id)->count();
            $courseCounts[$course->id] = $classCount;
        }

        // dd($courses);

        return view('lab.course.index', [
            'course' => $courses,
            'courseCounts' => $courseCounts,
        ]);
    }

    public function class($courseId)
    {

        $course = Course::findOrFail($courseId);

        // dd($course->id);

        $classes = Kelas::with(['course', 'lab', 'survey.responses'])
        ->where('course_id', $course->id)
        ->where('lab_id', auth()->id())
        ->get();

        // dd($classes);

        $classes->each(function ($class) {
            $class->average_rating = $class->responses->avg('rating');
        });

        $feedback_count = Kelas::withCount('feedback')->where('course_id', $courseId)->count();
        // dd($feedback_count);
        $class_user_count = Kelas::withCount('user')->where('course_id', $courseId)->count();
        dd($class_user_count);
        // dd($userCount);
        $survey_count = Kelas::withCount('survey')->find($course->id);

        return view('lab.course.class', [
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
            'class', 'user', 'reply'
        ])
        // ->whereHas('class.course', function($query) use ($id){
        //     $query->where('id', $id);
        // })
        ->where('kelas_id', $id)
        ->get();

        // dd($feedback);
        $feedbackCount = $feedback->count();

        $surveys = Survey::with([
            'responses'
        ])->where('kelas_id', $id)->get()

        ->map(function ($survey){
            $now = now();
            if($now->between($survey->date, $survey->limit_date)){
                $survey->remaining_time = $now->diffInHours($survey->limit_date);
            } else {
                $survey->remaining_time = 'Survey telah selesai';
            }

            return $survey;
        });

        $countSurvey = $surveys->count();

        foreach($surveys as $survey){
            $survey->commentCount = $survey->responses()->whereNotNull('comment')->count();
            $survey->avgrating = round($survey->responses()->average('rating'),1);
        }


        return view('lab.feedback.class.index', [
            'class' => $class,
            'feedback' => $feedback,
            'count' => $feedbackCount,
            'survey' => $surveys,
            'count_survey' => $countSurvey,
            'avg_rating' => $averageRating
        ]);
    }
}

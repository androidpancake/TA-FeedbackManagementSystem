<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Feedback;
use App\Models\Kelas;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $dosen = Lecturer::with('class.course')->find(auth()->id());

        // dd($dosen);
        // $course = Lecturer::join('class', 'lecturer.id', '=', 'class.lecturer_id')
        // ->join('course', 'class.course_id', '=', 'course.id')
        // ->select('course.id', 'course.name', 'course.code')
        // ->where('lecturer.id', $dosen)
        // ->get();

        $course = $dosen->class->pluck('course');

        return view('dosen.course.index', [
            'course' => $course
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

        $class = Kelas::with([
            'course', 'lecturer'
        ])->where('course_id', $courseId)
        ->where('lecturer_id', auth()->id())
        ->get();

        // dd($class);

        // $feedbacks = Feedback::join('class', 'feedback.class_id', '=', 'class.id')
        // ->join('course', 'class.course_id', '=', 'course.id')
        // ->select('course.name as course_name', 'class.name as class_name', 'class.id as class_id', DB::raw('count(feedback.id) as feedback_count'))
        // ->groupBy('course_name', 'class_name', 'class.id', 'feedback.id')
        // ->where('class.lecturer_id', '=', auth()->id())
        // ->get();

        // dd($feedbacks);

        $feedback_count = Kelas::withCount('feedback')->find($courseId);

        $class_user_count = Kelas::withCount('user')->find($courseId);

        // dd($class);

        return view('dosen.course.class', [
            'feedback' => $feedback_count,
            'class' => $class,
            'user_count' => $class_user_count
        ]);
    }

    public function feedback_class($id)
    {
        $class = Kelas::findOrFail($id);

        // dd($class);
        $feedback = Feedback::with([
            'class.course', 'class'
        ])
        ->whereHas('class.course', function($query) use ($id){
            $query->where('id', $id);
        })
        ->get();

        // $classData = Feedback::join('class', 'feedback.class_id', '=', 'class.id')
        // ->join('course', 'class.course_id', '=', 'course.id')
        // ->where('course.id', $id)
        // ->select('class.name as classname', 'course.name')
        // ->get();
        // dd($classData);
        $feedbackCount = $feedback->count();

        return view('dosen.feedback.class.index', [
            'class' => $class,
            'feedback' => $feedback,
            'count' => $feedbackCount
        ]);
    }
}

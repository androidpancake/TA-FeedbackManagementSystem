<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Kelas;
use App\Models\User;

class CourseController extends Controller
{
    public function index()
    {
        $course = Course::paginate(10);
        // dd($course);
        return view('admin.course.index', [
            'course' => $course
        ]);
    }

    public function detail($id)
    {
        // $item = Course::with([
        //     'kelas'
        // ])->findOrFail($id);
        
        $item = Course::with([
            'kelas'
        ])->findOrFail($id);

        $kelas = $item->kelas;
        
        // dd($kelas);
        // dd($item->kelas);
        return view('admin.class.detail', [
            'items' => $item,
            'kelas' => $kelas
        ]);
    }

    public function class($classId)
    {
        $class = Kelas::with([
            'course'
        ])->find($classId);
        // dd($class);
        $user = $class->user()->get();
        // dd($user);
        // $mahasiswa = User::join('mahasiswa_kelas', 'users.id','=','mahasiswa_kelas.user_id')
        // ->join('class','class.id','=','mahasiswa_kelas.class_id')
        // ->join('course','course.id','=','class.course_id')
        // ->where('course.id', $courseID)
        // ->select('users.id', 'users.name', 'users.nim')
        // ->get();
        
        // dd($kelas->name);
        // dd($mahasiswa);
        // foreach($kelas as $kelas){
        //     $mahasiswa = $kelas->user;
        //     $mahasiswaData = array_merge($mahasiswaData, $mahasiswa->toArray());
        // }
        // '<h1>'. $course->name .'</h1>';
        // foreach($item->kelas as $kelas){
        
        //     foreach($kelas->user as $student){
        //         echo $student->name;
        //     }
        // }

        return view('admin.class.user_detail', [
            'mahasiswa' => $user,
            'class' => $class
        ]);
    }
}

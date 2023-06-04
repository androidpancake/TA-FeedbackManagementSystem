<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Lecturer;
use App\Models\Survey;
use Illuminate\Http\Request;

class NewSurveyController extends Controller
{
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
        $kelas = Kelas::where('course_id', $id)->pluck('name', 'id');
        return json_encode($kelas);

        // dd($kelas);
    }
}

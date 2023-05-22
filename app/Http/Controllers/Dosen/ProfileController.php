<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id)
    {
        $dosen = Lecturer::findOrFail($id);
        $class = $dosen->class()->get();

        // foreach($class as $data){
        //     $data->name;
        // }

        // dd($class);
        return view('dosen.profile.index', [
            'dosen' => $dosen,
            'class' => $class
        ]);
    }
}

<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        $class = $user->class()->get();

        // foreach($class as $data){
        //     $data->name;
        // }

        // dd($class);
        return view('mahasiswa.profile.index', [
            'user' => $user,
            'class' => $class
        ]);
    }

}

<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'profile_photo' => 'required',
        ]);

        if($request->hasFile('profile_photo')){
            $data['profile_photo'] = $request->file('profile_photo')->store(
                'profile', 'public'
            );
            // dd($data);
        }
        $dosen = Lecturer::findOrFail($id);
        $dosen->update($data);
        
        return redirect()->route('lecturer.profile', $dosen->id);
    }
}

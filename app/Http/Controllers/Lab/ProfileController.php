<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id)
    {
        $lab = Lab::findOrFail($id);
        $class = $lab->class()->get();

        // foreach($class as $data){
        //     $data->name;
        // }

        // dd($class);
        return view('lab.profile.index', [
            'lab' => $lab,
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
        $lab = Lab::findOrFail($id);
        $lab->update($data);
        
        return redirect()->route('lab.profile', $lab->id);
    }
}

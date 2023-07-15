<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function delete($id)
    {
        $dosen = Lecturer::findOrFail($id);
        // Mendapatkan path foto saat ini dari model User
        $currentPhotoPath = auth()->user()->profile_photo;

        // Menghapus foto saat ini dari sistem penyimpanan
        if ($currentPhotoPath) {
            Storage::delete('public/profile/' . $currentPhotoPath);
            $dosen->profile_photo = null;
            $dosen->save();
        }        

        return redirect()->route('lecturer.profile', $id);
    }
}

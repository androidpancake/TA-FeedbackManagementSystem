<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function update(ProfileRequest $request, $id)
    {
        $data = $request->all();

        if($request->hasFile('profile_photo')){
            $data['profile_photo'] = $request->file('profile_photo')->store(
                'profile', 'public'
            );

            $user = User::findOrFail($id);
            $user->update($data);
            
        }
        
        return redirect()->route('mahasiswa.profile', $user->id);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        // Mendapatkan path foto saat ini dari model User
        $currentPhotoPath = auth()->user()->profile_photo;

        // Menghapus foto saat ini dari sistem penyimpanan
        if ($currentPhotoPath) {
            Storage::delete('public/profile/' . $currentPhotoPath);
        }

        // Menghapus referensi foto dari model User
        $user->update([
            'profile_photo' => null
        ]);

        return redirect()->route('mahasiswa.profile', $id);
    }

}

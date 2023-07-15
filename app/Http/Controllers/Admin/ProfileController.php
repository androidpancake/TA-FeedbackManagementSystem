<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index($id)
    {
        $admin = Admin::findOrFail($id);
        // dd($admin);
        return view('admin.profile.index', [
            'admin' => $admin
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
        }
        $admin = Admin::findOrFail($id);
        $admin->update($data);
        // dd($admin);
        
        return redirect()->route('admin.profile', $admin->id);
    }

    public function update_profile_photo(Request $request, $id)
    {
        $request->validate([
            'profile_photo' => 'required',
        ]);

        if($request->hasFile('profile_photo'))
        {
            $data['profile_photo'] = $request->file('profile_photo')->store(
                'profile', 'public'
            );
        }

        $admin = Admin::findOrFail($id);
        $admin->update($data);

        return redirect()->back();
    }

    public function delete($id)
    {
        $user = Auth::id();
        $admin = Admin::findOrFail($user);
        // Mendapatkan path foto saat ini dari model User
        $currentPhotoPath = auth()->user()->profile_photo;

        // Menghapus foto saat ini dari sistem penyimpanan
        if ($currentPhotoPath) {
            Storage::delete('public/profile/' . $currentPhotoPath);
        }

        // Menghapus referensi foto dari model User
        $admin->update([
            'profile_photo' => null
        ]);

        return redirect()->route('admin.profile', $id);
    }
}

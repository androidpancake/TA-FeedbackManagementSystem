<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    public function index(){
        return view('auth.login');
    }

   public function authenticate(Request $request)
   {
    $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    if(Auth::guard('mahasiswa')->attempt(['username' => $request->username, 'password' => $request->password])){
        $request->session()->regenerate();
        return redirect()->route('mahasiswa.dashboard');
    } elseif(Auth::guard('lecturer')->attempt(['username' => $request->username, 'password' => $request->password])){
        $request->session()->regenerate();
        return redirect()->route('dosen.dashboard');
    } elseif(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])){
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors([
        'password' => 'Email atau password salah'
    ]);
   }

   public function logout(Request $request)
   {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.index');
    }
}

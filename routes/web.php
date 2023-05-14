<?php

use App\Http\Controllers\Mahasiswa\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth:mahasiswa'], function(){
    
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('mahasiswa.dashboard');
});

Route::group(['middleware' => 'auth:dosen'], function(){
    Route::get('/dosen/dashboard', function(){
        return view('dosen.dashboard.index');
    });
});

Route::group(['middleware' => 'auth:admin'], function(){
    Route::get('/admin/dashboard', function(){
        return view('admin.dashboard.index');
    });
});



require __DIR__.'/auth.php';
require __DIR__.'/mahasiswa.php';
require __DIR__.'/lecturer.php';
require __DIR__.'/admin.php';


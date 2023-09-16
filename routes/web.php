<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Dosen\DashboardController as DosenDashboardController;
use App\Http\Controllers\LangController;
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

Route::group(['middleware' => 'auth:lecturer'], function(){

    //dashboard
    Route::get('/dosen/dashboard', [DosenDashboardController::class, 'index'])->name('dosen.dashboard');

});

Route::group(['middleware' => 'auth:admin'], function(){
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

});

Route::get('lang', [LangController::class, 'change'])->name('lang');



require __DIR__.'/auth.php';
require __DIR__.'/mahasiswa.php';
require __DIR__.'/lecturer.php';
require __DIR__.'/admin.php';
require __DIR__.'/lab.php';


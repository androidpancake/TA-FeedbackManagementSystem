<?php

use App\Http\Controllers\Dosen\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:dosen'], function(){
    //dashboard
    Route::get('lecturer/dashboard', [DashboardController::class, 'index'])->name('dosen.dashboard');
    
})?>
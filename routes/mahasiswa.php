<?php

use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\FeedbackController;
use Illuminate\Support\Facades\Route;

//dashboard
Route::group(['middleware' => 'auth:mahasiswa'], function(){
    
    //profile
    Route::get('mahasiswa/profile', function(){
        return view('mahasiswa.profile.index');
    });

    //feedback
    Route::get('mahasiswa/feedback', [FeedbackController::class, 'index'])->name('mahasiswa.feedback.index');
    Route::get('mahasiswa/feedback/create', [FeedbackController::class, 'create'])->name('mahasiswa.feedback.create');
    Route::post('send_feedback', [FeedbackController::class, 'store'])->name('mahasiswa.feedback.store');  
})
?>
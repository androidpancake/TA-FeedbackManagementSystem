<?php

use App\Http\Controllers\Dosen\DashboardController;
use App\Http\Controllers\Dosen\FeedbackController;
use App\Http\Controllers\Dosen\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:lecturer'], function(){
    //dashboard
    // Route::get('lecturer/dashboard', [DashboardController::class, 'index'])->name('dosen.dashboard');

    //profile
    Route::get('dosen/profile/{id}', [ProfileController::class, 'index'])->name('lecturer.profile');
    
    //feedback
    Route::get('dosen/feedback/{id}', [FeedbackController::class, 'index'])->name('lecturer.feedback.index');

    Route::get('dosen/feedback/detail/{id}', [FeedbackController::class, 'detail'])->name('lecturer.feedback.detail');
    Route::post('dosen/send_reply/{id}', [FeedbackController::class, 'l_send_reply'])->name('lecturer.reply.l_send');
})?>
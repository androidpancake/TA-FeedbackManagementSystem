<?php

use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\FeedbackController;
use App\Http\Controllers\Mahasiswa\ProfileController;
use Illuminate\Support\Facades\Route;

//dashboard
Route::group(['middleware' => 'auth:mahasiswa'], function(){
    
    //profile
    Route::get('mahasiswa/profile/{id}', [ProfileController::class, 'index'])->name('mahasiswa.profile')->middleware('auth:mahasiswa');

    //feedback
    Route::get('mahasiswa/feedback', [FeedbackController::class, 'index'])->name('mahasiswa.feedback.index');
    Route::get('mahasiswa/feedback/send/dosen', [FeedbackController::class, 'dosen'])->name('mahasiswa.feedback.create.dosen');
    Route::get('mahasiswa/feedback/send/lab', [FeedbackController::class, 'lab'])->name('mahasiswa.feedback.create.lab');

    Route::post('send_feedback', [FeedbackController::class, 'store'])->name('mahasiswa.feedback.store');
    
    Route::get('mahasiswa/feedback/detail/{id}', [FeedbackController::class, 'detail'])->name('mahasiswa.feedback.detail');
    Route::post('send_reply/{feedbackId}', [FeedbackController::class, 'm_send_reply'])->name('mahasiswa.reply.m_send');

    Route::post('feedback_done/{id}', [FeedbackController::class, 'close_feedback'])->name('mahasiswa.feedback.done');
    Route::delete('feedback/delete', [FeedbackController::class, 'destroy'])->name('mahasiswa.feedback.delete');
})
?>
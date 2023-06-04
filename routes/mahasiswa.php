<?php

use App\Http\Controllers\Mahasiswa\ComplaintController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\FeedbackController;
use App\Http\Controllers\Mahasiswa\NotificationController;
use App\Http\Controllers\Mahasiswa\ProfileController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

//dashboard
Route::group(['middleware' => 'auth:mahasiswa'], function(){
    
    //dashboard
    Route::get('mahasiswa/dashboard', function(){
        return view('mahasiswa.dashboard.index');
    })->name('mahasiswa.dashboard');
    //profile
    Route::get('mahasiswa/profile/{id}', [ProfileController::class, 'index'])->name('mahasiswa.profile')->middleware('auth:mahasiswa');
    Route::put('mahasiswa/profile/update/{id}', [ProfileController::class, 'update'])->name('mahasiswa.profile.update');
    Route::delete('mahasiswa/profile/delete/{id}', [ProfileController::class, 'delete'])->name('mahasiswa.profile.delete');

    //feedback
    Route::get('mahasiswa/feedback', [FeedbackController::class, 'index'])->name('mahasiswa.feedback.index');
    Route::get('mahasiswa/feedback/send/dosen', [FeedbackController::class, 'dosen'])->name('mahasiswa.feedback.create.dosen');
    Route::get('mahasiswa/feedback/send/lab', [FeedbackController::class, 'lab'])->name('mahasiswa.feedback.create.lab');

    Route::post('send_feedback', [FeedbackController::class, 'store'])->name('mahasiswa.feedback.store');
    
    Route::get('mahasiswa/feedback/detail/{id}', [FeedbackController::class, 'detail'])->name('mahasiswa.feedback.detail');
    Route::post('send_reply/{feedbackId}', [FeedbackController::class, 'm_send_reply'])->name('mahasiswa.reply.m_send');

    Route::post('feedback_done/{id}', [FeedbackController::class, 'close_feedback'])->name('mahasiswa.feedback.done');
    Route::delete('feedback/delete/{id}', [FeedbackController::class, 'destroy'])->name('mahasiswa.feedback.delete');

    //complaint
    Route::get('mahasiswa/complaint', [ComplaintController::class, 'index'])->name('mahasiswa.complaint.index');
    Route::get('mahasiswa/complaint/create', [ComplaintController::class, 'create'])->name('mahasiswa.complaint.create');
    Route::post('send_complaint', [ComplaintController::class, 'store'])->name('mahasiswa.complaint.store');
    Route::get('mahasiswa/complaint/detail/{id}', [ComplaintController::class, 'detail'])->name('mahasiswa.complaint.detail');
    Route::post('send_complaint_reply/{id}', [ComplaintController::class, 'send_complaint_reply'])->name('mahasiswa.complaint.m_send_complaint_reply');
    Route::delete('complaint/delete/{id}', [ComplaintController::class, 'destroy'])->name('mahasiswa.complaint.delete');
    Route::post('complaint_done/{id}', [ComplaintController::class, 'done'])->name('mahasiswa.complaint.done');

    //quick survey
    Route::get('mahasiswa/quicksurvey', [SurveyController::class, 'index'])->name('mahasiswa.survey.index');
    Route::get('mahasiswa/quicksurvey/fill_survey/{id}', [SurveyController::class, 'fill_survey'])->name('mahasiswa.survey.fill');
    Route::post('mahasiswa/quicksurvey/fill/{id}', [SurveyController::class, 'fill'])->name('mahasiswa.survey.send');

    //notifikasi
    Route::get('mahasiswa/notification', [NotificationController::class, 'index'])->name('mahasiswa.notification');

})
?>
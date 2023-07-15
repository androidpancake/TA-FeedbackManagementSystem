<?php

use App\Http\Controllers\Dosen\CourseController;
use App\Http\Controllers\Dosen\DashboardController;
use App\Http\Controllers\Dosen\FeedbackController;
use App\Http\Controllers\Dosen\NewSurveyController;
use App\Http\Controllers\Dosen\NotificationController;
use App\Http\Controllers\Dosen\ProfileController;
use App\Http\Controllers\Dosen\SurveyController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:lecturer'], function(){
    //dashboard
    Route::get('lecturer/dashboard', [DashboardController::class, 'index'])->name('lecturer.dashboard');

    //profile
    Route::get('dosen/profile/{id}', [ProfileController::class, 'index'])->name('lecturer.profile');
    Route::put('dosen/profile/update/{id}', [ProfileController::class, 'update'])->name('lecturer.profile.update');
    Route::put('dosen/profile/delete/{id}', [ProfileController::class, 'delete'])->name('lecturer.profile.delete');

    //feedback
    Route::get('dosen/feedback', [FeedbackController::class, 'index'])->name('lecturer.feedback.index');
    Route::get('dosen/feedback/{categoryName}', [FeedbackController::class,'byCategory'])->name('lecturer.feedback.category');
    Route::get('dosen/feedback/detail/{id}', [FeedbackController::class, 'detail'])->name('lecturer.feedback.detail');
    Route::post('dosen/send_reply/{id}', [FeedbackController::class, 'l_send_reply'])->name('lecturer.reply.l_send');

    //course
    Route::get('dosen/mata_kuliah', [CourseController::class, 'index'])->name('lecturer.course.index');
    Route::get('dosen/course/{courseId}/class', [CourseController::class, 'class'])->name('lecturer.course.class');
    Route::get('dosen/course/feedback/by_class/{id}', [CourseController::class, 'feedback_class'])->name('lecturer.course.class.feedback');

    //quick survey
    Route::get('dosen/quicksurvey', [SurveyController::class, 'index'])->name('lecturer.survey.index');
    Route::get('dosen/quicksurvey/search', [SurveyController::class, 'search'])->name('lecturer.survey.search');
    Route::get('getAllSurvey', [SurveyController::class, 'getAllSurvey']);
    Route::get('dosen/quicksurvey/create', [SurveyController::class, 'create'])->name('lecturer.survey.create');
    Route::post('dosen/quicksurvey/post', [SurveyController::class, 'store'])->name('lecturer.survey.post');
    Route::get('dosen/quicksurvey/success/{id}', [SurveyController::class, 'success'])->name('lecturer.survey.success');
    Route::delete('dosen/quicksurvey/delete/{id}', [SurveyController::class, 'delete'])->name('lecturer.survey.delete');
    Route::get('getKelas/{id}', [SurveyController::class, 'getKelas']);
    Route::get('getSurveyByClass/{classId}', [SurveyController::class, 'getSurveyByClass']);
    Route::get('dosen/quicksurvey/detail/{id}', [SurveyController::class, 'detail'])->name('lecturer.survey.detail');
    

    //notification
    Route::get('dosen/notification', [NotificationController::class, 'index'])->name('lecturer.notification');
    Route::get('dosen/quicksurvey/detail', function(){
        return view('dosen.survey.detail');
    });
    Route::get('dosen/quicksurvey/success', function(){
        return view('dosen.survey.success');
    });
})
?>
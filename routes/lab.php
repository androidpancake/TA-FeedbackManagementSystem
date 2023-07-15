<?php

use App\Http\Controllers\Lab\CourseController;
use App\Http\Controllers\Lab\DashboardController;
use App\Http\Controllers\Lab\FeedbackController;
use App\Http\Controllers\Lab\NotificationController;
use App\Http\Controllers\Lab\ProfileController;
use App\Http\Controllers\Lab\SurveyController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:lab'], function(){

    //dashboard
    Route::get('lab/dashboard', [DashboardController::class, 'index'])->name('lab.dashboard');

    //profile
    Route::get('lab/profile/{id}', [ProfileController::class, 'index'])->name('lab.profile');
    Route::put('lab/profile/update/{id}', [ProfileController::class, 'update'])->name('lab.profile.update');

    //feedback
    Route::get('lab/feedback', [FeedbackController::class, 'index'])->name('lab.feedback.index');
    Route::get('lab/feedback/{categoryName}', [FeedbackController::class,'byCategory'])->name('lab.feedback.category');
    Route::get('lab/feedback/detail/{id}', [FeedbackController::class, 'detail'])->name('lab.feedback.detail');
    Route::post('lab/send_reply/{id}', [FeedbackController::class, 'lab_send_reply'])->name('lab.reply.l_send');

    //course
    Route::get('lab/mata_kuliah', [CourseController::class, 'index'])->name('lab.course.index');
    Route::get('lab/course/{courseId}/class', [CourseController::class, 'class'])->name('lab.course.class');
    Route::get('lab/course/feedback/by_class/{id}', [CourseController::class, 'feedback_class'])->name('lab.course.class.feedback');

    //quick survey
    Route::get('lab/quicksurvey', [SurveyController::class, 'index'])->name('lab.survey.index');
    Route::get('lab/quicksurvey/search', [SurveyController::class, 'search'])->name('lab.survey.search');
    Route::get('getAllSurvey', [SurveyController::class, 'getAllSurvey']);
    Route::get('lab/quicksurvey/create', [SurveyController::class, 'create'])->name('lab.survey.create');
    Route::post('lab/quicksurvey/post', [SurveyController::class, 'store'])->name('lab.survey.post');
    Route::get('lab/quicksurvey/success/{id}', [SurveyController::class, 'success'])->name('lab.survey.success');

    Route::get('lab/getKelas/{id}', [SurveyController::class, 'getKelas']);
    Route::get('lab/getSurveyByClass/{classId}', [SurveyController::class, 'getSurveyByClass']);
    Route::get('lab/quicksurvey/detail/{id}', [SurveyController::class, 'detail'])->name('lab.survey.detail');

    //notification
    Route::get('lab/notification', [NotificationController::class, 'index'])->name('lab.notification');
});
?>
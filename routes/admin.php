<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

//dashboard
Route::group(['middleware' => 'auth:admin'], function(){
    //dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    //profile
    Route::get('admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
    
    //matkul
    Route::get('admin/course', [CourseController::class, 'index'])->name('admin.course.index');

    //course
    Route::get('admin/course/detail/{course_id}', [CourseController::class, 'detail'])->name('admin.course.detail');

    //user in class
    Route::get('admin/course/detail/{courseID}/mahasiswa', [CourseController::class, 'getUserByCourse'])->name('admin.course.class');
})
?>
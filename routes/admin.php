<?php

use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
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
    Route::get('admin/course/detail/{classId}/mahasiswa', [CourseController::class, 'class'])->name('admin.course.class');

    //complaint
    Route::get('admin/complaint', [ComplaintController::class, 'index'])->name('admin.complaint.index');
    Route::get('admin/complaint/detail/{id}', [ComplaintController::class, 'detail'])->name('admin.complaint.detail');
    Route::post('admin/send_complaint_reply/{complaintId}', [ComplaintController::class, 'a_send_complaint_reply'])->name('admin.complaint.a_send_complaint_reply');

    //setting
    Route::get('admin/setting', [SettingController::class, 'index'])->name('admin.setting.index');

    //setting category
    Route::get('admin/setting/category', [SettingController::class, 'category'])->name('admin.setting.category');
    Route::put('admin/setting/category/update/{id}', [SettingController::class, 'update'])->name('admin.setting.update');
    Route::get('admin/setting/category/edit/{id}', [SettingController::class, 'edit'])->name('admin.setting.edit');
    Route::delete('admin/setting/category/delete/{id}', [SettingController::class, 'delete'])->name('admin.setting.delete');

    //setting survey
    Route::get('admin/setting/survey', [SettingController::class, 'survey'])->name('admin.setting.survey');
})
?>
<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

//dashboard
Route::group(['middleware' => 'auth:admin'], function(){
    //dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    //profile
    Route::get('admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
})
?>
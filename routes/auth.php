<?php

use App\Http\Controllers\Auth\AuthUserController;
use Illuminate\Support\Facades\Route;

//login
Route::get('login', [AuthUserController::class, 'index'])->name('auth.index');
Route::post('authenticate', [AuthUserController::class, 'authenticate'])->name('auth');
Route::post('logout', [AuthUserController::class, 'logout'])->name('auth.logout');
?>
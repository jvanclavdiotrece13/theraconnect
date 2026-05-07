<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SettingsController;

Route::redirect('/', '/login');

Route::view('/login', 'login')->name('login');
Route::view('/register', 'register');

Route::post('/register-submit', [AuthController::class, 'registerSubmit']);
Route::post('/login-submit', [AuthController::class, 'loginSubmit']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
    Route::get('/requests', [RequestController::class, 'index'])->name('requests');
    Route::get('/patients', [PatientController::class, 'index'])->name('patients');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    
    Route::get('/logout', [AuthController::class, 'logout']);
});
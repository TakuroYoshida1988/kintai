<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller1;
use App\Http\Controllers\AuthenticatedSessionController1;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [Controller1::class, 'store']);

Route::get('/email/verify/{id}/{hash}', [Controller1::class, 'verifyEmail'])
    ->middleware(['signed'])->name('verification.verify');
Route::post('/email/verification-notification', [Controller1::class, 'sendVerification'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');
Route::get('/email/verify', [Controller1::class, 'emailVerificationNotice'])
    ->middleware('auth')
    ->name('verification.notice');

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthenticatedSessionController1::class, 'store'])->name('login');

Route::get('/', [Controller1::class, 'index']);
Route::post('/logout', [AuthenticatedSessionController1::class, 'destroy'])->name('logout');
Route::post('/clockIn', [Controller1::class, 'clockIn'])->name('clockIn');
Route::post('/clockOut', [Controller1::class, 'clockOut'])->name('clockOut');
Route::post('/breakStart', [Controller1::class, 'breakStart'])->name('break.start');
Route::post('/breakEnd', [Controller1::class, 'breakEnd'])->name('break.end');

Route::get('/attendance', [Controller1::class, 'attendanceIndex'])->name('attendance.index');
Route::get('/attendance/{date}', [Controller1::class, 'attendanceShow'])->name('attendance.show');
Route::get('/users', [Controller1::class, 'userList'])->name('user.list');
Route::get('/user/{id}/attendance', [Controller1::class, 'showUserAttendance'])->name('user.attendance');
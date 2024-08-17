<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller1;
use App\Http\Controllers\AuthenticatedSessionController1;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

// ルート設定
Route::get('/', [Controller1::class, 'index']);

// ログインと登録ビューのルート
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

// ユーザー登録後、メール認証リンクを送信する処理を追加
Route::post('/register', [Controller1::class, 'store']);

// 認証済みのユーザーのみログイン可能
Route::post('/login', [AuthenticatedSessionController1::class, 'store'])->name('login');
//Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

// ログアウト処理
Route::post('/logout', [AuthenticatedSessionController1::class, 'destroy'])->name('logout');

// 勤怠管理関連
Route::post('/clockIn', [Controller1::class, 'clockIn'])->name('clockIn');
Route::post('/clockOut', [Controller1::class, 'clockOut'])->name('clockOut');
Route::post('/breakStart', [Controller1::class, 'breakStart'])->name('break.start');
Route::post('/breakEnd', [Controller1::class, 'breakEnd'])->name('break.end');
Route::get('/attendance', [Controller1::class, 'attendanceIndex'])->name('attendance.index');
Route::get('/attendance/{date}', [Controller1::class, 'attendanceShow'])->name('attendance.show');


// メール認証リンクをクリックして認証を完了するルート
Route::get('/email/verify/{id}/{hash}', [Controller1::class, 'verifyEmail'])
    ->middleware(['signed'])->name('verification.verify');

// メール認証通知を再送信するためのルート（ログイン中のユーザーのみ）
Route::post('/email/verification-notification', [Controller1::class, 'sendVerification'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/email/verify', [Controller1::class, 'emailVerificationNotice'])
    ->middleware('auth')
    ->name('verification.notice');
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Auth::routes();
Route::group(['middleware' => ['guest']], function () {


    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    // Handle login form submission
    Route::post('/login', [AuthController::class, 'login']);
    // Handle logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    // Send reset password link
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    // Show reset password form
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    // Reset password
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});


Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);

    Route::post('/get-calendar-data', [HomeController::class, 'getCalendarData'])->name('get.calendar.data');


    Route::post('/attendance/check-in', [App\Http\Controllers\AttendanceController::class, 'checkIn'])->name('attendance.check-in');
    Route::post('/attendance/check-out', [App\Http\Controllers\AttendanceController::class, 'checkOut'])->name('attendance.check-out');
});

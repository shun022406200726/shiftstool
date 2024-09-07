<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\Auth\LoginController;
Route::get('/', function () {
    return view('shifts.index');
});

Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts.index');
Route::get('/shifts/data', [ShiftController::class, 'getShifts'])->name('shifts.data');
Route::get('/daily-staff', [ShiftController::class, 'getDailyStaff'])->name('shifts.daily-staff');
Route::post('/shifts/submit', [ShiftController::class, 'submitShift'])->name('shifts.submit');
Route::get('/payment', [ShiftController::class, 'checkPayment'])->name('payment.check');
Route::post('/shifts/submit', [ShiftController::class, 'submitShift'])->middleware('auth');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('admin/dashboard', function () {
        // 管理者用ダッシュボード
    })->middleware('can:admin');

    Route::get('employee/dashboard', function () {
        // 従業員用ダッシュボード
    })->middleware('can:employee');
});

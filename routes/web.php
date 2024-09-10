<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeDashboardController;

Route::middleware(['auth'])->group(function () {
    Route::get('/shifts/index', [EmployeeDashboardController::class, 'index'])->name('shifts.index');
    Route::get('/shifts/data', [ShiftController::class, 'getShifts'])->name('shifts.data');
    Route::get('/daily-staff', [ShiftController::class, 'getDailyStaff'])->name('shifts.daily-staff');
    Route::post('/shifts/submit', [ShiftController::class, 'submitShift'])->name('shifts.submit');
    Route::get('/payment', [ShiftController::class, 'checkPayment'])->name('payment.check');

    Route::get('manager/dashboard', function () {
        // 管理者用ダッシュボード
    })->middleware('can:manager');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftController;
Route::get('/', function () {
    return view('shifts.index');
});

Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts.index');
Route::get('/shifts/data', [ShiftController::class, 'getShifts'])->name('shifts.data');
Route::get('/daily-staff', [ShiftController::class, 'getDailyStaff'])->name('shifts.daily-staff');
Route::post('/shifts/submit', [ShiftController::class, 'submitShift'])->name('shifts.submit');
Route::get('/payment', [ShiftController::class, 'checkPayment'])->name('payment.check');

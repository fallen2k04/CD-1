<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::patch('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');

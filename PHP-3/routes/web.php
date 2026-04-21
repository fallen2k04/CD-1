<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;

Route::get('/', function () {
    return redirect()->route('enrollments.index');
});

Route::resource('students', StudentController::class)->only(['create', 'store']);
Route::resource('courses', CourseController::class)->only(['create', 'store']);
Route::resource('enrollments', EnrollmentController::class)->only(['index', 'create', 'store']);

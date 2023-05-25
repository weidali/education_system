<?php

use App\Http\Controllers\Api\v1\ClassroomController;
use App\Http\Controllers\Api\v1\LectureController;
use App\Http\Controllers\Api\v1\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('students', StudentController::class);
Route::apiResource('classrooms', ClassroomController::class);
Route::apiResource('lectures', LectureController::class);

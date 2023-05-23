<?php

use App\Http\Controllers\Api\v1\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('students', StudentController::class);

<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\SpeseController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('register_expenses', [SpeseController::class, 'register_expenses']);
Route::post('get_expenses_by_me', [SpeseController::class, 'get_expenses_by_me']);
Route::post('get_all_expenses', [SpeseController::class, 'get_all_expenses_with_login']);
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EnvoiceController;
use App\Http\Controllers\SpeseController;
use App\Http\Controllers\TeamController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('register_expenses', [SpeseController::class, 'register_expenses']);
Route::post('get_expenses_by_me', [SpeseController::class, 'get_expenses_by_me']);
Route::post('get_all_expenses', [SpeseController::class, 'get_all_expenses_with_login']);
/** CUSTOMER */
Route::post('store_customer', [CustomerController::class, 'store_customer']);
Route::post('update_customer', [CustomerController::class, 'update_customer']);
Route::post('delete_customer', [CustomerController::class, 'delete_customer']);
/** ENVOICE */
Route::post('store_envoice', [EnvoiceController::class, 'store_envoice']);
Route::post('update_envoice', [EnvoiceController::class, 'update_envoice']);
Route::post('delete_envoice', [EnvoiceController::class, 'delete_envoice']);
Route::post('get_invoiced', [EnvoiceController::class, 'get_invoiced']);
/** TEAM */
Route::post('store_team', [TeamController::class, 'store_team']);
/** DASHBOARD */
Route::post('dashboardData', [EnvoiceController::class, 'dashboardData']);
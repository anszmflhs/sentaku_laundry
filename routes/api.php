<?php

use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\JobDetailController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PriceListController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceManageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RolePermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|;
*/

Route::post('/login-user', [AuthController::class, 'loginUser']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logoutUser', [AuthController::class, 'logoutUser'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/karyawans', [KaryawanController::class, 'index']);
});

Route::post('/karyawans', [KaryawanController::class, 'create']);
Route::post('/karyawans/{id}', [KaryawanController::class, 'update']);
Route::delete('/karyawans/{id}', [KaryawanController::class, 'destroy']);

Route::post('/customers', [CustomerController::class, 'create']);
Route::post('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

Route::post('/job_details', [JobDetailController::class, 'create']);
Route::post('/job_details/{id}', [JobDetailController::class, 'update']);
Route::delete('/job_details/{id}', [JobDetailController::class, 'destroy']);

Route::get('/payments', [PaymentController::class, 'indexs'])->middleware('auth:sanctum');
Route::post('/payments', [PaymentController::class, 'create']);
Route::post('/payments', [PaymentController::class, 'creates']);
Route::post('/payments/{id}', [PaymentController::class, 'update']);
Route::delete('/payments/{id}', [PaymentController::class, 'destroy']);

Route::get('/price_lists', [PriceListController::class, 'indexs']);
Route::post('/price_lists', [PriceListController::class, 'create']);
Route::post('/price_lists', [PriceListController::class, 'creates']);
Route::post('/price_lists/{id}', [PriceListController::class, 'update']);
Route::delete('/price_lists/{id}', [PriceListController::class, 'destroy']);

Route::post('/roles', [RoleController::class, 'create']);
Route::post('/roles/{id}', [RoleController::class, 'update']);
Route::delete('/roles/{id}', [RoleController::class, 'destroy']);

Route::get('/service_manages', [ServiceManageController::class, 'indexs']);
Route::post('/service_manages', [ServiceManageController::class, 'create']);
Route::post('/service_manages', [ServiceManageController::class, 'creates']);
Route::post('/service_manages/{id}', [ServiceManageController::class, 'update']);
Route::delete('/service_manages/{id}', [ServiceManageController::class, 'destroy']);

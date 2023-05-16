<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PriceListController;
use App\Http\Controllers\Admin\ServiceManageController;
use App\Http\Controllers\Auth\AuthController;
use App\Models\Customer;
use App\Models\Karyawan;
use App\Models\Payment;
use App\Models\PriceList;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::post('/karyawans', [KaryawanController::class, 'store']);


Route::get('/login', [AuthController::class, 'viewLogin'])->name('login.view');
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::prefix('/admin')->group(function () {

//     Route::prefix('admin-data')->group(function () {
//         Route::get('/', [AdminController::class, 'index'])->name('admin.index');
//     });
// });
Route::prefix('customer')->group(function () {
    Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
    Route::post('/', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
});
Route::prefix('karyawan')->group(function () {
    Route::get('/', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('/', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('/{id}', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::post('/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
});
Route::prefix('payment')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/create', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
    Route::post('/{id}', [PaymentController::class, 'update'])->name('payment.update');
    Route::delete('/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy');
});
Route::prefix('pricelist')->group(function () {
    Route::get('/', [PriceListController::class, 'index'])->name('pricelist.index');
    Route::get('/create', [PriceListController::class, 'create'])->name('pricelist.create');
    Route::post('/', [PriceListController::class, 'store'])->name('pricelist.store');
    Route::get('/{id}', [PriceListController::class, 'edit'])->name('pricelist.edit');
    Route::post('/{id}', [PriceListController::class, 'update'])->name('pricelist.update');
    Route::delete('/{id}', [PriceListController::class, 'destroy'])->name('pricelist.destroy');
});
Route::prefix('role')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('role.index');
    Route::post('/', [RoleController::class, 'store'])->name('role.store');
    Route::get('/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
});
// Route::prefix('role-permission')->group(function () {
//     Route::get('/', [RolePermissionController::class, 'index'])->name('role-permission.index');
//     Route::post('/', [RolePermissionController::class, 'store'])->name('role-permission.store');
//     Route::get('/{id}', [RolePermissionController::class, 'create'])->name('role-permission.edit');
// });
Route::prefix('service-manage')->group(function () {
    Route::get('/', [ServiceManageController::class, 'index'])->name('servicemanage.index');
    Route::post('/', [ServiceManageController::class, 'store'])->name('servicemanage.store');
    Route::get('/{id}', [ServiceManageController::class, 'edit'])->name('servicemanage.edit');
    Route::put('/{id}', [ServiceManageController::class, 'update'])->name('servicemanage.update');
    Route::delete('/{id}', [ServiceManageController::class, 'destroy'])->name('servicemanage.destroy');
});
// Route::prefix('user-permission')->group(function () {
//     Route::get('/', [UserPermissionController::class, 'index'])->name('user-permission.index');
//     Route::post('/', [UserPermissionController::class, 'store'])->name('user-permission.store');
//     Route::get('/{id}', [UserPermissionController::class, 'create'])->name('user-permission.edit');
// });
// Route::prefix('user-role')->group(function () {
//     Route::get('/', [UserRoleController::class, 'index'])->name('user-role.index');
//     Route::post('/{id}', [UserRoleController::class, 'store'])->name('user-role.store');
//     Route::get('/{id}', [UserRoleController::class, 'create'])->name('user-role.edit');
});
Route::get('/test', function(){
    $data = Customer::with('user')->latest()->get();
    return response($data);
});
Route::get('/testKar', function(){
    $karyawans = Karyawan::with(['user','servicemanage'])->latest()->get();
    return response($karyawans);
});
Route::get('/testPri', function(){
    $prices = PriceList::all();
    return response($prices);
});
Route::get('/testPay', function(){
    $data = Payment::with(['user.customer', 'servicemanage', 'pricelist'])->latest()->get();
    return response($data);
});

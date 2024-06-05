<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login/process', [LoginController::class, 'process'])->name('login.process');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', [LogoutController::class, 'index'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
    Route::put('/staff/update/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::delete('/staff/delete/{id}', [StaffController::class, 'destroy'])->name('staff.delete');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');

    Route::get('/products', [ProductController::class, 'all'])->name('product.all');

    Route::group(['middleware' => ['role:customer']], function () {
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart', [CartController::class, 'store'])->name('cart.store');

        Route::post('/bill/{order_number}', [BillController::class, 'payment_confirm'])->name('payment.confirmation');
    });

    Route::get('/report/bill', [ReportController::class, 'index'])->name('report.index');

    Route::get('/bill', [BillController::class, 'index'])->name('bill.index');
    Route::post('/bill', [BillController::class, 'store'])->name('bill.store');
    Route::get('/bill/{order_number}', [BillController::class, 'show'])->name('bill.invoice');
    Route::post('/bill/validation/{id}', [BillController::class, 'payment_validation'])->name('payment.validation');
});

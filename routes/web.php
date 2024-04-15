<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\ShippingUnitController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;
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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('post_login');

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('index');

        Route::put('', [ProfileController::class, 'update'])->name('update');

        Route::put('password', [ProfileController::class, 'updatePassword'])->middleware('check_tab')->name('update_password');
    });

    Route::resource('supplier', SupplierController::class)->except('show');

    Route::resource('product-category', ProductCategoryController::class)->except('show');

    Route::resource('product', ProductController::class);

    Route::resource('customer', CustomerController::class);

    Route::resource('purchase-order', PurchaseOrderController::class);

    Route::resource('shipping-unit', ShippingUnitController::class);

    Route::resource('order', OrderController::class);

    Route::resource('position', PositionController::class);

    Route::resource('department', DepartmentController::class);

    Route::resource('user', UserController::class);

    Route::resource('salary', SalaryController::class);
});

Route::post('upload', [UploadController::class, 'store'])->name('upload');

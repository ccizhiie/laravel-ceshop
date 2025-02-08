<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\OfficerMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



// route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    route::get('/produk', [ProductController::class, 'index'])->name('produk');
    Route::get('/produk/create', [ProductController::class, 'create'])->name('produk.create');
    route::post('/produk/store', [ProductController::class, 'store'])->name('produk.store');

    route::get('/produk/edit{id}', [ProductController::class, 'edit'])->name('produk.edit');
    route::put('/produk/update{id}', [ProductController::class, 'update'])->name('produk.update');

    route::delete('/produk/delete/{id}', [ProductController::class, 'destroy'])->name('produk.destroy');


    Route::get('/customers', [CustomerController::class, 'index'])->name('customer');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customor/edit{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/update{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customor/delete/{id}',[CustomerController::class, 'destroy'])->name('customer.delete');

    Route::get('/sales', [SalesController::class, 'index'])->name('sales');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
});


Route::middleware(['auth', OfficerMiddleware::class])->group(function () {
    Route::get('/officer/dashboard', [HomeController::class, 'indexOfficer'])->name('officer.dashboard');
});

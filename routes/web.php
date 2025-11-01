<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;



Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'chart'])->name('dashboard');
    Route::controller(CategoryController::class)->group(function () {
        Route::get('categories', 'index')->name('categories');
        Route::get('categories/create', 'create')->name('create');
        Route::post('categories', 'store')->name('categories.store');
        Route::get('categories/{category}/edit', 'edit')->name('categories.edit');
        Route::put('categories/{category}', 'update')->name('categories.update');
        Route::delete('categories/delete/{category}', 'destroy')->name('categories.destroy');
        Route::get('categories/{id}/products', 'showProducts')->name('categories.products');
    });

    Route::controller(ProductController::class)->group(function () {
        // عرض كل المنتجات
        Route::get('products', 'index')->name('products');
        // نموذج إنشاء منتج جديد
        Route::get('products/create', 'create')->name('product.create');
        // 🔹 ضيفه هنا فوق show
        Route::get('/products/search', 'search')->name('products.search');
        // تخزين المنتج الجديد
        Route::post('products', 'store')->name('product.store');
        // عرض منتج معين
        Route::get('products/{product}', 'show')->name('products.show');
        // نموذج تعديل منتج
        Route::get('products/{product}/edit', 'edit')->name('products.edit');
        // تحديث منتج
        Route::put('products/{product}', 'update')->name('products.update');
        // حذف منتج
        Route::delete('products/delete/{product}', 'destroy')->name('products.destroy');
    });

    Route::get('/sales/report', [SaleController::class, 'report'])->name('sales.report');
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
    Route::post('/search', [SearchController::class, 'search'])->name('search.perform');
    Route::post('/sales/store', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/create', [SaleController::class, 'page'])->name('sales.page');
    Route::get('/sales/month/{year}/{month}', [SaleController::class, 'monthlyDetails'])->name('sales.monthly.details');
    Route::get('/sales/day/{date}', [SaleController::class, 'dailyDetails'])->name('sales.daily.details');
});

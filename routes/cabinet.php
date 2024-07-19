<?php

use App\Http\Controllers\Cabinet\IndexController;
use App\Http\Controllers\Cabinet\OrderController;
use App\Http\Controllers\Cabinet\ReviewController;
use App\Http\Controllers\Cabinet\ProfileController;
use App\Http\Controllers\Cabinet\BalanceController;
use App\Http\Controllers\Cabinet\ProductController;
use App\Http\Controllers\Cabinet\GalleryController;
use App\Http\Controllers\Cabinet\IntroduceController;
use App\Http\Controllers\Panel\ProductController as ProductAdminController;
use App\Http\Controllers\Panel\GalleryController as GalleryAdminController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::group(['prefix' => 'profile', 'as' => 'profile.'], static function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::post('/update', [ProfileController::class, 'update'])->name('update');
    Route::post('/password', [ProfileController::class, 'password'])->name('password');
    Route::post('/avatar', [ProfileController::class, 'avatar'])->name('avatar');
});

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::get('/balance', [BalanceController::class, 'index'])->name('balance');

Route::group(['prefix' => 'orders', 'as' => 'orders.'], static function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::post('/create', [OrderController::class, 'store'])->name('store');
});

Route::group(['prefix' => 'products', 'as' => 'products.'], static function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::post('/', [IntroduceController::class, 'store'])->name('introduce');

    Route::middleware('verified')->group(static function () {
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/create', [ProductController::class, 'store'])->name('store');
    });

    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::post('/{product}/edit', [ProductController::class, 'update'])->name('update');
    Route::post('/{product}/edit/attributes', [ProductAdminController::class, 'updateAttributes'])
        ->name('update_attributes')
        ->can('update', 'product');

    Route::get('/{product}/edit/gallery', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::post('/{product}/edit/gallery', [GalleryAdminController::class, 'update'])
        ->name('gallery.update')
        ->can('update', 'product');
});

Route::group(['prefix' => 'search', 'as' => 'search.'], static function () {
    Route::get('/reviews', [ReviewController::class, 'search'])->name('review');
});

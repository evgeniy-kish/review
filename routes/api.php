<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Cabinet\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'services', 'as' => 'services.'], static function () {
    Route::post('/slugify', [ServiceController::class, 'slugify'])
        ->name('slugify');

    Route::group(['prefix' => 'upload', 'as' => 'upload.'], static function () {
        Route::post('/base', [ServiceController::class, 'uploadBase'])
            ->name('base');
        Route::post('/trum', [ServiceController::class, 'trumUpload'])
            ->name('trum');
    });

    Route::get('/search/blog', [BlogController::class, 'search'])
        ->name('search.blog');

    Route::get('/categories/{category}/attributes', [ProductController::class, 'attributes'])
        ->name('categories.attributes');
});

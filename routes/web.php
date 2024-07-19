<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\IntroduceController;

Route::group(['prefix' => '/'], static function () {
    Route::get('/', [IndexController::class, 'index'])->name('home');

    Route::view('/contacts', 'pages.contacts')->name('contacts');
    Route::view('/for-authors', 'pages.for-authors')->name('for-authors');
    Route::view('/for-companies', 'pages.for-companies')->name('for-companies');
    Route::view('/about', 'pages.about')->name('about');
    Route::view('/support', 'pages.support')->name('support');
    Route::view('/terms-for-use', 'pages.terms-for-use')->name('terms-for-use');
    Route::view('/license-agreement', 'pages.license-agreement')->name('license-agreement');
    Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');

    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::post('/contacts', [FeedbackController::class, 'store'])->name('store');
});

Route::group(['prefix' => 'blog', 'as' => 'blog.'], static function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{rubric:slug}', [BlogController::class, 'rubric'])->name('rubric');
    Route::get('/{rubric_slug}/{article:slug}', [BlogController::class, 'show'])->name('show');
    Route::post('/{article}/like', [BlogController::class, 'like'])
        ->middleware('auth')
        ->name('article.like');
    Route::post('/{article}/comment/store', [CommentController::class, 'article'])
        ->middleware('auth')
        ->name('comment.store');
});
Route::group(['prefix' => 'reviews', 'as' => 'reviews.'], static function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/{category1}/{category2?}/{product?}', [ReviewController::class, 'resolve'])->name('product');
    Route::post('/{product}', [ReviewController::class, 'store'])
        ->middleware('auth')
        ->name('review.store');
});
Route::group(['prefix' => 'review', 'as' => 'review.'], static function () {
    Route::get('/{review}', [ReviewController::class, 'show'])
        //->middleware('auth')
        ->name('show');
    Route::post('/{review}/like', [ReviewController::class, 'like'])
        ->middleware('auth')
        ->name('like');
    Route::post('/{review}/comment/store', [CommentController::class, 'review'])
        ->middleware('auth')
        ->name('comment.store');
});
Route::group(['prefix' => 'companies', 'as' => 'introduce.'], static function () {
    Route::get('/', [IntroduceController::class, 'index'])->name('index');
});

Route::get('/services/lang/{lang}', [ServiceController::class, 'lang'])
    ->whereIn('lang', ['ru', 'en', 'de', 'es', 'fr', 'pt', 'it'])
    ->name('services.lang');

Route::group(['prefix' => 'users', 'as' => 'users.'], static function () {
    Route::get('/{user}', [UserController::class, 'show'])
        ->middleware('auth')
        ->name('show');
});

Route::group(['prefix' => 'faq', 'as' => 'faq.'], static function () {
    Route::get('/', [FaqController::class, 'index'])->name('index');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/social.php';



<?php

use App\Http\Controllers\Social\GoogleController;
use App\Http\Controllers\Social\VkontakteController;

Route::group(['prefix' => '/auth/google', 'as' => 'social.google.'], static function () {
    Route::get('/redirect', [GoogleController::class, 'redirect'])
        ->name('auth');

    Route::get('/callback', [GoogleController::class, 'callback'])
        ->name('callback');
});
Route::group(['prefix' => '/auth/vkontakte', 'as' => 'social.vkontakte.'], static function () {
    Route::get('/redirect', [VkontakteController::class, 'redirect'])
        ->name('auth');

    Route::get('/callback', [VkontakteController::class, 'callback'])
        ->name('callback');
});

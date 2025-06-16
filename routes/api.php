<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TweetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('logout', [AuthController::class, 'logout']);

    Route::controller(TweetController::class)->prefix('tweets')->group(function () {
        Route::get('/', 'index')->name('tweets.index');
        Route::post('/', 'store')->name('tweets.store');
        Route::get('/{slug}', 'show')->name('tweets.show');

    });
});

Route::group(['middleware' => ['guest']], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('throttle:8,1');
});

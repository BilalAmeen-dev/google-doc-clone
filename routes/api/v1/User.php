<?php

use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

// Route::apiResource('users', UserController::class);

Route::group(['controller' => UserController::class, 'middleware' => ['auth'], 'as' => 'users.'], function () {
    Route::get('users', 'index')->name('index')->withoutMiddleware('auth');
    Route::get('users/{user}', 'show')->name('show')->withoutMiddleware('auth')->whereNumber('user');
    Route::post('users', 'store');
    Route::patch('user/{user}', 'update');
    Route::delete('user/{user}', 'destroy');
});

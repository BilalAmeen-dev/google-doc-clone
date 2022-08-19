<?php

use App\Http\Controllers\postController;

use Illuminate\Support\Facades\Route;

// Route::apiResource('posts', postController::class);

Route::group(['controller' => postController::class, 'middleware' => ['auth'], 'as' => 'posts.'], function () {
    Route::get('posts', 'index')->name('index')->withoutMiddleware('auth');
    Route::get('posts/{post}', 'show')->name('show')->withoutMiddleware('auth')->whereNumber('post');
    Route::post('posts', 'store');
    Route::patch('post/{post}', 'update');
    Route::delete('post/{post}', 'destroy');
});

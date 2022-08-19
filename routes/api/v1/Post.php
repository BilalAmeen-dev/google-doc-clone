<?php

use App\Http\Controllers\PostController;

use Illuminate\Support\Facades\Route;

// Route::apiResource('posts', postController::class);

Route::group(['controller' => PostController::class, 'as' => 'posts.'], function () {
    Route::get('posts', 'index')->name('index')->withoutMiddleware('auth');
    Route::get('post/{post}', 'show')->name('show')->withoutMiddleware('auth')->whereNumber('post');
    Route::post('post', 'store');
    Route::patch('post/{post}', 'update');
    Route::delete('post/{post}', 'destroy');
});

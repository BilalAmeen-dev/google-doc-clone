<?php

use App\Http\Controllers\CommentController;

use Illuminate\Support\Facades\Route;

// Route::apiResource('comment', UserController::class);

Route::group(['controller' => CommentController::class, 'middleware' => ['auth'], 'as' => 'comment.'], function () {
    Route::get('comment', 'index')->name('index')->withoutMiddleware('auth');
    Route::get('comment/{comment}', 'show')->name('show')->withoutMiddleware('auth')->whereNumber('comment');
    Route::post('comment', 'store');
    Route::patch('comment/{comment}', 'update');
    Route::delete('comment/{comment}', 'destroy');
});

<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', App\Http\Controllers\V1\Auth\RegisterController::class)->name('register');
    Route::get('login', App\Http\Controllers\V1\Auth\LoginController::class)->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('chatrooms')->name('chatrooms.')->group(function () {
        Route::get('/', App\Http\Controllers\V1\Chatroom\ChatroomIndexController::class)->name('index');
        Route::post('/create', App\Http\Controllers\V1\Chatroom\ChatroomCreateController::class)->name('create');
        Route::patch('/update/{id}', App\Http\Controllers\V1\Chatroom\ChatroomUpdateController::class)->name('update');
        Route::get('/enter/{id}', App\Http\Controllers\V1\Chatroom\ChatroomEnterController::class)->name('enter');
        Route::get('/leave/{id}', App\Http\Controllers\V1\Chatroom\ChatroomLeaveController::class)->name('leave');
    });

    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/{chatroomId}', App\Http\Controllers\V1\Messages\MessageIndexController::class)->name('index');
        Route::post('/send', App\Http\Controllers\V1\Messages\SendMessageController::class)->name('send');
        //        Route::patch('/update/{id}', App\Http\Controllers\V1\Chatroom\ChatroomUpdateController::class)->name('update');
        //        Route::get('/enter/{id}', App\Http\Controllers\V1\Chatroom\ChatroomEnterController::class)->name('enter');
        //        Route::get('/leave/{id}', App\Http\Controllers\V1\Chatroom\ChatroomLeaveController::class)->name('leave');
    });
});

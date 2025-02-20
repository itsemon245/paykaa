<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    Route::prefix('chats')->name('chat.')->group(function () {
        Route::get('/', [ChatController::class, 'index'])->name('index');
        Route::get('/check-new-messages', [ChatController::class, 'checkNewMessages'])->name('check-new-messages');
        Route::get('/user-chats', [ChatController::class, 'getUserChats'])->name('user-chats');
        Route::get('/receiver-chat/{receiver}', [ChatController::class, 'receiverChat'])->name('receiver-chat');
        Route::get('/{chat}/typing', [ChatController::class, 'typing'])->name('typing')->middleware('has-chat');
        Route::get('/{chat}', [ChatController::class, 'show'])->name('show')->middleware('has-chat');
    });
    Route::get('search-users', [UserController::class, 'index'])->name('search-users');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/messages/{chat}/money-requests', [MessageController::class, 'moneyRequestMessages'])->name('messages.money-requests');
    Route::middleware('has-chat')->group(function () {
        Route::get('/check-new-messages/{chat}', [MessageController::class, 'checkNewMessages'])->name('messages.check-new');
        Route::get('/get-new-messages/{chat}', [MessageController::class, 'getNewMessages'])->name('messages.get-new');
        Route::post('/messages/{chat}', [MessageController::class, 'store'])->name('message.store');
    });
    Route::get('helpline', [ChatController::class, 'helpline'])->name('helpline')->middleware('auth');
});

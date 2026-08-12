<?php

use App\Http\Controllers\ChatBotController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::inertia('chat', 'chat/Chat')->name('chat');
    Route::get('chat/{id}', [ChatBotController::class, 'show'])->name('chat.show');
});
require __DIR__.'/settings.php';

<?php

use App\Http\Controllers\ChatBotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/conversation', [ChatBotController::class, 'conversation']);

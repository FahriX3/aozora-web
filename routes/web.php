<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PengurusController;

Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'list'])->name('events.index');
Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus');

Route::get('/event/{slug}', [EventController::class, 'show'])->name('event.detail');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google OAuth
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Chatbot Sora AI API
Route::get('/api/chat/history', [ChatController::class, 'history'])->name('chat.history');
Route::post('/api/chat/send', [ChatController::class, 'send'])->name('chat.send');
Route::post('/api/chat/clear', [ChatController::class, 'clear'])->name('chat.clear');


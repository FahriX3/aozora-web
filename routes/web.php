<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PengurusController;

Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'list'])->name('events.index');
Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus');

Route::get('/event/{slug}', [EventController::class, 'show'])->name('event.detail');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


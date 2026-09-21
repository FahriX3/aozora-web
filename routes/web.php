<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\AuthController;

Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'list'])->name('events.index');
Route::get('/event/{slug}', [EventController::class, 'show'])->name('event.detail');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
//     Route::get('/', function () {
//         return redirect()->route('admin.dashboard');
//     });
//     
//     Route::get('/dashboard', function () {
//         return view('pages.admin.dashboard');
//     })->name('dashboard');
// 
//     Route::resource('events', AdminEventController::class);
//     Route::post('events/{event}/upload-documentation', [AdminEventController::class, 'uploadDocumentation'])->name('events.upload-documentation');
// 
//     Route::get('/featured-event', [App\Http\Controllers\Admin\FeaturedEventController::class, 'index'])->name('featured-event.index');
//     Route::post('/featured-event', [App\Http\Controllers\Admin\FeaturedEventController::class, 'store'])->name('featured-event.store');
// 
//     Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);
// });

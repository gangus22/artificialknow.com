<?php

use App\Http\Controllers\LoginAttemptController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', MainPageController::class)
    ->name('main');

Route::get('/login', LoginController::class)
    ->name('login');

Route::post('/login', LoginAttemptController::class)
    ->name('loginPOST');

Route::get('/dashboard', fn () => dd('TBA'))
    ->name('dashboard')
    ->middleware('auth');

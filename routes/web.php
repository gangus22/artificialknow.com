<?php

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

Route::get('/', MainPageController::class);

Route::get('/login', [LoginController::class, 'view']);
Route::post('/login', [LoginController::class, 'attemptLogin']);

Route::get('/dashboard', fn () => dd('TBA'))
    ->middleware('auth');

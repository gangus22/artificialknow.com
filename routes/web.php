<?php

use App\Http\Controllers\AboutUsPageController;
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

Route::get('/about-us', AboutUsPageController::class)
    ->name('aboutUs');

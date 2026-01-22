<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ThingController;
use App\Http\Controllers\PlaceController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', function() {
    return view('auth.register');
})->name('register');
Route::post('/signup', [AuthController::class, 'register'])->name('register.store');

Route::get('/signin', [AuthController::class, 'signin'])->name('login');
Route::post('/signin', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('things', ThingController::class);
Route::resource('place', PlaceController::class);
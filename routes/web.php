<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard',[PostController::class, 'index'])
->name('dashboard')->middleware('auth');

Route::get('/posts/create',[PostController::class,'create']);

Route::post('/posts/store',[PostController::class,'store']);

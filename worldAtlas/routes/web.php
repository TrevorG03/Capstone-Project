<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CountryController;
Route::get('/', [LoginController::class, 'welcome'])->name('welcome');
// Registration Routes
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-user', [LoginController::class, 'registerUser'])->name('register-user');

// Login Routes
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login-user', [LoginController::class, 'loginUser'])->name('login-user');

// Dashboard and Logout Routes
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// Review routes
Route::get('/review', [ReviewsController::class, 'getReviews']);
Route::post('/review', [ReviewsController::class, 'getReviews']);

Route::get('/countries/{name}', [CountryController::class, 'show']);
?>
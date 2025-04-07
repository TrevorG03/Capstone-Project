<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\ItemsController;

Route::get('/', function () {
    return view('welcome');
});

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

// Item Routes
Route::get('/book/{bookID}', [ItemsController::class, 'loadBook']);
Route::post('/book/createReview/{bookID}', [ItemsController::class, 'createReview']);

// Review routes
Route::post('/review/{itemType}/{itemID}', [ReviewsController::class, 'getReviews']);

?>
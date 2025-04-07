<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\FoodController;

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


// Food routes
Route::get('/foodHome', [FoodController::class, 'foodHome'])->name('food');
Route::get('/foodEntryForm', [FoodController::class, 'foodEntryForm'])->name('foodEntryForm');

// Item Routes
Route::get('/book/{bookID}', [ItemsController::class, 'loadBook']);

// Review routes
Route::get('/review', [ReviewsController::class, 'getReviews']);
Route::post('/review', [ReviewsController::class, 'getReviews']);

?>

<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\FoodController;

use App\Http\Controllers\ReviewsController;
<<<<<<< HEAD
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CountryController;
=======
use App\Http\Controllers\ItemsController;

Route::get('/', function () {
    return view('welcome');
});


>>>>>>> 57ef25039e8376aebcb20c505a7a74576859c541
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


<<<<<<< HEAD
=======
// Food routes
Route::get('/foodHome', [FoodController::class, 'foodHome'])->name('food');

// Item Routes
Route::get('/book/{bookID}', [ItemsController::class, 'loadBook']);

>>>>>>> 57ef25039e8376aebcb20c505a7a74576859c541
// Review routes
Route::get('/review', [ReviewsController::class, 'getReviews']);
Route::post('/review', [ReviewsController::class, 'getReviews']);

<<<<<<< HEAD
Route::get('/countries/{name}', [CountryController::class, 'show']);
?>
=======
?>
>>>>>>> 57ef25039e8376aebcb20c505a7a74576859c541

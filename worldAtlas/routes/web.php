<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/review', [ReviewsController::class, 'getReviews']);
Route::post('/review', [ReviewsController::class, 'getReviews']);

?>
<?php

namespace App\Http\Controllers;

use App\Models\attractionReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    public function getReviews() {
        $attractions = DB::table('attraction_review')->get();
        $books = DB::table('book_review')->get();
        $foods = DB::table('food_review')->get();
        $users = DB::table('users')->select('id', 'name')->get();

        // Make this instead pull 3 random reviews
        // Requires:
        // User that posted it
        // Country it is for
        // It's own ID

        return view('review', compact('attractions', 'books', 'foods', 'users'));
    }

    public function getAttractReviews() {
        $attractions = DB::table('attraction_review')->get();
        return view('review', compact('attractions'));
    }

    public function getBookReviews() {
        $book = DB::table('book_review')->get();
        return view('review', compact('book'));
    }

    public function getFoodReviews() {
        $food = DB::table('food_review')->get();
        return view('review', compact('food'));
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\country;
use App\Models\attractionReview;
use App\Models\bookReview;
use App\Models\foodReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    public function getReviews() {

        // $newData = new attractionReview(); $newData->userID = 1; $newData->attractionID = 1; $newData->countryID = 1;
        // $newData->text = "This is the attraction review text!"; $newData->title = "This is the attraction review title!"; $newData->stars = 5;
        // $newData->save();

        // $newData = new bookReview(); $newData->userID = 1; $newData->bookID = 1; $newData->countryID = 1;
        // $newData->text = "This is the book review text!"; $newData->title = "This is the book review title!"; $newData->stars = 5;
        // $newData->save();

        // $newData = new foodReview(); $newData->userID = 1; $newData->foodID = 1; $newData->countryID = 1;
        // $newData->text = "This is the food review text!"; $newData->title = "This is the food review title!"; $newData->stars = 5;
        // $newData->save();

        // $newData = new User(); $newData->name = "Ethan"; $newData->email = "ethan@gmail.com"; $newData->password = "AAA";
        // $newData->save();

        // $newData = new country(); $newData->name = "Country1"; $newData->describer = "This is the info about Country1.";
        // $newData->save();

        $attractions = DB::table('attraction_reviews')->get();
        $books = DB::table('book_reviews')->get();
        $foods = DB::table('food_reviews')->get();
        $countries = DB::table('countries')->get();
        $users = DB::table('users')->select('id', 'name')->get();

        // Make this instead pull 3 random reviews
        // Requires:
        // User that posted it
        // Country it is for
        // It's own ID

        return view('review', compact('attractions', 'books', 'foods', 'users', 'countries'));
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
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
    public function getReviews($itemType, $itemID) {

        // $newData = new attractionReview(); $newData->userID = 1; $newData->attractionID = 1; $newData->countryID = 1;
        // $newData->text = "This is the attraction review text! But first!"; $newData->title = "This is the attraction review title! But First!"; $newData->stars = 5; 
        // $newData->save();
        
        // $newData = new attractionReview(); $newData->userID = 2; $newData->attractionID = 2; $newData->countryID = 2;
        // $newData->text = "This is the attraction review text! But second!"; $newData->title = "This is the attraction review title! But second!"; $newData->stars = 3;
        // $newData->save();

        // $newData = new attractionReview(); $newData->userID = 3; $newData->attractionID = 3; $newData->countryID = 3;
        // $newData->text = "This is the attraction review text! But third!"; $newData->title = "This is the attraction review title! But third!"; $newData->stars = 4;
        // $newData->save();

        // $newData = new bookReview(); $newData->userID = 1; $newData->bookID = 1; $newData->countryID = 1;
        // $newData->text = "This is the book review text! But first!"; $newData->title = "This is the book review title! But first!"; $newData->stars = 5;
        // $newData->save();

        // $newData = new bookReview(); $newData->userID = 2; $newData->bookID = 2; $newData->countryID = 2;
        // $newData->text = "This is the book review text! But second!"; $newData->title = "This is the book review title! But second!"; $newData->stars = 4;
        // $newData->save();

        // $newData = new bookReview(); $newData->userID = 3; $newData->bookID = 3; $newData->countryID = 3;
        // $newData->text = "This is the book review text! But third!"; $newData->title = "This is the book review title! But third!"; $newData->stars = 1;
        // $newData->save();

        // $newData = new foodReview(); $newData->userID = 1; $newData->foodID = 1; $newData->countryID = 1;
        // $newData->text = "This is the food review text! But first!"; $newData->title = "This is the food review title! But first!"; $newData->stars = 4;
        // $newData->save();

        // $newData = new foodReview(); $newData->userID = 2; $newData->foodID = 2; $newData->countryID = 2;
        // $newData->text = "This is the food review text! But second!"; $newData->title = "This is the food review title! But second!"; $newData->stars = 2;
        // $newData->save();

        // $newData = new foodReview(); $newData->userID = 3; $newData->foodID = 3; $newData->countryID = 3;
        // $newData->text = "This is the food review text! But third!"; $newData->title = "This is the food review title! But third!"; $newData->stars = 1;
        // $newData->save();

        // $newData = new User(); $newData->name = "Ethan"; $newData->email = "ethan@gmail.com"; $newData->password = "AAA";
        // $newData->save();

        // $newData = new User(); $newData->name = "Barbra"; $newData->email = "barbra@gmail.com"; $newData->password = "AAA";
        // $newData->save();

        // $newData = new User(); $newData->name = "Crazy Dave"; $newData->email = "pvzCrazyDave@gmail.com"; $newData->password = "AAA";
        // $newData->save();

        // $newData = new country(); $newData->name = "Country1"; $newData->describer = "This is the info about Country1."; $newData->imgURL = "Test URL";
        // $newData->save();

        // $newData = new country(); $newData->name = "Country2"; $newData->describer = "This is the info about Country2."; $newData->imgURL = "Test URL";
        // $newData->save();

        // $newData = new country(); $newData->name = "Country2"; $newData->describer = "This is the info about Country2."; $newData->imgURL = "Test URL";
        // $newData->save();

        // $newData = new book(); $newData->name = "Book1"; $newData->describer = "This is the info about Book1.";
        // $newData->imgURL = "https://i.pinimg.com/736x/be/31/d7/be31d7e4e3c7b60d1fd058f4fde5abad.jpg"; $newData->publisher = "Ethan";
        // $newData->save();

        $countries = DB::table('countries')->get();
        $users = DB::table('users')->select('id', 'name')->get();
        $avgStars = 0.0;
        if ($itemType == "attraction") {
            $attractions = DB::table('attraction_reviews')->where('id', $itemID)->get();
            $books = DB::table('book_reviews')->where('id', -1)->get(); // Dummy data
            $foods = DB::table('food_reviews')->where('id', -1)->get(); // Dummy data
            $itemName = DB::table('attractions')->where('id', $itemID)->get()->pluck('name');
            for ($i = 0; $i < sizeOf($attractions); $i++) {$avgStars += $attractions[$i]->stars;}
            $avgStars /= sizeOf($attractions);
        }

        if ($itemType == "book") {
            $attractions = DB::table('attraction_reviews')->where('id', -1)->get(); // Dummy data
            $books = DB::table('book_reviews')->where('bookID', $itemID)->get();
            $foods = DB::table('food_reviews')->where('id', -1)->get(); // Dummy data
            $itemName = DB::table('books')->where('id', $itemID)->get()->pluck('name');
            for ($i = 0; $i < sizeOf($books); $i++) {$avgStars += $books[$i]->stars;}
            $avgStars /= sizeOf($books);
        }

        if ($itemType == "food") {
            $attractions = DB::table('attraction_reviews')->where('id', -1)->get(); // Dummy data
            $books = DB::table('book_reviews')->where('id', -1)->get(); // Dummy data
            $foods = DB::table('food_reviews')->where('id', $itemID)->get();
            $itemName = DB::table('foods')->where('id', $itemID)->get()->pluck('name');
            for ($i = 0; $i < sizeOf($foods); $i++) {$avgStars += $foods[$i]->stars;}
            $avgStars /= sizeOf($foods);
        }

        $avgStars = number_format((float) $avgStars, 1, '.', '');
        return view('auth.review', compact('attractions', 'books', 'foods', 'users', 'countries', 'itemName', 'avgStars'));
    }

    public function getAttractReviews() {
        $attractions = DB::table('attraction_review')->get();
        return view('auth.review', compact('attractions'));
    }

    public function getBookReviews() {
        $book = DB::table('book_review')->get();
        return view('auth.review', compact('book'));
    }

    public function getFoodReviews() {
        $food = DB::table('food_review')->get();
        return view('auth.review', compact('food'));
    }

}
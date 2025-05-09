<?php

namespace App\Http\Controllers;

use App\Models\cr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\book;
use App\Models\bookReview;
use App\Models\food;
use App\Models\foodReview;
use App\Models\attraction;
use App\Models\attractionReview;
use App\Models\price;

use App\Models\User;
use App\Models\country;

class ItemsController extends Controller
{
    public function loadBook($id)
    {
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

        // ---------------------------------------------------------------------------------------------------------------------------

        // $newData = new book(); $newData->name = "Book1"; $newData->describer = "This is the info about Book1.";
        // $newData->imgURL = "https://i.pinimg.com/736x/be/31/d7/be31d7e4e3c7b60d1fd058f4fde5abad.jpg"; $newData->publisher = "Ethan"; $newData->countryID = 0;
        // $newData->save();

        // $newData = new price(); $newData->itemType = book;  $newData->itemID = 1; $newData->price = 6.00; $newData->discount = 0;
        // $newData->save();

        // $newData = new bookReview(); $newData->userID = 2; $newData->bookID = 1; $newData->countryID = 1;
        // $newData->text = "This is a great book!"; $newData->title = "Good book!"; $newData->stars = 5;
        // $newData->save();

        // $newData = new bookReview(); $newData->userID = 3; $newData->bookID = 1; $newData->countryID = 1;
        // $newData->text = "Meh could have been better..."; $newData->title = "Okay I guess"; $newData->stars = 3;
        // $newData->save();

        // $newData = new bookReview(); $newData->userID = 1; $newData->bookID = 1; $newData->countryID = 1;
        // $newData->text = "Found this and it was a really great read! (Duplicate ignore user duplication)"; $newData->title = "DUPLICATE TESTING REVIEW"; $newData->stars = 3;
        // $newData->save();

        $book = DB::table('books')->where('id', $id)->get();
        $books = DB::table('book_reviews')->where('bookID', $id)->get();
        $users = DB::table('users')->select('id', 'name')->get();

        $avgStars = 0.0;
        for ($i = 0; $i < sizeOf($books); $i++) {$avgStars += $books[$i]->stars;}
        $avgStars /= sizeOf($books);
        $avgStars = number_format((float) $avgStars, 1, '.', '');

        if ($books) {
            $reviewOne = $books[0];
            $reviewTwo = $books[1];
            $reviewThree = $books[2];
        }

        return view('auth.books', compact('book', 'books', 'users', 'reviewOne', 'reviewTwo', 'reviewThree', 'avgStars'));
    }

    public function loadFood($id)
    {
        // $newData = new foodReview(); $newData->userID = 1; $newData->foodID = 1; $newData->countryID = 1;
        // $newData->text = "This is the food review text! But second!"; $newData->title = "This is the food review title! But second!"; $newData->stars = 4;
        // $newData->save();

        // $newData = new foodReview(); $newData->userID = 1; $newData->foodID = 1; $newData->countryID = 1;
        // $newData->text = "This is the food review text! But third!"; $newData->title = "This is the food review title! But third!"; $newData->stars = 4;
        // $newData->save();

        $food = DB::table('foods')->where('id', $id)->get();
        $foods = DB::table('food_reviews')->where('foodID', $id)->get();
        $users = DB::table('users')->select('id', 'name')->get();

        $avgStars = 0.0;
        for ($i = 0; $i < sizeOf($foods); $i++) {$avgStars += $foods[$i]->stars;}
        $avgStars /= sizeOf($foods);
        $avgStars = number_format((float) $avgStars, 1, '.', '');

        if ($foods) {
            $reviewOne = $foods[0];
            $reviewTwo = $foods[1];
            $reviewThree = $foods[2];
        }

        return view('auth.foods', compact('food', 'foods', 'users', 'reviewOne', 'reviewTwo', 'reviewThree', 'avgStars'));
    }

    public function loadAttraction($id)
    {
        $attraction = DB::table('attractions')->where('id', $id)->get();
        $attractions = DB::table('attraction_reviews')->where('attractionID', $id)->get();
        $users = DB::table('users')->select('id', 'name')->get();

        $avgStars = 0.0;
        for ($i = 0; $i < sizeOf($attractions); $i++) {$avgStars += $attractions[$i]->stars;}
        $avgStars /= sizeOf($attractions);
        $avgStars = number_format((float) $avgStars, 1, '.', '');

        if ($attractions) {
            $reviewOne = $attractions[0];
            $reviewTwo = $attractions[1];
            $reviewThree = $attractions[2];
        }

        return view('auth.attractions', compact('attraction', 'attractions', 'users', 'reviewOne', 'reviewTwo', 'reviewThree', 'avgStars'));
    }

    public function createBookReview(Request $request, $id)
    {
        $book = DB::table('books')->where('id', $id)->get();
        $books = DB::table('book_reviews')->where('bookID', $id)->get();
        $check = DB::table('book_reviews')->where('userID', Session::has('loginId'))->get();
        if (count($check) == 0) {
            $newData = new bookReview();
            $newData->userID = 1;
            $newData->bookID = $id;
            $newData->countryID = $book[0]->countryID;
            $newData->text = $request->text;
            $newData->title = $request->title;
            $newData->stars = $request->stars;
            $newData->save();
        }

        else {
            Session::flash('error_message', 'You have already made a review for this book.');
        }

        return redirect("/book/{$id}");
    }

    public function createFoodReview(Request $request, $id)
    {
        $food = DB::table('foods')->where('id', $id)->get();
        $foods = DB::table('food_reviews')->where('bookID', $id)->get();
        $check = DB::table('food_reviews')->where('userID', Session::has('loginId'))->get();
        if (count($check) == 0) {
            $newData = new foodReview();
            $newData->userID = 1;
            $newData->attractionID = $id;
            $newData->countryID = $food[0]->countryID;
            $newData->text = $request->text;
            $newData->title = $request->title;
            $newData->stars = $request->stars;
            $newData->save();
        }
        
        else {
            Session::flash('error_message', 'You have already made a review for this book.');
        }

        return redirect("/food/{$id}");
    }

    public function createAttractionReview(Request $request, $id)
    {
        $attraction = DB::table('attractions')->where('id', $id)->get();
        $attractions = DB::table('attractions_reviews')->where('bookID', $id)->get();
        $check = DB::table('attractions_reviews')->where('userID', Session::has('loginId'))->get();
        if (count($check) == 0) {
            $newData = new attractionReview();
            $newData->userID = 1;
            $newData->foodID = $id;
            $newData->countryID = $attraction[0]->countryID;
            $newData->text = $request->text;
            $newData->title = $request->title;
            $newData->stars = $request->stars;
            $newData->save();
        }
        
        else {
            Session::flash('error_message', 'You have already made a review for this book.');
        }

        return redirect("/attraction/{$id}");
    }

    public function loadPurchaseBook(Request $request, $id) {
        $book = DB::table('books')->where('id', $id)->get();
        $books = DB::table('book_reviews')->where('bookID', $id)->get();
        $users = DB::table('users')->select('id', 'name')->get();

        $avgStars = 0.0;
        for ($i = 0; $i < sizeOf($books); $i++) {$avgStars += $books[$i]->stars;}
        $avgStars /= sizeOf($books);
        $avgStars = number_format((float) $avgStars, 1, '.', '');

        return view('auth.purchaseBook', compact('book', 'books', 'users', 'avgStars'));
    }

}

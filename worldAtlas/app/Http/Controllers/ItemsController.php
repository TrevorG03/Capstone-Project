<?php

namespace App\Http\Controllers;

use App\Models\cr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\book;
use App\Models\bookReview;

use App\Models\User;
use App\Models\country;
use App\Models\attractionReview;
use App\Models\foodReview;

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

    public function createReview(Request $request, $id)
    {
        $book = DB::table('books')->where('id', $id)->get();
        $books = DB::table('book_reviews')->where('bookID', $id)->get();

        $newData = new bookReview();
        $newData->userID = 1;
        $newData->bookID = $id;
        $newData->countryID = $book[0]->countryID;
        $newData->text = $request->text;
        $newData->title = $request->title;
        $newData->stars = $request->stars;
        $newData->save();

        return redirect("/review/book/{$id}");
    }

}

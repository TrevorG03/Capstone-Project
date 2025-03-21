<?php

namespace App\Http\Controllers;

use App\Models\cr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\country;
use App\Models\attractionReview;
use App\Models\bookReview;
use App\Models\foodReview;
use App\Models\book;

class ItemsController extends Controller
{
    public function loadBook($id)
    {

        // $newData = new book(); $newData->name = "Book1"; $newData->describer = "This is the info about Book1.";
        // $newData->imgURL = "https://i.pinimg.com/736x/be/31/d7/be31d7e4e3c7b60d1fd058f4fde5abad.jpg"; $newData->publisher = "Ethan";
        // $newData->save();

        $book = DB::table('books')->where('id', $id)->get();
        return view('auth.books', compact('book'));
    }

}

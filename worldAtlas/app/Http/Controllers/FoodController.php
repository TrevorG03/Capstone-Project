<?php

namespace App\Http\Controllers;

use App\Models\food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function foodHome()
    {
        return view('food');
    }

    public function foodEntryForm(){
        return view('foodEntryForm');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'countryName' => 'required|string',
            'continentName' => 'required|string',
            'describer' => 'required|string',
            'publisher' => 'required|string',
            'foodImg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        //file upload
        if($request->hasFile('foodImg')){
            $imagePath = $request->file('foodImg')->store();  
        }




    }

    /**
     * Display the specified resource.
     */
    public function show(food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(food $food)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, food $food)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(food $food)
    {
        //
    }
}

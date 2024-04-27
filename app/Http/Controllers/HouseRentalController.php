<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HouseRental;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HouseRentalController extends Controller
{
    public function index()
    {
        return HouseRental::with('user')->with('rentalReviews')->paginate(30);
    }

    public function create()
    {
        //return the form
    }

    public function store(Request $request)
    {
        //store
        $validatedData = $request->validate([
            'user_id'  => 'required|integer|min:1|max:16',
            'name' => 'required|string|min:1|max:64',
            'description' => 'required|string|min:1|max:2048',
            'address' => 'required|string|min:1|max:128',
            'monthly_rent' => 'required|numeric',
            'maximum_occupants' => 'required|integer',
            'image' => 'required|mimes:jpg,png,svg,jpeg',
        ]);

        $rental = new HouseRental($validatedData);

        if($request->hasFile('image'))
        {
            $picture = $request->file('image');
            $filename = time() . '-' . $picture->getClientOriginalName();

            Storage::disk('public')->put('houseRentals/' . $filename, file_get_contents($picture));

            $rental->image = $filename;
        }

        $rental->save();
        
        return response()->json(['success' => 'item has been created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return HouseRental::with('user')->with('rentalReviews')->findorfail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //temporary
        $rental = HouseRental::with('user')->with('rentalReviews')->findorfail($id);
        return $rental;
    }


    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'user_id'  => 'required|integer|min:1|max:16',
            'name' => 'required|string|min:1|max:64',
            'description' => 'required|string|min:1|max:2048',
            'address' => 'required|string|min:1|max:128',
            'monthly_rent' => 'required|numeric',
            'maximum_occupants' => 'required|integer',
            'image' => 'required|mimes:jpg,png,svg,jpeg',
        ]);

        $rental = HouseRental::findorfail($id);

        $rental->update($validatedData);

        if($request->hasFile('image'))
        {
            $picture = $request->file('image');
            $filename = time() . '-' . $picture->getClientOriginalName();

            Storage::disk('public')->put('houseRentals/' . $filename, file_get_contents($picture));

            $rental->image = $filename;
        }

        $rental->save();
        
        return response()->json(['success' => 'item has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        HouseRental::findorfail($id)->delete();

        return "Item has been deleted";
    }
}

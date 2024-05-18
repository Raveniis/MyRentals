<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HouseRental;
use App\Models\RentalReview;
use GuzzleHttp\Psr7\Query;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HouseRentalController extends Controller
{
    public function getRentals() {
        $houseRentals = HouseRental::with('user', 'rentalReviews')->get();

        return view('user.main.index')->with('houseRentals', $houseRentals);
    }

    public function viewRentals($id){
        $houseRental = HouseRental::with('user', 'rentalReviews', 'rentalReviews.user')->findorfail($id);

        $ratings = 0;

        foreach ($houseRental->rentalReviews as $review) {
            $ratings += $review->ratings;
        }

        $averageRating = count($houseRental->rentalReviews) > 0 ? $ratings / count($houseRental->rentalReviews) : 0;

        $data = compact('houseRental', 'averageRating');

        return view('user.main.houseRental', $data);
    }

    public function index()
    {
        $user_id = auth()->user()->id;

        $houseRental = HouseRental::whereHas('user', function($query) use ($user_id) {
            $query->where('id', $user_id);
        })->with('rentalReviews')->paginate(10);

        return view('landowner.main.listings')->with('houseRentals',  $houseRental);
    }

    public function create()
    {
        return view('landowner.main.addRentals');
    }

    public function store(Request $request)
    {
        //store
        $request->validate([
            'name' => 'required|string|min:1|max:64',
            'description' => 'required|string|min:1|max:2048',
            'address' => 'required|string|min:1|max:128',
            'monthly_rent' => 'required|numeric|gt:0',
            'maximum_occupants' => 'required|integer|gt:0|max:32',
            'image' => 'required|mimes:jpg,png,svg,jpeg',
        ]);

        $rental = new HouseRental($request->all());

        $rental->user_id = auth()->user()->id;

        if($request->hasFile('image'))
        {
            $picture = $request->file('image');
            $filename = time() . '-' . $picture->getClientOriginalName();

            Storage::disk('public')->put('houseRentals/' . $filename, file_get_contents($picture));

            $rental->image = 'storage/houseRentals/' . $filename;
        }

        $rental->save();
        
        return redirect(route('addRentals'))->with("success", "Rentals has been added");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $houseRental =  HouseRental::with('user')->with('rentalReviews')->findorfail($id);

        return view('landowner.main.editRentals')->with('houseRental', $houseRental);
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
            'name' => 'required|string|min:1|max:64',
            'description' => 'required|string|min:1|max:2048',
            'address' => 'required|string|min:1|max:128',
            'monthly_rent' => 'required|numeric|gt:0',
            'maximum_occupants' => 'required|integer|gt:0',
            'image' => 'nullable|mimes:jpg,png,svg,jpeg',
        ]);

        $rental = HouseRental::findorfail($id);

        $rental->update($validatedData);

        if($request->hasFile('image'))
        {
            $picture = $request->file('image');
            $filename = time() . '-' . $picture->getClientOriginalName();

            Storage::disk('public')->put('houseRentals/' . $filename, file_get_contents($picture));

            $rental->image = 'storage/houseRentals/' . $filename;
        }

        $rental->save();
        
        return redirect(route('editRentals', ['id' => $id]))->with("success", "Rentals has been updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        HouseRental::findorfail($id)->delete();

        return redirect(route('listings'))->with('success', 'item has been deleted');
    }
}

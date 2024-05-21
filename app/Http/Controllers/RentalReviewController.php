<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalReview;
use App\Models\HouseRental;

class RentalReviewController extends Controller
{
    public function reviewForm($id) {
        $houserental = HouseRental::findorfail($id);

        return view('user.main.rating')->with('houserental', $houserental);
    }

    public function review(Request $request, $id) {
        HouseRental::findorfail($id);
        
        $user_id = auth()->user()->id;

        $validatedData = $request->validate([
            // 'reviewed_by'  => 'required|integer|min:1|max:16',
            'ratings' => 'required|numeric|between:1,5',
            'comment' => 'required|string|min:1|max:128',
        ]);

        $review = New RentalReview($validatedData);
        $review->reviewed_by = $user_id;
        $review->rental_id = $id;
        $review->save();

        return redirect(route('userTenant'))->with('success', 'yey');
    }

    public function edit(Request $request, $id) {
        RentalReview::findorfail($id);
        
        $validatedData = $request->validate([
            'ratings' => 'required|numeric|between:1,5',
            'comment' => 'required|string|min:1|max:128',
        ]);


        $review = RentalReview::findorfail($id);
        $review->update($validatedData);

        return response()->json(['success' => 'review has been updated']);
    }

    public function delete($id) {
        RentalReview::findorfail($id)->delete();

        return response()->json(['success' => 'review has been deleted']);
    }
}

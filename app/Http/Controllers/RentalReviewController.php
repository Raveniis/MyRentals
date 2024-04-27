<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalReview;
use App\Models\HouseRental;

class RentalReviewController extends Controller
{
    public function review(Request $request, $id) {
        HouseRental::findorfail($id);

        $validatedData = $request->validate([
            'reviewed_by'  => 'required|integer|min:1|max:16',
            'ratings' => 'required|numeric|between:1,5',
            'comment' => 'required|string|min:1|max:128',
        ]);

        $review = New RentalReview($validatedData);
        // $review->reviewed_by = Auth()->user->id;
        $review->rental_id = $id;
        $review->save();

        return response()->json(['success' => 'House rental has been reviewed']);
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

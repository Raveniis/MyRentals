<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile() {
        return view('landowner.main.profile');
    }

    public function update(Request $request) {
        $request->validate([
            'firstname' => 'required|string|max:128',
            'lastname' => 'required|string|max:128',
            'contact_num' => 'required|size:11|regex:/(09)[0-9]{9}/',
            'address' => 'required|string|max:128',
            'birthdate' => 'required|date|before:18 years ago',
            'image' => 'nullable|mimes:jpg,png,svg,jpeg',
        ]);

        
        $user_id = Auth()->user()->id;

        $userProfile = User::findorfail($user_id);

        $userProfile->update($request->all());

        if($request->hasFile('image'))
        {
            $picture = $request->file('image');
            $filename = $user_id . '-' . $picture->getClientOriginalName();

            Storage::disk('public')->put('profilePic/' . $filename, file_get_contents($picture));

            $userProfile->profile_pic = "storage/profilePic/" . $filename;
        }

        $userProfile->save();
        
        return redirect(route('profile'))->with('success', 'profile has been updated');
    }
}

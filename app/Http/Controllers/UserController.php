<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();

        // Delete old profile picture if exists
        if ($user->profile_picture) {
            $oldImage = str_replace(url('storage') . '/', '', $user->profile_picture);
            Storage::disk('public')->delete($oldImage);
        }

        // Store new image
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        // Update user profile picture (store only the relative path)
        $user->profile_picture = $path;
        $user->save();

        return response()->json([
            'success' => true,
            'profile_picture' => asset("storage/" . $path), // Correct URL format
            'message' => 'Profile picture updated successfully.'
        ]);
    }


    public function updatePhone(Request $request)
    {
        $request->validate([
            'phone' => 'unique:users,phone|required|string|max:15'
        ]);

        $user = Auth::user();
        $user->phone = $request->phone;
        $user->save();

        return response()->json(['success' => true, 'phone' => $user->phone]);
    }

    public function updateAddress(Request $request)
    {
        $validated = $request->validate([
            'street' => 'required|string',
            'house_number' => 'required|string',
            'barangay' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
        ]);

        // Save to database (assuming user has an Address model)
        $address = Auth::user()->address()->updateOrCreate(['user_id' => Auth::id()], $validated);


        return response()->json(['success' => true, 'address' => $address->barangay]);
    }
}

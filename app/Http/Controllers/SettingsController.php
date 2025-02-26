<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Adone;
use App\Models\Adtwo;
use App\Models\Brand;
use App\Models\Member;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class SettingsController extends Controller
{
    public function brandstore(Request $request)
    {
        // Validate input
        $request->validate([
            'brand_name' => 'required|string|max:255|unique:brands,brand_name',
        ]);

        // Store in database
        Brand::create([
            'brand_name' => $request->brand_name,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Brand added successfully!');
    }

    public function branddestroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->back()->with('success', 'Brand deleted successfully!');
    }

    public function categorystore(Request $request)
    {
        // Validate input
        $request->validate([
            'category_name' => 'required|string|max:255|unique:category,category_name',
        ]);

        // Store in database
        Categories::create([
            'category_name' => $request->category_name,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Category added successfully!');
    }

    public function categorydestroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }

    public function unitstore(Request $request)
    {
        // Validate input
        $request->validate([
            'unit_type' => 'required|string|max:255|unique:units,unit_type',
        ]);

        // Store in database
        Unit::create([
            'unit_type' => $request->unit_type,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Unit added successfully!');
    }

    public function unitdestroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return redirect()->back()->with('success', 'Unit deleted successfully!');
    }

    public function memberstore(Request $request)
    {
        // Validate input
        $request->validate([
            'member_name' => 'required|string|max:255|unique:members,name',
            'position' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('members', 'public'); // Save to storage/app/public/members
        } else {
            $imagePath = null; // Optional: Set a default image if needed
        }

        // Store in database
        Member::create([
            'name' => $request->member_name,
            'position' => $request->position,
            'image' => $imagePath,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Member added successfully!');
    }

    public function memberdestroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->back()->with('success', 'Member deleted successfully!');
    }


    public function poststore(Request $request)
    {
        $request->validate([
            'desc' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $upload = $request->file('image');
            $image = Image::read($upload)->resize(1920, 1080); // Resize the image to desired dimensions

            // Generate a unique filename
            $filename = Str::random(40) . '.' . $upload->getClientOriginalExtension();

            // Define the storage path for the image
            $path = 'post/' . $filename;

            // Store the image in the storage directory (using the default disk)
            Storage::disk('public')->put($path, (string) $image->encode());

            // Store the path in the database
            $imagePath = '' . $path; // Make sure it’s relative to the 'public' disk path
        } else {
            $imagePath = null; // Or a default image path if you have one
        }

        Adone::create([
            'desc' => $request->desc,
            'image' => $imagePath, // Store the image path
        ]);

        return redirect()->back()->with('post', 'Posted successfully!');
    }



    public function postdestroy($id)
    {
        $adone = Adone::findOrFail($id);
        $adone->delete();

        return redirect()->back()->with('posterror', 'Post deleted successfully!');
    }

    public function showChangePasswordForm()
    {
        if (!auth()->guard('admin')->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/admin/login')->with('message', 'Unauthorized access detected!');
        }

        return view('adminchange');
    }

    public function gallerystore(Request $request)
    {
        $request->validate([
            'desc' => 'string|max:255|nullable',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $upload = $request->file('image');
            $image = Image::read($upload)->resize(1920, 1080); // Resize the image to desired dimensions

            // Generate a unique filename
            $filename = Str::random(40) . '.' . $upload->getClientOriginalExtension();

            // Define the storage path for the image
            $path = 'post/' . $filename;

            // Store the image in the storage directory (using the default disk)
            Storage::disk('public')->put($path, (string) $image->encode());

            // Store the path in the database
            $imagePath = '' . $path; // Make sure it’s relative to the 'public' disk path
        } else {
            $imagePath = null; // Or a default image path if you have one
        }

        Adtwo::create([
            'desc' => $request->desc,
            'image' => $imagePath, // Store the image path
        ]);

        return redirect()->back()->with('gallery', 'Posted successfully!');
    }

    public function gallerydestroy($id)
    {
        $adtwo = Adtwo::findOrFail($id);
        $adtwo->delete();

        return redirect()->back()->with('galleryerror', 'Gallery deleted successfully!');
    }

    //show users lists
    public function showusers(){
        $users = User::all(); // Fetch all users from the database
        return view('users', compact('users'));
    }
}

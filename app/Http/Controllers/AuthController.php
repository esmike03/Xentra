<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Adone;
use App\Models\Adtwo;
use App\Models\Order;
use App\Models\Member;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function admin()
    {
        if (!auth()->guard('admin')->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/admin/login')->with('message', 'Please log in to access this page.');
        }

        $users = User::all();

        // Count distinct customers who placed orders
        $customerCount = Order::distinct('user_id')->count('user_id');
        $userCount = User::count();
        $messageCount = Message::count();
        return view('admin', compact('customerCount', 'userCount', 'messageCount'));
    }

    public function content()
    {
        if (!auth()->guard('admin')->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/admin/login')->with('message', 'Please log in to access this page.');
        }

        $members = Member::latest()->paginate(2);
        $adone = Adone::latest()->paginate(2);
        $adtwo = Adtwo::latest()->paginate(2);
        return view('content', compact('members', 'adone', 'adtwo'));
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/'); // Redirect to dashboard or any other page
        }
        return view('login');
    }

    public function adminauth(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['name' => $request->name, 'password' => $request->password], $request->remember)) {
            $customerCount = Order::distinct('user_id')->count('user_id');
            $userCount = User::count();
            $messageCount = Message::count();
            return view('admin', compact('customerCount', 'userCount', 'messageCount')); // Redirect to admin dashboard
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    //user login
    // Handle login
    public function login(Request $request)
    {
        // Validate user input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Redirect to dashboard (or any intended page)
            return redirect()->intended('/products');
        }

        // Return error message if login fails
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:11',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create new user
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Log in user
        Auth::login($user);
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;
        $adone = Adone::all();
        $products = Product::all();
        // Redirect to home/dashboard
        return view('index', compact('cartCount', 'adone', 'products'));
    }


    public function adminupdatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Incorrect current password']);
        }

        // Update password
        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password successfully changed');
    }
}

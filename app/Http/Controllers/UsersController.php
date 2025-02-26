<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function showProfile(){

        if (!auth()->check()) {
            return redirect('/login')->with('message', 'Please Login to view carts!');
        }
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;
        $ordersCount = Order::where('user_id', Auth::id())->count();
        return view('userprofile', compact('ordersCount', 'cartCount'));
    }
}

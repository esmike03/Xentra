<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function submitOrder(Request $request)
    {
        try {
            $user = Auth::user(); // Ensure the user is authenticated

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
            }

            $cartItems = Cart::where('user_id', $user->id)->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Cart is empty']);
            }

            foreach ($cartItems as $item) {
                Order::create([
                    'user_id' => $user->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'status' => 'pending',
                ]);
            }

            // Clear the cart after placing the order
            Cart::where('user_id', $user->id)->delete();

            return response()->json(['success' => true, 'message' => 'Order placed successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    public function adminOrder()
    {
        if (!auth()->guard('admin')->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/admin/login')->with('message', 'Please log in to access this page.');
        }

        $orders = Order::with('user', 'product')->get()->groupBy('user_id');  // Fetch orders with user and product details
        return view('adminorders', compact('orders'));
    }

    public function userOrders()
    {
        $orders = Order::with('product')->where('user_id', auth()->id())->get()->groupBy('id');
        return view('userorders', compact('orders'));
    }
}

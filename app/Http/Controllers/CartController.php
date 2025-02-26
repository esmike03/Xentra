<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Store in the cart table
        Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->product_id
            ],
            [
                'quantity' => \DB::raw("{$request->quantity}")
            ]
        );

        return response()->json(['message' => 'Added to cart successfully!']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('id', $request->cart_id)->where('user_id', auth()->id())->first();

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Cart item not found']);
        }

        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json(['success' => true, 'message' => 'Quantity updated']);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
        ]);

        $cart = Cart::where('id', $request->cart_id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Item not found']);
        }

        $cart->delete();

        return response()->json(['success' => true, 'message' => 'Item removed from cart']);
    }
}

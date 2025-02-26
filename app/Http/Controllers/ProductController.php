<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class ProductController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            // 'price' => 'required|numeric',
            // 'stocks' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5000',
            'details' => 'nullable|string',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'brand' => $request->brand,
            'unit' => $request->unit,
            // 'price' => $request->price,
            // 'stocks' => $request->stocks,
            'image' => $imagePath,
            'details' => $request->details,
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function products(Request $request)
    {
        $query = Product::query();

        // Get unique categories and brands for the filter dropdowns
        $categories = Product::pluck('category')->unique();
        $brands = Product::pluck('brand')->unique();

        // Apply search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Apply category filter if selected
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Apply brand filter if selected
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        // Get filtered products
        $products = $query->get();

        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('products', compact('products', 'categories', 'brands', 'cartCount'));
    }

    public function showCarts(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('message', 'Please Login to view carts!');
        }

        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        // Get the authenticated user
        $user = Auth::user();

        // Fetch only cart items belonging to the logged-in user
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();


        return view('cart', compact('cartItems', 'cartCount'));
    }

    public function modifyproducts(Request $request)
    {

        if (!auth()->guard('admin')->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/admin/login')->with('message', 'Unauthorized access detected!');
        }
        $query = Product::query();

        // Get unique categories and brands for the filter dropdowns
        $categories = Product::pluck('category')->unique();
        $brands = Product::pluck('brand')->unique();

        // Apply search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Apply category filter if selected
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Apply brand filter if selected
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        // Get filtered products
        $products = $query->get();
        // $products = Product::all(); // Fetch all products
        return view('modifyproducts', compact('products', 'categories', 'brands'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ]);

        try {
            Excel::import(new ProductsImport, $request->file('file'));

            return redirect()->back()->with('success', 'Products imported successfully!');
        } catch (ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];

            foreach ($failures as $failure) {
                $errorMessages[] = "Row {$failure->row()}: " . implode(', ', $failure->errors());
            }

            return redirect()->back()->with('error', implode('<br>', $errorMessages));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error importing the file. Please check the format.');
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'An error occured!');
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}

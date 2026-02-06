<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;

class UserController extends Controller
{
    // Home page
    public function index()
    {
        if (Auth::check()) {
            // Logged-in users → Admin dashboard
            return view('Admin.dashboard');
        } else {
            // Guests → welcome page with all products
            $products = Product::with('category')->latest()->get();
            return view('welcome', compact('products'));
        }
    }

    // Products listing page (optional)
    public function products()
    {
        $products = Product::with('category')->latest()->get();
        return view('User.Products', compact('products'));
    }

    // Product details page
    public function details($id)
    {
        $product = Product::with('category')->findOrFail($id);

        // Calculate discounted price
        $discountedPrice = $product->product_price - ($product->product_price * $product->discount / 100);

        // Related products (same category, excluding current)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(6)
            ->get();

        // Pass variables to the ProductDetails view
        return view('User.ProductDetails', compact('product', 'discountedPrice', 'relatedProducts'));
    }

    public function checkout($id)
    {
        $product = Product::findOrFail($id);

        $discount = $product->product_price * ($product->discount / 100);
        $discountedPrice = $product->product_price - $discount;

        return view('User.checkout', compact('product', 'discountedPrice', 'discount'));
    }

}

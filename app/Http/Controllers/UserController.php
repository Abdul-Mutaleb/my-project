<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // Login user → Admin dashboard
            return view('Admin.dashboard');
        } else {
            // Guest → welcome page with products
            $products = Product::with('category')->latest()->get();
            return view('welcome', compact('products'));
        }
    }

    public function details($id)
{
    $product = Product::with('category')->findOrFail($id);

    $discountedPrice = $product->product_price -
        ($product->product_price * $product->discount / 100);

    // RELATED PRODUCTS
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->latest()
        ->take(6)
        ->get();

    return view(
        'User.ProductDetails',
        compact('product', 'discountedPrice', 'relatedProducts')
    );
}

}

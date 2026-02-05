<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

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

    public function details(){
        return view('User.productDetails');
    }
}

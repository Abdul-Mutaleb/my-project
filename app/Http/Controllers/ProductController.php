<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); 
        return view("Admin.addProduct", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
    {
        // Validate form
        $request->validate([
            'product_name'  => 'required|string|max:255|unique:products,product_name',
            'category_id'   => 'required|exists:categories,id',
            'product_price' => 'required|numeric',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Auto-generate product number
        $product_number = 'PROD-' . strtoupper(Str::random(8));

        // Prepare product data
        $data = [
            'product_number' => $product_number,
            'product_name'   => $request->product_name,
            'category_id'    => $request->category_id,
            'product_price'  => $request->product_price
        ];

        // Handle image upload
        if ($request->hasFile('product_image')) {
            $data['product_image'] = $request->file('product_image')->store('products', 'public');
        }

        // Insert product
        Product::create($data);

        return redirect()->back()->with('success', 'Product added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
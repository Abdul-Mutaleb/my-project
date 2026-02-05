<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          return view('Admin.addCategory'); 
    }


    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
         
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
        [
            'category_name' => 'required|string|max:255',
        ],
        [
            'category_name.required' => 'Category name is required.',
            'category_name.string'   => 'Category name must be a valid text.',
            'category_name.max'      => 'Category name cannot be longer than 255 characters.',
        ]
    );

    Category::create([
        'category_name' => $request->category_name,
    ]);

    return redirect()->back()->with('success', 'Category added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
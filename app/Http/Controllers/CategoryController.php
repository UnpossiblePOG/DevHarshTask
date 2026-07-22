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
        $categories = Category::all();
        //compact() is php function which creates and array with respective key and existing value from the variables
        //Example: compact('categories') is equivalent to ['categories' => $categories]
        return view('categories.index', compact('categories'));
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
        //validate() is a method that validates the incoming request data
        $request->validate(['name' => 'required|string|unique:categories,name|max:255']);
        Category::create($request->only('name'));
        return redirect()->back()->with('success', 'Category added.');
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
        // Validates the updated category name and makes sure it stays unique.
        // It updates the category name and redirects back with a success message.
        $request->validate(['name' => 'required|string|max:255|unique:categories,name,' . $category->id]);
        $category->update($request->only('name'));
        return redirect()->back()->with('success', 'Category updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Deletes the category record from the database.
        // Redirects back to the previous page with a deletion notice.
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted.');
    }
}

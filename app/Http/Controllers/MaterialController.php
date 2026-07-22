<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Category;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource. Step 3
     */
    public function index()
    {
        $materials = Material::with('category', 'transactions')->get();
        //The with() method tells Eloquent to load the 'category' and 'transactions' relationships for each material.
        return view('materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource. Step 1
     */
    public function create()
    {
        // Fetches all categories so the user can select one when creating a material.
        // It renders the materials.create form view.
        $categories = Category::all();
        return view('materials.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage. Step 1 
     */
    public function store(Request $request)
    {
        // Validates category, alphanumeric name, and opening balance (max 2 decimals).
        // Creates the new material and redirects to index with success message.
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/', 
            'opening_balance' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', // Max 2 decimals
        ]);

        Material::create($request->all());

        return redirect()->route('materials.index')->with('success', 'Material created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        // Fetches all categories along with the selected material to populate the edit form.
        // Passes both variables to materials.edit view.
        $categories = Category::all();
        return view('materials.edit', compact('material', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        // Validates input fields before modifying the material record.
        // Updates category, name, and opening balance in database.
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'opening_balance' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $material->update($request->only('category_id', 'name', 'opening_balance'));

        return redirect()->route('materials.index')->with('success', 'Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        // Soft deletes the material so it can be restored later if needed.
        // Redirects to inventory list with soft delete confirmation.
        $material->delete();
        return redirect()->route('materials.index')->with('success', 'Material soft deleted.');
    }
}

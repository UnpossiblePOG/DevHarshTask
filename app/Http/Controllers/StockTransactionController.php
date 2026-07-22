<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{
    /**
     * Display a listing of the resource. Step 2
     */
    public function index()
    {
        // Loads categories to display initial dropdown options for stock entries.
        // Renders the transactions.create view.
        $categories = Category::all();
        return view('transactions.create', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Loads categories list for selecting a material category.
        // Opens the inward/outward quantity form view.
        $categories = Category::all();
        return view('transactions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validates selected category, material, transaction date, and quantity (+/- float).
        // Records the stock inward or outward transaction entry into database.
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'material_id' => 'required|exists:materials,id',
            'transaction_date' => 'required|date',
            'quantity' => 'required|numeric|regex:/^-?\d+(\.\d{1,2})?$/', // Accepts positive and negative floats
        ]);

        StockTransaction::create([
            'material_id' => $request->material_id,
            'transaction_date' => $request->transaction_date,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('materials.index')->with('success', 'Stock inward/outward saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockTransaction $stockTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockTransaction $stockTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockTransaction $stockTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockTransaction $stockTransaction)
    {
        //
    }

    // Fetch materials based on selected category using AJAX
    public function getMaterialsByCategory($categoryId)
    {
        // Fetches id and name of materials belonging to selected category for AJAX dropdown.
        // Returns the filtered materials list in JSON format.
        $materials = Material::where('category_id', $categoryId)->get(['id', 'name']);
        return response()->json($materials);
    }
}

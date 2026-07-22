<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\StockTransactionController;

Route::get('/', fn() => redirect()->route('materials.index'));

// Category Master CRUD
Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);

// Material Master CRUD & Manage Page
Route::resource('materials', MaterialController::class);

// Step 2: Inward/Outward Stock Entry
Route::get('transactions/create', [StockTransactionController::class, 'create'])->name('transactions.create');
Route::post('transactions', [StockTransactionController::class, 'store'])->name('transactions.store');

// Step 2 AJAX Route: Dynamic Material Fetching
Route::get('categories/{id}/materials', [StockTransactionController::class, 'getMaterialsByCategory']);
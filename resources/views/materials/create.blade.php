@extends('layouts.app')

@section('content')
<h2>Step 1: Add New Material</h2>

<div class="card col-md-6">
    <div class="card-body">
        <form action="{{ route('materials.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Category*</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Material Name* (Alphanumeric)</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Steel Rod 10mm" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Opening Balance* (Max 2 decimals)</label>
                <input type="number" step="0.01" name="opening_balance" class="form-control" value="{{ old('opening_balance') }}" placeholder="e.g. 100.50" required>
            </div>

            <button type="submit" class="btn btn-primary">Save Material</button>
            <a href="{{ route('materials.index') }}" class="btn btn-secondary ms-1">Cancel</a>
        </form>
    </div>
</div>
@endsection
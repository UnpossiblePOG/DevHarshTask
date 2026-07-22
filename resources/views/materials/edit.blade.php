@extends('layouts.app')

@section('content')
<h2>Edit Material Basic Details</h2>

<div class="card col-md-6">
    <div class="card-body">
        <form action="{{ route('materials.update', $material->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Category*</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $material->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Material Name*</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $material->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Opening Balance*</label>
                <input type="number" step="0.01" name="opening_balance" class="form-control" value="{{ old('opening_balance', $material->opening_balance) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Material</button>
            <a href="{{ route('materials.index') }}" class="btn btn-secondary ms-1">Cancel</a>
        </form>
    </div>
</div>
@endsection
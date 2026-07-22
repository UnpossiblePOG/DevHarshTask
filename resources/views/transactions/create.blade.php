@extends('layouts.app')

@section('content')
<h2>Step 2: Add Inward / Outward Quantity</h2>

<div class="card col-md-6">
    <div class="card-body">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Material Category*</label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Material Name*</label>
                <select id="material_id" name="material_id" class="form-select" required>
                    <option value="">Select Category First</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Date*</label>
                <input type="date" name="transaction_date" class="form-control" value="{{ old('transaction_date', date('Y-m-d')) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Material Inward / Outward Quantity* (Positive or Negative)</label>
                <input type="number" step="0.01" name="quantity" class="form-control" value="{{ old('quantity') }}" placeholder="e.g. 25.00 or -5.50" required>
                <div class="form-text text-muted">Use negative sign (-) for outward stock removal.</div>
            </div>

            <button type="submit" class="btn btn-success">Save Entry</button>
            <a href="{{ route('materials.index') }}" class="btn btn-secondary ms-1">Cancel</a>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('category_id');
    const materialSelect = document.getElementById('material_id');

    function fetchMaterials(categoryId) {
        if (!categoryId) {
            materialSelect.innerHTML = '<option value="">Select Category First</option>';
            return;
        }

        materialSelect.innerHTML = '<option value="">Loading...</option>';

        fetch(`/categories/${categoryId}/materials`)
            .then(res => res.json())
            .then(data => {
                materialSelect.innerHTML = '<option value="">Select Material</option>';
                data.forEach(mat => {
                    materialSelect.innerHTML += `<option value="${mat.id}">${mat.name}</option>`;
                });
            })
            .catch(err => {
                console.error(err);
                materialSelect.innerHTML = '<option value="">Select Material</option>';
            });
    }

    categorySelect.addEventListener('change', function () {
        fetchMaterials(this.value);
    });

    if (categorySelect.value) {
        fetchMaterials(categorySelect.value);
    }
});
</script>
@endsection
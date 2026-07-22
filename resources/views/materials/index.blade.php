@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Material Management</h2>
    <div>
        <a href="{{ route('materials.create') }}" class="btn btn-primary btn-sm">Add Material</a>
        <a href="{{ route('transactions.create') }}" class="btn btn-secondary btn-sm">Inward/Outward Entry</a>
    </div>
</div>

<table class="table table-bordered table-striped bg-white mt-3">
    <thead class="table-dark">
        <tr>
            <th>Material ID</th>
            <th>Category</th>
            <th>Material Name</th>
            <th>Opening Balance</th>
            <th>Current Balance (= Opening +/- Inward/Outward)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($materials as $material)
        <tr>
            <td>{{ $material->id }}</td>
            <td>{{ $material->category->name ?? 'Unassigned' }}</td>
            <td>{{ $material->name }}</td>
            <td>{{ number_format($material->opening_balance, 2) }}</td>
            <td>
                <strong>{{ number_format($material->current_balance, 2) }}</strong>
            </td>
            <td>
                <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('materials.destroy', $material->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Soft delete this material?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No materials found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
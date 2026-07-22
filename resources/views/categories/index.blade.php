@extends('layouts.app')

@section('content')
<h2>Category Master CRUD</h2>

<div class="card my-3">
    <div class="card-body">
        <form action="{{ route('categories.store') }}" method="POST" class="row g-2 align-items-center">
            @csrf
            <div class="col-auto">
                <input type="text" name="name" class="form-control" placeholder="Category Name*" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Add Category</button>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered bg-white">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th style="width: 100px;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>
                <form action="{{ route('categories.update', $category->id) }}" method="POST" class="d-flex gap-2">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control form-control-sm" required>
                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                </form>
            </td>
            <td>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">No categories found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
@extends('admin')
@section('adminsection')

<div class="container">
    <h2>Create Product</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" id="price" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="promotion">Promotion (%)</label>
            <input type="number" name="promotion" class="form-control" id="promotion" step="1" min="0" max="100">
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" id="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" name="image[]" multiple required>
        </div>

        <div class="form-group">
            <label for="stock">Stock Quantity</label>
            <input type="number" name="stock" class="form-control" id="stock" min="0" required>
        </div>

        <div class="form-group form-check">
            <!-- Hidden input to handle unchecked state -->
            <input type="hidden" name="is_best" value="0">

            <input type="checkbox" name="is_best" class="form-check-input" id="is_best" value="1">
            <label class="form-check-label" for="is_best">Is the Best Product</label>
        </div>

        <button type="submit" class="btn btn-primary my-3">Create Product</button>
    </form>
</div>

@endsection

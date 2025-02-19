@extends('admin')
@section('adminsection')

<div class="container my-4">
    <h2>Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Product Name --}}
        <div class="form-group">
            <label for="name">Product Name</label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $product->name) }}"
                required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="form-group">
            <label for="description">Description</label>
            <textarea
                name="description"
                id="description"
                class="form-control @error('description') is-invalid @enderror"
                required>{{ old('description', $product->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Price --}}
        <div class="form-group">
            <label for="price">Price</label>
            <input
                type="number"
                name="price"
                id="price"
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $product->price) }}"
                step="0.01"
                required>
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Promotion --}}
        <div class="form-group">
            <label for="promotion">Promotion</label>
            <input
                type="text"
                name="promotion"
                id="promotion"
                class="form-control @error('promotion') is-invalid @enderror"
                value="{{ old('promotion', $product->promotion) }}">
            @error('promotion')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Category --}}
        <div class="form-group">
            <label for="category_id">Category</label>
            <select
                name="category_id"
                id="category_id"
                class="form-control @error('category_id') is-invalid @enderror"
                required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Images --}}
        <div class="form-group">
            <label for="images">Product Images</label>
            <input
                type="file"
                name="images[]"
                id="images"
                class="form-control @error('images') is-invalid @enderror"
                multiple>
            @error('images')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Current Images --}}
        @if($product->images->count() > 0)
            <div class="mt-3">
                <h5>Current Images:</h5>
                @foreach($product->images as $image)
                    <img
                        src="{{ asset($image->image_path) }}"
                        alt="Product Image"
                        style="width: 100px; height: auto; margin-right: 5px;">
                @endforeach
            </div>
        @endif

        {{-- Stock --}}
        <div class="form-group">
            <label for="stock">Stock Quantity</label>
            <input
                type="number"
                name="stock"
                id="stock"
                class="form-control @error('stock') is-invalid @enderror"
                value="{{ old('stock', $product->stock) }}"
                min="0"
                required>
            @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Is Best --}}
        <div class="form-group form-check">
            <input type="hidden" name="is_best" value="0">
            <input
                type="checkbox"
                name="is_best"
                id="is_best"
                class="form-check-input @error('is_best') is-invalid @enderror"
                value="1"
                {{ old('is_best', $product->is_best) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_best">Is the Best Product</label>
            @error('is_best')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
        </div>
    </form>
</div>

@endsection

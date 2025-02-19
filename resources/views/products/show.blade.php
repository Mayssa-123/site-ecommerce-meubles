@extends('admin')

@section('adminsection')
<div class="container">
    <h1 class="my-4">Product Details</h1>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $product->name }}</h3>
            <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
            <p class="card-text"><strong>Category:</strong> {{ $product->category->name }}</p>
            <p class="card-text"><strong>Price:</strong> {{ $product->price }}</p>
            <p class="card-text"><strong>Promotion:</strong> {{ $product->promotion ?? 'No Promotion' }}</p>
            <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
            <p class="card-text"><strong>Is Best:</strong> {{ $product->is_best ? 'Yes' : 'No' }}</p>
            <p class="card-text">
                <strong>Moyenne des avis:</strong>
                @if ($product->reviews->count() > 0) <!-- Vérifie s'il y a des avis -->
                    {{ number_format($product->averageRating(), 2) }} <!-- Limite à 2 décimales -->
                @else
                    <span class="text-muted">Aucun avis pour ce produit</span>
                @endif
            </p>

        </div>

        @if($product->images->count() > 0)
        <div class="card-footer">
            <h5>Images:</h5>
            <div class="d-flex flex-wrap">
                @foreach($product->images as $image)
                <img src="{{ asset($image->image_path) }}" alt="Product Image" class="img-thumbnail" style="width: 150px; margin-right: 10px;">
                @endforeach
            </div>
        </div>
        @else
        <div class="card-footer">
            <p>No images available for this product.</p>
        </div>
        @endif
    </div>

    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Back to Products List</a>
</div>
@endsection

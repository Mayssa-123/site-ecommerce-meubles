@extends('cart')
@section('cartsection')
<div class="container">
        <div class="row">
            @foreach ($products as $product)
                <!-- Product image and thumbnails -->
                <div class="col-lg-6">
                    <div class="row">
                        <div class="swiper-container swiper" data-thumbs="true" id="swiper-1">
                            <div class="swiper-wrapper">


                                @foreach($product->images as $image)
                                <img src="{{ asset($image->image_path) }}" alt="Product Image" style="width: 100px; height: auto; margin-right: 5px;">
                            @endforeach
                            </div>
                        </div>
                        <!-- Thumbs Swiper Container -->
                        <div class="swiper-container swiper-thumbs mt-4 overflow-hidden">
                            <div class="swiper-wrapper">
                                @foreach ($product->images as $image)
                                    <div class="swiper-slide">
                                        <div class="ratio ratio-1x1 border">
                                            <img src="{{ asset($image->image_path) }}" alt="Product Image" style="width: 100px; height: auto; margin-right: 5px;">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product details -->
                <div class="col-lg-6">
                    <div class="ps-lg-6">
                        <div class="position-relative" id="zoomPane">
                            <span class="badge bg-info">New</span>
                            <div class="d-flex align-items-start justify-content-between mt-3 mb-2">
                                <div class="mb-3">
                                    <h2>{{ $product->name }}</h2>
                                </div>
                                <div class="text-success d-flex align-items-center gap-2 mt-2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M3 13l10-10" fill="#16A34A" />
                                    </svg>
                                    In Stock
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-3">
                                    <p class="mb-0">
                                        <span class="text-danger">${{ $product->price }}</span>
                                        @if ($product->promotion)
                                            <span class="text-decoration-line-through">${{ $product->original_price }}</span>
                                            <span class="badge bg-danger">Save ${{ $product->promotion }}</span>
                                        @endif
                                    </p>
                                </div>
                                <span class="">
                                    4.5
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        class="bi bi-star-fill align-baseline text-primary" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73" />
                                    </svg>
                                </span>
                            </div>
                            <hr class="my-3" />
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <span>Quantity:</span>
                                <div class="d-flex align-items-center border p-2">
                                    <button class="btn btn-icon btn-xs btn-focus-none quantity-btn minus fs-5">-</button>
                                    <input type="number" class="form-control quantity-input text-center mx-1 p-0 border-0"
                                        value="1" min="1" style="width: 50px" />
                                    <button class="btn btn-icon btn-xs btn-focus-none quantity-btn plus fs-5">+</button>
                                </div>
                            </div>
                            <div>
                                <a href="#!" class="btn btn-dark">Add to Cart</a>
                                <a href="#!" class="btn btn-outline-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m7 8 15" />
                                    </svg>
                                    Add to Wishlist
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</div>
@endsection

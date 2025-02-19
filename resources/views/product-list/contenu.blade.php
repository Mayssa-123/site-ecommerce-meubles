<div class="row">
    @foreach($products as $product)
        <div class="col-12 mb-6">
            <div class="product-card d-flex flex-column flex-md-row align-items-center gap-4 gap-md-0">
                <div class="text-center product-card-img col-lg-4 col-md-5">
                    <a href="{{ route('product.details', ['id' => $product->id]) }}">
                        <img src="{{ asset($product->images->first()->image_path) }}" alt="{{ $product->name }} image"
                            class="img-fluid" />

                    </a>
                </div>
                <div class="col-lg-8 col-md-7 ps-md-6">
                    <div class="d-flex justify-content-between mb-4">
                        <div class="d-flex flex-column">
                            <span class="small fw-medium text-uppercase">Product Type: {{ $product->category->name }}</span>
                            <span class="d-flex align-items-center">
                                @php
                                    $rating = round($product->averageRating()); // Arrondir la moyenne
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating)
                                        <!-- Étoile jaune remplie -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-star-fill text-warning" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                    @else
                                        <!-- Étoile vide -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-star text-secondary" viewBox="0 0 16 16">
                                            <path
                                                d="M2.866 14.85c-.078.444.36.79.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696-2.184-4.327c-.197-.39-.73-.39-.927 0L5.257 5.17l-4.898.696c-.441.062-.612.636-.283.95l3.522 3.356-.83 4.73z" />
                                        </svg>
                                    @endif
                                @endfor
                            </span>


                        </div>
                        <div>
                            <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-heart animate-target" viewBox="0 0 16 16">
                                    <path
                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate">
                            <a href="{{ route('product.details', ['id' => $product->id]) }}">
                                {{ $product->name }}</a>
                        </h3>


                    </div>
                    <div class="mb-4">
                        <p>{{ $product->description }}</p>
                        <p>Stock : {{ $product->stock }}</p>
                        <p class="mb-0">
                            <span class="text-danger">
                                ${{ number_format($product->price - ($product->promotion ?? 0), 2) }}
                            </span>
                            @if ($product->promotion)
                                <span class="text-decoration-line-through text-muted">${{ number_format($product->price, 2) }}</span>
                                <span class="badge bg-danger">Save ${{ number_format($product->promotion, 2) }}</span>
                            @else
                                <span class="text-muted">No promotion</span>
                            @endif
                        </p>
                    </div>


                </div>
            </div>
        </div>



@endforeach

    <!--Pagination-->
    <div class="col-12 mt-8">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                {{ $products->links('vendor.pagination.bootstrap-5') }}
            </ul>
        </nav>
    </div>
</div>

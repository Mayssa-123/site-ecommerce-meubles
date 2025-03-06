@extends('welcome')
@section('section')
<div class="container">
    <div class="row">
        <div class="col-12 py-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#!">Home</a></li>
                    <li class="breadcrumb-item"><a href="#!">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <!--Heading-->
            <div class="mb-4">
                <h1 class="mb-0">Shopping Cart</h1>
            </div>
        </div>
    </div>
</div>
<section class="pt-lg-4 pb-lg-8">
    <div class="container">
        <div class="row gx-lg-6 gy-4 gy-lg-0">
            <!--Shopping cart-->
            <div class="col-lg-8">
                <div class="mb-4">
                    <span>Spend $61.00 more and get free shipping!</span>
                    <div class="progress mt-3" style="height: 4px">
                        <div class="progress-bar bg-danger" role="progressbar" aria-label="Basic example"
                            style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <!--Product table-->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td class="py-4 align-middle">
                                            <div class="d-flex align-items-start gap-4">
                                                @if ($item->attributes->image)
                                                    <img src="{{ asset($item->attributes->image) }}" alt="Image" class="imagecheck">
                                                @endif
                                                <style>
                                                    .imagecheck {
                                                                width: 200px; /* L'image prendra toute la largeur de son conteneur */
                                                                max-width: 300px; /* Limite la largeur maximale à 300px (ajuste cette valeur selon tes besoins) */
                                                                height: auto; /* Maintient le ratio de l'image */
                                                                object-fit: contain; /* L'image s'adapte au conteneur sans déformation */
                                                                display: block; /* Permet de centrer l'image */
                                                                margin: 0 auto; /* Centre l'image horizontalement */
                                                                }

                                                </style>


                                                <div class="mb-2">
                                                    <h2>{{ $item->name }}</h2>
                                                    <h3 class="fs-6 mb-1 text-link"><a href="#!">{{ $item->attributes->description }}</a></h3>
                                                    <!-- Utilisation de $item au lieu de $product -->
                                                    <span class="text-danger">
                                                        ${{ $item->price-number_format((float)$item->attributes->promotion, 2) }}                                                    </span>

                                                    @if ($item->attributes->promotion && (float)$item->attributes->promotion > 0)
                                                        <span class="text-decoration-line-through text-muted">${{ number_format($item->price, 2) }}</span>
                                                        <span class="badge bg-danger">Save ${{ number_format((float)$item->attributes->promotion, 2) }}</span>
                                                    @else
                                                        <span class="text-muted">No promotion</span>
                                                    @endif

                                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit">Remove</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-inline-flex align-items-center border p-2">
                                                <input type="number" class="form-control quantity-input text-center mx-1 p-0 border-0"
                                                    value="{{ $item->quantity }}" min="1" style="width: 50px" readonly />
                                            </div>
                                        </td>
                                        <td class="align-middle">${{ ($item->price-number_format((float)$item->attributes->promotion, 2))*$item->quantity }}                                                    </span>
                                            </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3 d-flex gap-3">
                    <a href="{{ route ('product-list.index') }}" class="text-link">Continue Shopping</a>
                </div>

            </div>
            <!--Order summary-->
            <div class="col-lg-4">
                <div class="card bg-light bg-opacity-25 mb-4">
                    <div class="card-header px-4 py-3">
                        <h3 class="fs-5 mb-0">Order Summary</h3>
                    </div>
                    <div class="card-body px-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span>Subtotal ({{ count($cartItems) }} items)</span>
                            <span class="text-dark fw-medium">
                                ${{ number_format(Cart::getContent()->sum(function ($item) {
                                    // Si la promotion existe et est supérieure à 0, soustraire le montant de la promotion du prix
                                    $promotion = (float)$item->attributes->promotion;
                                    return (($promotion > 0) ? $item->price - $promotion : $item->price)*$item->quantity;
                                }), 2) }}
                            </span>

                                                    </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span>Shipping</span>
                            <span class="">Free</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-top pt-3 mb-2 fw-medium text-dark">
                            <span class="">Total:</span>
                            <span class="">{{ number_format(Cart::getContent()->sum(function ($item) {
                                // Si la promotion existe et est supérieure à 0, soustraire le montant de la promotion du prix
                                $promotion = (float)$item->attributes->promotion;
                                return (($promotion > 0) ? $item->price - $promotion : $item->price)*$item->quantity;
                            }), 2) }} $</span>
                        </div>
                        <small>Tax included and shipping calculated at checkout</small>
                        <div class="d-grid mt-4">
                                <!-- Champs cachés pour transmettre les données -->


                                <!-- Cart page (cart.index.php) -->
                                <form action="{{ route('checkout') }}" method="POST">
                                    @csrf
                                    <!-- Utilisation de la méthode Cart pour récupérer les éléments du panier -->
                                    <input type="hidden" name="cart_items" value="{{ serialize(Cart::getContent()) }}">
                                    <button type="submit" class="btn btn-primary">Proceed to checkout</button>
                                </form>

                        </div>
                    </div>
                </div>


                <div class="">
                    <div class="alert alert-success">You are eligible for free shipping.</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

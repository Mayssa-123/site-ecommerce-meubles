@extends('welcome')
@section('section')
	<section class="py-lg-8 py-5">
		<div class="container">
			<div class="row">
                <div class="row">
                    <!-- Sidebar utilisateur -->
                    <div class="col-lg-3 col-md-4">
                        <div class="mb-4 text-center text-md-start">
                            <div class="d-lg-flex align-items-center gap-3 border p-3">
                                <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Avatar" class="avatar avatar-lg rounded-circle">
                                <div class="mt-2 mt-lg-0 overflow-hidden">
                                    <h3 class="mb-0 fs-5">{{ $user->name }}</h3>
                                    <p class="mb-0 small text-truncate">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-md-none text-center d-grid">
                            <button class="btn btn-light mb-3 d-flex align-items-center justify-content-between" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseAccountMenu" aria-expanded="false"
                                aria-controls="collapseAccountMenu">
                                Account Menu
                                <i class="bi bi-chevron-down ms-2"></i>
                            </button>
                        </div>
                        @include('layouts-wishlist.menu')
                    </div>
				<!--Orders start-->
				<div class="col-lg-9 col-md-8">
					<div class="row g-3 mb-4">
                        <div class="col-lg-6">
                            <!-- Heading -->
                            <h1 class="mb-0 h2">Orders</h1>
                        </div>
                    </div>

					<!--Order-->

                    @if ($orders->isEmpty())
    <p>Aucune commande trouvée.</p>
@else
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

@foreach ($orders as $order)
    <div class="card mb-3">
        <!-- En-tête de la commande -->
        <div class="card-header d-flex justify-content-between px-3 py-3">
            <span class="text-dark fw-semibold">Order ID: {{ $order->id }}</span>
            <span class="badge text-bg-info">{{ $order->status }}</span>
        </div>

        <!-- Corps de la commande -->



        <!-- Contenu de la commande -->
        <div class="card-body px-3 py-3">
            <div class="d-flex mb-3">
                <!-- Affichage des images des produits de la commande -->
                <div class="col-lg-5">
                    <div class="d-flex gap-2">
                        @foreach ($order->products as $checkoutProduct)
                            @if ($checkoutProduct->product->images->isNotEmpty())
                                <img src="{{ asset($checkoutProduct->product->images->first()->image_path) }}"
                                    alt="Image de {{ $checkoutProduct->product->name }}"
                                    style="width: 100px; height: auto; margin-right: 5px;">
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Détails de la commande -->
                <div class="col-lg-7">
                    <div class="row align-items-center gy-3">
                        <div class="col-lg-5">
                            <div class="d-flex flex-column">
                                <span>Estimated Arrival</span>
                                <span class="text-dark fw-medium">
                                    {{ \Carbon\Carbon::now()->addDays(5)->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex flex-column">
                                <span>Order value</span>
                                <span class="text-dark fw-medium">
                                    ${{ number_format($order->products->sum(function($checkoutProduct) {
                                        return ($checkoutProduct->product->price - $checkoutProduct->product->promotion) * $checkoutProduct->quantity;
                                    }), 2) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex flex-column">
                                <a class="text-link" href="#" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasRight{{ $order->id }}" aria-controls="offcanvasRight">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- Exemple d'un bouton pour marquer la commande comme livrée -->


        <!-- Offcanvas pour afficher les détails des produits commandés -->
        @foreach ($orders as $order)
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight{{ $order->id }}" aria-labelledby="offcanvasRightLabel{{ $order->id }}" style="width: 546px;">
                <div class="offcanvas-header align-items-start">
                    <div class="d-flex flex-column gap-2">
                        <h4 class="offcanvas-title mb-0" id="offcanvasRightLabel{{ $order->id }}">Order # {{ $order->id }}</h4>
                        <div>
                            <span class="badge text-bg-info">{{ $order->status }}</span>

                        </div>
                    </div>
                    <button type="button" class="btn-close mt-1" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <hr class="mx-3">
                <div class="offcanvas-body d-flex flex-column gap-6">
                    <div class="text-center d-flex flex-column gap-4 ">
                        <span class="mb-0 fw-medium text-dark">Be patient, package on deliver!</span>
                        <div class="progress rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100" style="height: 10px">
                            <div class="progress-bar bg-success" style="width: 70%"></div>
                        </div>
                    </div>

                    @foreach ($order->products as $checkoutProduct)
                        <div class="d-flex mb-3 align-items-start cart-item gap-4 " data-product-price="34">

                            <img src="{{ asset($checkoutProduct->product->images->first()->image_path) }}" alt="Product Image"
                                class="icon-shape icon-xxl">

                            <div class="me-auto d-flex flex-column gap-2">
                                <div class="d-flex flex-column gap-1">
                                    <h6 class="mb-0">{{ $checkoutProduct->product->name }}</h6>
                                    <p class="mb-0 lh-1 text-dark fw-semibold">${{ $checkoutProduct->product->price-$checkoutProduct->product->promotion}}</p>
                                </div>
                                <small class="text-dark fw-medium">Qty: {{ $checkoutProduct->quantity }}</small>
                            </div>
                        </div>
                    @endforeach

                    <!-- Informations sur la livraison et le paiement -->
                    <div class="card">
                        <div class="card-header bg-white py-3">
                            <div class="d-flex flex-row align-items-center gap-2">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-truck text-primary" viewBox="0 0 16 16">
                                        <path
                                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                                    </svg>
                                </div>
                                <span class="text-dark fw-medium">Delivery</span>
                                <span>In 5 days</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
                                <li>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <span>Estimated delivery date:</span>
                                        <span class="text-dark fw-medium">
                                            {{ \Carbon\Carbon::now()->addDays(5)->format('M d, Y / H:i') }}
                                        </span>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-white py-3">
                            <div class="d-flex flex-row align-items-center gap-2">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-credit-card text-primary" viewBox="0 0 16 16">
                                        <path
                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                                    </svg>
                                </div>
                                <span class="text-dark fw-medium">Payment</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
                                <li>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <span>Payment method:</span>
                                        <span class="text-dark fw-medium">Cash on delivery</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer border-top-0 bg-light">
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <span>Estimated total:</span>

                                <span class="text-dark fw-medium">
                                    $
                                    @php
                                        $total = 0;
                                        foreach($order->products as $checkoutProduct) {
                                            $total += ($checkoutProduct->product->price - $checkoutProduct->product->promotion) * $checkoutProduct->quantity;
                                        }
                                        echo number_format($total, 2);
                                    @endphp
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach


    <!-- Pagination -->
    <div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#!" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link active" href="#!">1</a></li>
                <li class="page-item"><a class="page-link" href="#!">2</a></li>
                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#!" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endif

<!-- Offcanvas pour chaque commande -->






						<!--Pagination-->

					</div>


				</div>
				<!--Orders end-->
			</div>

		</div>
	</section>

    @include('layouts-wishlist.footer')

@endsection

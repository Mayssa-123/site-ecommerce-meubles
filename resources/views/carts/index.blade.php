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
                                €{{ number_format(Cart::getContent()->sum(function ($item) {
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
                            }), 2) }} EUR</span>
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

                <div class="card mb-4">
                    <div class="card-body p-4">
                        <h3 class="fs-6 text-center mb-3">We accept payments</h3>
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <a href="#!">
                                <svg width="38" height="24" viewBox="0 0 38 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2054_584)">
                                        <path opacity="0.07"
                                            d="M35 0H3C1.3 0 0 1.3 0 3V21C0 22.7 1.4 24 3 24H35C36.7 24 38 22.7 38 21V3C38 1.3 36.6 0 35 0Z"
                                            fill="black"></path>
                                        <path
                                            d="M35 1C36.1 1 37 1.9 37 3V21C37 22.1 36.1 23 35 23H3C1.9 23 1 22.1 1 21V3C1 1.9 1.9 1 3 1H35Z"
                                            fill="white"></path>
                                        <path
                                            d="M28.3 10.1H28C27.6 11.1 27.3 11.6 27 13.1H28.9C28.6 11.6 28.6 10.9 28.3 10.1ZM31.2 16H29.5C29.4 16 29.4 16 29.3 15.9L29.1 15L29 14.8H26.6C26.5 14.8 26.4 14.8 26.4 15L26.1 15.9C26.1 16 26 16 26 16H23.9L24.1 15.5L27 8.7C27 8.2 27.3 8 27.8 8H29.3C29.4 8 29.5 8 29.5 8.2L30.9 14.7C31 15.1 31.1 15.4 31.1 15.8C31.2 15.9 31.2 15.9 31.2 16ZM17.8 15.7L18.2 13.9C18.3 13.9 18.4 14 18.4 14C19.1 14.3 19.8 14.5 20.5 14.4C20.7 14.4 21 14.3 21.2 14.2C21.7 14 21.7 13.5 21.3 13.1C21.1 12.9 20.8 12.8 20.5 12.6C20.1 12.4 19.7 12.2 19.4 11.9C18.2 10.9 18.6 9.5 19.3 8.8C19.9 8.4 20.2 8 21 8C22.2 8 23.5 8 24.1 8.2H24.2C24.1 8.8 24 9.3 23.8 9.9C23.3 9.7 22.8 9.5 22.3 9.5C22 9.5 21.7 9.5 21.4 9.6C21.2 9.6 21.1 9.7 21 9.8C20.8 10 20.8 10.3 21 10.5L21.5 10.9C21.9 11.1 22.3 11.3 22.6 11.5C23.1 11.8 23.6 12.3 23.7 12.9C23.9 13.8 23.6 14.6 22.8 15.2C22.3 15.6 22.1 15.8 21.4 15.8C20 15.8 18.9 15.9 18 15.6C17.9 15.8 17.9 15.8 17.8 15.7ZM14.3 16C14.4 15.3 14.4 15.3 14.5 15C15 12.8 15.5 10.5 15.9 8.3C16 8.1 16 8 16.2 8H18C17.8 9.2 17.6 10.1 17.3 11.2C17 12.7 16.7 14.2 16.3 15.7C16.3 15.9 16.2 15.9 16 15.9M5 8.2C5 8.1 5.2 8 5.3 8H8.7C9.2 8 9.6 8.3 9.7 8.8L10.6 13.2C10.6 13.3 10.6 13.3 10.7 13.4C10.7 13.3 10.8 13.3 10.8 13.3L12.9 8.2C12.8 8.1 12.9 8 13 8H15.1C15.1 8.1 15.1 8.1 15 8.2L11.9 15.5C11.8 15.7 11.8 15.8 11.7 15.9C11.6 16 11.4 15.9 11.2 15.9H9.7C9.6 15.9 9.5 15.9 9.5 15.7L7.9 9.5C7.7 9.3 7.4 9 7 8.9C6.4 8.6 5.3 8.4 5.1 8.4L5 8.2Z"
                                            fill="#142688"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2054_584">
                                            <rect width="38" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            <a href="#!">
                                <svg width="38" height="24" viewBox="0 0 38 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2054_588)">
                                        <path opacity="0.07"
                                            d="M35 0H3C1.3 0 0 1.3 0 3V21C0 22.7 1.4 24 3 24H35C36.7 24 38 22.7 38 21V3C38 1.3 36.6 0 35 0Z"
                                            fill="black"></path>
                                        <path
                                            d="M35 1C36.1 1 37 1.9 37 3V21C37 22.1 36.1 23 35 23H3C1.9 23 1 22.1 1 21V3C1 1.9 1.9 1 3 1H35Z"
                                            fill="white"></path>
                                        <path
                                            d="M15 19C18.866 19 22 15.866 22 12C22 8.13401 18.866 5 15 5C11.134 5 8 8.13401 8 12C8 15.866 11.134 19 15 19Z"
                                            fill="#EB001B"></path>
                                        <path
                                            d="M23 19C26.866 19 30 15.866 30 12C30 8.13401 26.866 5 23 5C19.134 5 16 8.13401 16 12C16 15.866 19.134 19 23 19Z"
                                            fill="#F79E1B"></path>
                                        <path
                                            d="M22 11.9998C22 9.5998 20.8 7.4998 19 6.2998C17.2 7.5998 16 9.6998 16 11.9998C16 14.2998 17.2 16.4998 19 17.6998C20.8 16.4998 22 14.3998 22 11.9998Z"
                                            fill="#FF5F00"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2054_588">
                                            <rect width="38" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            <a href="#!">
                                <svg width="38" height="24" viewBox="0 0 38 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2054_594)">
                                        <path opacity="0.07"
                                            d="M35 0H3C1.3 0 0 1.3 0 3V21C0 22.7 1.4 24 3 24H35C36.7 24 38 22.7 38 21V3C38 1.3 36.6 0 35 0Z"
                                            fill="black"></path>
                                        <path
                                            d="M35 1C36.1 1 37 1.9 37 3V21C37 22.1 36.1 23 35 23H3C1.9 23 1 22.1 1 21V3C1 1.9 1.9 1 3 1H35Z"
                                            fill="#006FCF"></path>
                                        <path
                                            d="M22.012 19.9356V11.5146L37 11.5276V13.8536L35.268 15.7056L37 17.5726V19.9476H34.234L32.764 18.3256L31.304 19.9536L22.012 19.9336V19.9356Z"
                                            fill="white"></path>
                                        <path
                                            d="M23.0129 19.0124V12.4424H28.5849V13.9554H24.8169V14.9834H28.4949V16.4714H24.8169V17.4814H28.5849V19.0124H23.0129Z"
                                            fill="#006FCF"></path>
                                        <path
                                            d="M28.557 19.0124L31.64 15.7234L28.557 12.4414H30.943L32.827 14.5244L34.717 12.4424H37V12.4934L33.983 15.7234L37 18.9204V19.0134H34.693L32.776 16.9104L30.878 19.0144H28.557V19.0124Z"
                                            fill="#006FCF"></path>
                                        <path
                                            d="M22.71 4.04004H26.324L27.593 6.92104V4.04004H32.053L32.823 6.19904L33.594 4.04004H37V12.461H19L22.71 4.04004Z"
                                            fill="white"></path>
                                        <path
                                            d="M23.395 4.95508L20.479 11.5211H22.479L23.029 10.2061H26.009L26.559 11.5211H28.609L25.705 4.95508H23.395ZM23.645 8.73208L24.52 6.64208L25.393 8.73208H23.645Z"
                                            fill="#006FCF"></path>
                                        <path
                                            d="M28.5811 11.5201V4.95312L31.3921 4.96312L32.8401 9.00012L34.2961 4.95412H37.0001V11.5191L35.2601 11.5351V7.02513L33.6161 11.5191H32.0261L30.3501 7.01013V11.5201H28.5821H28.5811Z"
                                            fill="#006FCF"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2054_594">
                                            <rect width="38" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            <a href="#!">
                                <svg width="38" height="24" viewBox="0 0 38 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2054_603)">
                                        <path opacity="0.07"
                                            d="M35 0H3C1.3 0 0 1.3 0 3V21C0 22.7 1.4 24 3 24H35C36.7 24 38 22.7 38 21V3C38 1.3 36.6 0 35 0Z"
                                            fill="black"></path>
                                        <path
                                            d="M35 1C36.1 1 37 1.9 37 3V21C37 22.1 36.1 23 35 23H3C1.9 23 1 22.1 1 21V3C1 1.9 1.9 1 3 1H35Z"
                                            fill="white"></path>
                                        <path
                                            d="M23.9 8.3C24.1 7.3 23.9 6.6 23.3 6C22.7 5.3 21.6 5 20.2 5H16.1C15.8 5 15.6 5.2 15.5 5.5L14 15.6C14 15.8 14.1 16 14.3 16H17L17.4 12.6L19.2 10.4L23.9 8.3Z"
                                            fill="#003087"></path>
                                        <path
                                            d="M23.9 8.2998L23.7 8.4998C23.2 11.2998 21.5 12.2998 19.1 12.2998H18C17.7 12.2998 17.5 12.4998 17.4 12.7998L16.8 16.6998L16.6 17.6998C16.6 17.8998 16.7 18.0998 16.9 18.0998H19C19.3 18.0998 19.5 17.8998 19.5 17.6998V17.5998L19.9 15.1998V15.0998C19.9 14.8998 20.2 14.6998 20.4 14.6998H20.7C22.8 14.6998 24.4 13.8998 24.8 11.4998C25 10.4998 24.9 9.6998 24.4 9.0998C24.3 8.5998 24.1 8.3998 23.9 8.2998Z"
                                            fill="#3086C8"></path>
                                        <path
                                            d="M23.3 8.0998C23.2 7.9998 23.1 7.9998 23 7.9998C22.9 7.9998 22.8 7.9998 22.7 7.8998C22.4 7.7998 22 7.7998 21.6 7.7998H18.6C18.5 7.7998 18.4 7.7998 18.4 7.8998C18.2 7.9998 18.1 8.0998 18.1 8.2998L17.4 12.6998V12.7998C17.4 12.4998 17.7 12.2998 18 12.2998H19.3C21.8 12.2998 23.4 11.2998 23.9 8.4998V8.2998C23.8 8.1998 23.6 8.0998 23.4 8.0998H23.3Z"
                                            fill="#012169"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2054_603">
                                            <rect width="38" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            <a href="#!">
                                <svg width="38" height="24" viewBox="0 0 38 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2054_609)">
                                        <path opacity="0.07"
                                            d="M35 0H3C1.3 0 0 1.3 0 3V21C0 22.7 1.4 24 3 24H35C36.7 24 38 22.7 38 21V3C38 1.3 36.6 0 35 0Z"
                                            fill="black"></path>
                                        <path
                                            d="M35 1C36.1 1 37 1.9 37 3V21C37 22.1 36.1 23 35 23H3C1.9 23 1 22.1 1 21V3C1 1.9 1.9 1 3 1H35Z"
                                            fill="white"></path>
                                        <path
                                            d="M12 12V15.7C12 16 11.8 16 11.5 15.9C9.59998 15.1 8.49998 12.6 9.19998 10.5C9.59998 9.4 10.4 8.5 11.5 8.1C11.9 7.9 12 8 12 8.3V12ZM14 12V8.3C14 8 14 8 14.3 8.1C16.4 8.9 17.5 11.4 16.7 13.5C16.3 14.6 15.5 15.5 14.4 15.9C14 16.1 14 16 14 15.7V12ZM21.2 5H13C16.8 5 19.8 8.1 19.8 12C19.8 15.9 16.8 19 13 19H21.2C25 19 28 15.9 28 12C28 8.1 25 5 21.2 5Z"
                                            fill="#3086C8"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2054_609">
                                            <rect width="38" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            <a href="#!">
                                <svg width="38" height="24" viewBox="0 0 38 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2054_613)">
                                        <path opacity="0.07"
                                            d="M35 0H3C1.3 0 0 1.3 0 3V21C0 22.7 1.4 24 3 24H35C36.7 24 38 22.7 38 21V3C38 1.3 36.6 0 35 0Z"
                                            fill="black"></path>
                                        <path
                                            d="M35 1C36.1 1 37 1.9 37 3V21C37 22.1 36.1 23 35 23H3C1.9 23 1 22.1 1 21V3C1 1.9 1.9 1 3 1H35Z"
                                            fill="white"></path>
                                        <path
                                            d="M3.57 7.16004H2V12.66H3.57C4.4 12.66 5 12.46 5.53 12.03C6.16 11.51 6.53 10.73 6.53 9.92004C6.52 8.29004 5.31 7.16004 3.57 7.16004ZM4.83 11.3C4.49 11.6 4.06 11.74 3.36 11.74H3.07V8.10004H3.36C4.05 8.10004 4.47 8.22004 4.83 8.54004C5.2 8.87004 5.42 9.38004 5.42 9.91004C5.42 10.44 5.2 10.97 4.83 11.3ZM7.02 7.16004H8.09V12.66H7.02V7.16004ZM10.71 9.27004C10.07 9.03004 9.88 8.87004 9.88 8.58004C9.88 8.23004 10.22 7.97004 10.68 7.97004C11 7.97004 11.27 8.10004 11.54 8.42004L12.1 7.69004C11.64 7.29004 11.09 7.08004 10.48 7.08004C9.51 7.08004 8.76 7.76004 8.76 8.66004C8.76 9.42004 9.11 9.81004 10.11 10.17C10.53 10.32 10.74 10.42 10.85 10.48C11.06 10.62 11.17 10.82 11.17 11.05C11.17 11.5 10.82 11.83 10.34 11.83C9.83 11.83 9.42 11.57 9.17 11.1L8.48 11.77C8.97 12.5 9.57 12.82 10.38 12.82C11.49 12.82 12.28 12.08 12.28 11.01C12.3 10.12 11.93 9.72004 10.71 9.27004ZM12.63 9.92004C12.63 11.54 13.9 12.79 15.53 12.79C15.99 12.79 16.39 12.7 16.87 12.47V11.21C16.44 11.64 16.06 11.81 15.58 11.81C14.5 11.81 13.73 11.03 13.73 9.91004C13.73 8.85004 14.52 8.02004 15.53 8.02004C16.04 8.02004 16.43 8.20004 16.87 8.64004V7.38004C16.4 7.14004 16.01 7.04004 15.55 7.04004C13.94 7.04004 12.63 8.32004 12.63 9.92004ZM25.39 10.86L23.92 7.16004H22.75L25.08 12.8H25.66L28.03 7.16004H26.87L25.39 10.86ZM28.52 12.66H31.56V11.73H29.59V10.25H31.49V9.32004H29.59V8.10004H31.56V7.16004H28.52V12.66ZM35.81 8.79004C35.81 7.76004 35.1 7.17004 33.86 7.17004H32.27V12.67H33.34V10.46H33.48L34.96 12.67H36.28L34.55 10.35C35.36 10.18 35.81 9.63004 35.81 8.79004ZM33.65 9.70004H33.34V8.03004H33.67C34.34 8.03004 34.7 8.31004 34.7 8.85004C34.7 9.40004 34.34 9.70004 33.65 9.70004Z"
                                            fill="#231F20"></path>
                                        <path
                                            d="M20.16 12.86C20.9374 12.86 21.6829 12.5512 22.2325 12.0016C22.7822 11.4519 23.091 10.7064 23.091 9.92905C23.091 9.1517 22.7822 8.40619 22.2325 7.85652C21.6829 7.30685 20.9374 6.99805 20.16 6.99805C19.3827 6.99805 18.6371 7.30685 18.0875 7.85652C17.5378 8.40619 17.229 9.1517 17.229 9.92905C17.229 10.7064 17.5378 11.4519 18.0875 12.0016C18.6371 12.5512 19.3827 12.86 20.16 12.86Z"
                                            fill="url(#paint0_linear_2054_613)"></path>
                                        <path opacity="0.65"
                                            d="M20.16 12.86C20.9374 12.86 21.6829 12.5512 22.2325 12.0016C22.7822 11.4519 23.091 10.7064 23.091 9.92905C23.091 9.1517 22.7822 8.40619 22.2325 7.85652C21.6829 7.30685 20.9374 6.99805 20.16 6.99805C19.3827 6.99805 18.6371 7.30685 18.0875 7.85652C17.5378 8.40619 17.229 9.1517 17.229 9.92905C17.229 10.7064 17.5378 11.4519 18.0875 12.0016C18.6371 12.5512 19.3827 12.86 20.16 12.86Z"
                                            fill="url(#paint1_linear_2054_613)"></path>
                                        <path
                                            d="M36.57 7.50645C36.57 7.40645 36.5 7.35645 36.39 7.35645H36.23V7.83645H36.35V7.64645L36.49 7.83645H36.63L36.47 7.63645C36.53 7.62645 36.57 7.57645 36.57 7.50645ZM36.37 7.57645H36.35V7.44645H36.37C36.43 7.44645 36.46 7.46645 36.46 7.50645C36.46 7.55645 36.43 7.57645 36.37 7.57645Z"
                                            fill="#231F20"></path>
                                        <path
                                            d="M36.41 7.17578C36.18 7.17578 35.99 7.36578 35.99 7.59578C35.99 7.82578 36.18 8.01578 36.41 8.01578C36.64 8.01578 36.83 7.82578 36.83 7.59578C36.83 7.36578 36.64 7.17578 36.41 7.17578ZM36.41 7.94578C36.23 7.94578 36.07 7.79578 36.07 7.59578C36.07 7.40578 36.22 7.24578 36.41 7.24578C36.59 7.24578 36.74 7.40578 36.74 7.59578C36.74 7.78578 36.59 7.94578 36.41 7.94578Z"
                                            fill="#231F20"></path>
                                        <path
                                            d="M37 12.9844C37 12.9844 27.09 19.8734 8.97595 23.0004H34.999C35.5266 23.0004 36.0329 22.7919 36.4075 22.4203C36.7822 22.0486 36.9947 21.544 36.999 21.0164L37.023 17.9964L37 12.9844Z"
                                            fill="#F48120"></path>
                                    </g>
                                    <defs>
                                        <linearGradient id="paint0_linear_2054_613" x1="21.657" y1="12.275"
                                            x2="19.632" y2="9.10405" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#F89F20"></stop>
                                            <stop offset="0.25" stop-color="#F79A20"></stop>
                                            <stop offset="0.533" stop-color="#F68D20"></stop>
                                            <stop offset="0.62" stop-color="#F58720"></stop>
                                            <stop offset="0.723" stop-color="#F48120"></stop>
                                            <stop offset="1" stop-color="#F37521"></stop>
                                        </linearGradient>
                                        <linearGradient id="paint1_linear_2054_613" x1="21.338" y1="12.232"
                                            x2="18.378" y2="6.44605" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#F58720"></stop>
                                            <stop offset="0.359" stop-color="#E16F27"></stop>
                                            <stop offset="0.703" stop-color="#D4602C"></stop>
                                            <stop offset="0.982" stop-color="#D05B2E"></stop>
                                        </linearGradient>
                                        <clipPath id="clip0_2054_613">
                                            <rect width="38" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
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

<!doctype html>
<html lang="en">


<!-- Mirrored from freshcart-furniture.codescandy.com/checkout-thankyou.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jan 2025 08:34:19 GMT -->
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="{{ asset('assets/libs/drift-zoom/dist/drift-basic.min.css') }}" />
	<!-- Favicon icon-->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}" />
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}" />
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}" />
	<link rel="manifest" href="{{ asset('assets/images/favicon/site.html') }}" />
	<link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon.ico') }}" />

	<!-- Libs CSS -->
	<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" />
	<link href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">

	<title>Shopping Thankyou eCommerce HTML Template - FreshCart Furniture</title>
</head>


<body>
	<!--Thankyou for order start-->
	@yield('section-checkoutthankyou')
	<!--Thankyou for order end-->
	<!--Product start-->
	<!--Product end-->
	@include('layouts-checkoutthankyou.footer') <!-- Scroll top -->
	<div class="btn-scroll-top">
		<svg class="progress-square svg-content" width="100%" height="100%" viewBox="0 0 40 40">
			<path
				d="M8 1H32C35.866 1 39 4.13401 39 8V32C39 35.866 35.866 39 32 39H8C4.13401 39 1 35.866 1 32V8C1 4.13401 4.13401 1 8 1Z" />
		</svg>
	</div>
	<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasSearchProduct"
		aria-labelledby="offcanvasSearchProductLabel" style="width: 500px">
		<div class="offcanvas-header p-5">
			<div class="border-bottom d-flex align-items-center w-100 pb-2">
				<input type="search" class="form-control border-0 ps-0 form-focus-none" placeholder="Search for..." />
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
		</div>
		<div class="offcanvas-body px-5 pb-5">
			<span>Popular</span>

			<ul class="list-unstyled lh-lg mt-4 fs-6">
				<li><a href="product-list.html" class="text-link">Stylish Wooden Table Lamp</a></li>
				<li><a href="product-list.html" class="text-link">Assortment of Tumbler</a></li>
				<li><a href="product-list.html" class="text-link">Succulent Plant Pot</a></li>
				<li><a href="product-list.html" class="text-link">Stainless electric kettle</a></li>
				<li><a href="product-list.html" class="text-link">Wooden Stool</a></li>
			</ul>
		</div>
	</div>
	<!-- Offcanvas for Cart Summary -->
	<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel"
		style="width: 500px">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title" id="cartOffcanvasLabel">Shopping cart</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body position-relative">
			<div id="emptyCartMessage" class="text-center" style="display: none">
				<div>
					<svg width="58" height="65" viewBox="0 0 58 65" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="28.5" width="29" height="30" rx="14.5" fill="#211F1C" />
						<path
							d="M42.892 21.16C41.8893 21.16 41.0307 20.9307 40.316 20.472C39.612 20.0133 39.0733 19.3573 38.7 18.504C38.3267 17.64 38.14 16.6053 38.14 15.4C38.14 14.1947 38.3267 13.1653 38.7 12.312C39.0733 11.448 39.612 10.7867 40.316 10.328C41.0307 9.86933 41.8893 9.64 42.892 9.64C43.8947 9.64 44.7533 9.86933 45.468 10.328C46.1827 10.7867 46.7267 11.448 47.1 12.312C47.4733 13.1653 47.66 14.1947 47.66 15.4C47.66 16.6053 47.4733 17.64 47.1 18.504C46.7267 19.3573 46.1827 20.0133 45.468 20.472C44.7533 20.9307 43.8947 21.16 42.892 21.16ZM42.892 18.856C43.5853 18.856 44.1187 18.5573 44.492 17.96C44.876 17.3627 45.068 16.5093 45.068 15.4C45.068 14.2587 44.876 13.384 44.492 12.776C44.1187 12.1573 43.5853 11.848 42.892 11.848C42.1987 11.848 41.66 12.1573 41.276 12.776C40.9027 13.384 40.716 14.2587 40.716 15.4C40.716 16.5093 40.9027 17.3627 41.276 17.96C41.66 18.5573 42.1987 18.856 42.892 18.856Z"
							fill="white" />
						<path
							d="M44.1875 30.5112C43.9738 30.2711 43.7115 30.079 43.418 29.9478C43.1245 29.8165 42.8065 29.7491 42.485 29.75H32.75V29C32.75 26.812 31.8808 24.7135 30.3336 23.1664C28.7864 21.6192 26.688 20.75 24.5 20.75C22.3119 20.75 20.2135 21.6192 18.6663 23.1664C17.1192 24.7135 16.25 26.812 16.25 29V29.75H6.51498C6.19348 29.7491 5.87546 29.8165 5.58196 29.9478C5.28847 30.079 5.02619 30.2711 4.81247 30.5112C4.60239 30.7482 4.44469 31.0269 4.3497 31.329C4.25471 31.6311 4.22456 31.9498 4.26122 32.2644L6.93497 54.7644C7.00002 55.3142 7.26549 55.8207 7.68061 56.1871C8.09572 56.5534 8.63134 56.7538 9.18497 56.75H39.8131C40.3667 56.7538 40.9023 56.5534 41.3175 56.1871C41.7326 55.8207 41.9981 55.3142 42.0631 54.7644L44.7368 32.2644C44.7738 31.95 44.7439 31.6313 44.6492 31.3292C44.5546 31.0271 44.3972 30.7484 44.1875 30.5112ZM17.75 29C17.75 27.2098 18.4611 25.4929 19.727 24.227C20.9929 22.9612 22.7098 22.25 24.5 22.25C26.2902 22.25 28.0071 22.9612 29.2729 24.227C30.5388 25.4929 31.25 27.2098 31.25 29V29.75H17.75V29ZM43.25 32.0863L40.5781 54.5863C40.5567 54.7715 40.467 54.9421 40.3266 55.0648C40.1862 55.1875 40.0052 55.2536 39.8187 55.25H9.18685C9.00202 55.2512 8.82324 55.1842 8.68482 55.0617C8.54641 54.9392 8.4581 54.7699 8.43685 54.5863L5.74997 32.0863C5.73776 31.9819 5.74819 31.8761 5.78055 31.7761C5.8129 31.6761 5.86643 31.5843 5.93747 31.5069C6.00988 31.4254 6.09886 31.3603 6.19846 31.316C6.29805 31.2717 6.40597 31.2492 6.51498 31.25H16.25V36.5C16.25 36.6989 16.329 36.8897 16.4696 37.0303C16.6103 37.171 16.8011 37.25 17 37.25C17.1989 37.25 17.3897 37.171 17.5303 37.0303C17.671 36.8897 17.75 36.6989 17.75 36.5V31.25H31.25V36.5C31.25 36.6989 31.329 36.8897 31.4696 37.0303C31.6103 37.171 31.8011 37.25 32 37.25C32.1989 37.25 32.3897 37.171 32.5303 37.0303C32.671 36.8897 32.75 36.6989 32.75 36.5V31.25H42.485C42.594 31.2492 42.7019 31.2717 42.8015 31.316C42.9011 31.3603 42.9901 31.4254 43.0625 31.5069C43.1335 31.5843 43.187 31.6761 43.2194 31.7761C43.2518 31.8761 43.2622 31.9819 43.25 32.0863Z"
							fill="#211F1C" />
					</svg>
				</div>
				<p class="">Your cart is empty</p>
				<a href="product-list.html" class="btn btn-dark">Continue Shopping</a>
			</div>

			<div id="cartItems" class="mb-3">
				<!-- Cart items will be dynamically inserted here -->
			</div>
			<div id="totalAmountContainer"
				class="flex-column justify-content-between position-absolute start-0 end-0 bottom-0 p-4 border-top text-dark fw-semibold"
				style="display: none !important">
				<div class="d-flex align-items-center justify-content-between w-100 mb-3">
					<strong>Total:</strong>
					<span id="totalAmount">$0.00</span>
				</div>
				<div class="d-grid">
					<a href="shopping-checkout.html"
						class="btn btn-dark d-inline-flex align-items-center justify-content-center gap-2">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
							class="bi bi-lock" viewBox="0 0 16 16">
							<path
								d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
						</svg>
						Checkout
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="toast-container position-fixed bottom-0 start-0 p-3">
		<div id="itemAddedToast" class="toast bg-warning-subtle border-0" role="alert" aria-live="assertive"
			aria-atomic="true">
			<div class="toast-header bg-warning-subtle border-warning border-opacity-25">
				<strong class="me-auto">Cart</strong>
				<small>Now</small>
				<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
			<div class="toast-body">Your item is added.</div>
		</div>
	</div>


	<!-- Libs JS -->
	<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- Swiper JS -->
<script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>

<!-- Theme JS -->
<script src="{{ asset('assets/js/theme.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/flag.js') }}"></script>
<script src="{{ asset('assets/js/vendors/btn-scrolltop.js') }}"></script>
<script src="{{ asset('assets/js/vendors/add-to-cart.js') }}"></script>
<script src="{{ asset('assets/js/vendors/choice.js') }}"></script>
<script src="{{ asset('assets/libs/drift-zoom/dist/Drift.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/drift.js') }}"></script>
<script src="{{ asset('assets/js/vendors/color-change.js') }}"></script>

</body>


<!-- Mirrored from freshcart-furniture.codescandy.com/checkout-thankyou.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jan 2025 08:34:19 GMT -->
</html>

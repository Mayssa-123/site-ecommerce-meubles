@extends('welcome')
@section('section')
<section class="py-lg-8 py-5">
    <div class="container">
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

            <!-- Contenu principal -->
            <div class="col-lg-9 col-md-8">
                <div class="row g-3 mb-4 align-items-center">
                    <div class="col-lg-9 col-md-6 col-4">
                        <h1 class="mb-0 h2">Wishlist</h1>
                    </div>
                    <div class="col-lg-3 col-md-6 col-8 text-end">
                        <a href="#!" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#wishlistModal">+ Add Wishlist</a>
                    </div>
                </div>
                <div class="row gy-6 gx-4">
                    @if($wishlistItems->isEmpty())
                        <p>Your wishlist is empty.</p>
                    @else
                        @foreach ($wishlistItems as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="product-card">
                                <div class="border text-center product-card-img mb-4">
                                    <img src="{{ asset($item->product->images->first()->image_path) }}" class="card-img-top" alt="{{ $item->product->name }}">
                                <div class="product-card-btn">
                                    <button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse " data-bs-toggle="modal"
                                    data-bs-target="#quickViewModal">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-eye animate-target" viewBox="0 0 16 16">
                                        <path
                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                    </button>
                                    <button type="button" class="btn btn-primary  btn-sm quick-add-btn"
                                    data-product-name="Sofa with wood legs" data-product-price="14.00"
                                    data-product-img="assets/images/product/product-img-10.jpg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                    Quick add
                                    </button>
                                </div>

                                <div class="form-check position-absolute end-0  top-0 p-3">
                                    <input type="checkbox" class="form-check-input" id="exampleCheckSale">
                                    <label class="form-check-label visually-hidden" for="exampleCheckSale">Check me out</label>
                                </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="small fw-medium text-uppercase">{{ $item->product->name }}</span>
                                    <div class="d-flex gap-3 align-items-center">
                                        <span class="">
                                        4.5
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                            class="bi bi-star-fill align-baseline text-warning" viewBox="0 0 16 16">
                                            <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        </span>
                                        <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-heart animate-target" viewBox="0 0 16 16">
                                            <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                        </svg>
                                        </button>

                                    </div>
                                </div>
                                <div>
                                    <p class="mb-0 lh-1 text-dark fw-semibold">
                                        <span class="text-danger">${{ $item->product->price - $item->product->promotion  }}</span>
                                        @if ($item->product->promotion)
                                        <span class="text-decoration-line-through">${{ $item->product->promotion }}</span>
                                        @endif
                                    </p>
                                    <form action="{{ route('wishlists.destroy', $item->product_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remove from Wishlist</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
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
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock"
              viewBox="0 0 16 16">
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

  <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-body p-5">
          <div
            class="position-absolute top-0 start-100 translate-middle mt-n4 ms-4 bg-white p-1 d-flex align-items-center justify-content-center">
            <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="container px-0">
            <div class="row gy-4">
              <div class="col-lg-6">
                <div class="position-relative d-flex flex-column h-100" id="zoomPane">
                  <div><span class="badge bg-info">New</span></div>
                  <div
                    class="d-flex align-items-start flex-md-row flex-column justify-content-between mt-3 mb-md-2 mb-3">
                    <div class="mb-md-3">
                      <h2 class="h4">Office Chair Pillow</h2>
                      <span>( Brand Name )</span>
                    </div>
                    <div class="text-success d-flex align-items-center gap-2 mt-2">
                      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.2"
                          d="M14 8C14 9.18669 13.6481 10.3467 12.9888 11.3334C12.3295 12.3201 11.3925 13.0892 10.2961 13.5433C9.19975 13.9974 7.99335 14.1162 6.82946 13.8847C5.66558 13.6532 4.59648 13.0818 3.75736 12.2426C2.91825 11.4035 2.3468 10.3344 2.11529 9.17054C1.88378 8.00666 2.0026 6.80026 2.45673 5.7039C2.91085 4.60754 3.67989 3.67047 4.66658 3.01118C5.65328 2.35189 6.81331 2 8 2C9.5913 2 11.1174 2.63214 12.2426 3.75736C13.3679 4.88258 14 6.4087 14 8Z"
                          fill="#16A34A" />
                        <path
                          d="M10.8538 6.14625C10.9002 6.19269 10.9371 6.24783 10.9623 6.30853C10.9874 6.36923 11.0004 6.43429 11.0004 6.5C11.0004 6.56571 10.9874 6.63077 10.9623 6.69147C10.9371 6.75217 10.9002 6.80731 10.8538 6.85375L7.35375 10.3538C7.30732 10.4002 7.25217 10.4371 7.19147 10.4623C7.13077 10.4874 7.06571 10.5004 7 10.5004C6.9343 10.5004 6.86923 10.4874 6.80853 10.4623C6.74783 10.4371 6.69269 10.4002 6.64625 10.3538L5.14625 8.85375C5.05243 8.75993 4.99972 8.63268 4.99972 8.5C4.99972 8.36732 5.05243 8.24007 5.14625 8.14625C5.24007 8.05243 5.36732 7.99972 5.5 7.99972C5.63268 7.99972 5.75993 8.05243 5.85375 8.14625L7 9.29313L10.1463 6.14625C10.1927 6.09976 10.2478 6.06288 10.3085 6.03772C10.3692 6.01256 10.4343 5.99961 10.5 5.99961C10.5657 5.99961 10.6308 6.01256 10.6915 6.03772C10.7522 6.06288 10.8073 6.09976 10.8538 6.14625ZM14.5 8C14.5 9.28558 14.1188 10.5423 13.4046 11.6112C12.6903 12.6801 11.6752 13.5132 10.4874 14.0052C9.29973 14.4972 7.99279 14.6259 6.73192 14.3751C5.47104 14.1243 4.31285 13.5052 3.40381 12.5962C2.49477 11.6872 1.8757 10.529 1.6249 9.26809C1.37409 8.00721 1.50282 6.70028 1.99479 5.51256C2.48676 4.32484 3.31988 3.30968 4.3888 2.59545C5.45772 1.88122 6.71442 1.5 8 1.5C9.72335 1.50182 11.3756 2.18722 12.5942 3.40582C13.8128 4.62441 14.4982 6.27665 14.5 8ZM13.5 8C13.5 6.9122 13.1774 5.84883 12.5731 4.94436C11.9687 4.03989 11.1098 3.33494 10.1048 2.91866C9.09977 2.50238 7.9939 2.39346 6.92701 2.60568C5.86011 2.8179 4.8801 3.34172 4.11092 4.11091C3.34173 4.8801 2.8179 5.86011 2.60568 6.927C2.39347 7.9939 2.50238 9.09977 2.91867 10.1048C3.33495 11.1098 4.0399 11.9687 4.94437 12.5731C5.84884 13.1774 6.91221 13.5 8 13.5C9.45819 13.4983 10.8562 12.9184 11.8873 11.8873C12.9184 10.8562 13.4983 9.45818 13.5 8Z"
                          fill="#16A34A" />
                      </svg>
                      In Stock
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-md-center">
                    <div class="d-flex flex-md-row flex-column gap-2 align-items-md-center">
                      <p class="mb-0">
                        <span class="text-danger">$300.00</span>
                        <span class="text-decoration-line-through">$400.00</span>
                      </p>
                      <span class="badge bg-danger">Save $100.00</span>
                    </div>
                    <span class="">
                      4.5
                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                        class="bi bi-star-fill align-baseline text-primary" viewBox="0 0 16 16">
                        <path
                          d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                        </path>
                      </svg>
                    </span>
                  </div>
                  <div class="mt-auto">
                    <hr class="my-3" />
                    <div>
                      <div class="mb-4">
                        <label class="form-label fw-semibold pb-1 mb-2">
                          Color:
                          <span class="text-body fw-normal" id="colorOption">Gray</span>
                        </label>
                        <div class="d-flex flex-wrap gap-2 align-items-center" data-label="#colorOption">
                          <input type="radio" class="btn-check" name="colors" id="grayColor" checked="" />
                          <label for="grayColor" class="btn-color-swatch" data-label="Gray">
                            <span class="icon-shape icon-xxs bg-light"></span>
                            <span class="visually-hidden">Gray</span>
                          </label>
                          <input type="radio" class="btn-check" name="colors" id="BlackColor" />
                          <label for="BlackColor" class="btn-color-swatch" data-label="Green">
                            <span class="icon-shape icon-xxs bg-success"></span>
                            <span class="visually-hidden">Black</span>
                          </label>
                          <input type="radio" class="btn-check" name="colors" id="blueColor" />
                          <label for="blueColor" class="btn-color-swatch" data-label="Blue">
                            <span class="icon-shape icon-xxs bg-info"></span>
                            <span class="visually-hidden">Blue</span>
                          </label>
                          <input type="radio" class="btn-check" name="colors" id="redColor" />
                          <label for="redColor" class="btn-color-swatch" data-label="Red">
                            <span class="icon-shape icon-xxs bg-danger"></span>
                            <span class="visually-hidden">Red</span>
                          </label>
                        </div>
                      </div>
                    </div>

                    <hr class="my-3" />
                    <div class="d-flex align-items-center gap-3 mb-4">
                      <span>Quantity:</span>
                      <div class="d-flex align-items-center border p-2">
                        <button class="btn btn-icon btn-xs btn-focus-none quantity-btn minus fs-5">-</button>
                        <input type="number" class="form-control quantity-input text-center mx-1 p-0 border-0" value="1"
                          min="1" style="width: 50px" />
                        <button class="btn btn-icon btn-xs btn-focus-none quantity-btn plus fs-5">+</button>
                      </div>
                    </div>
                    <div class="d-flex flex-md-row flex-column gap-2 gap-md-1">
                      <a href="#!" class="btn btn-dark">Add to Cart</a>
                      <a href="#!" class="btn btn-outline-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                          class="bi bi-heart" viewBox="0 0 16 16">
                          <path
                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                        </svg>
                        Add to Wishlist
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="swiper-container swiper" data-thumbs="true" id="swiper-4" data-pagination-type=""
                  data-speed="400" data-space-between="120" data-pagination="false" data-navigation="false"
                  data-autoplay="false" data-effect="fade" data-autoplay-delay="3000"
                  data-breakpoints='{"480": {"slidesPerView": 1}, "768": {"slidesPerView": 1}, "1024": {"slidesPerView": 1}}'>
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <img src="assets/images/product/product-single-img1.jpg"
                        data-zoom="./assets/images/product/product-single-img1.jpg" alt="Preview" class="drift w-100"
                        data-zoom-options='{
                                                "paneSelector": "#zoomPane",

                                                "hoverDelay": 500,
                                                "touchDisable": true
                                        }' />
                    </div>
                    <div class="swiper-slide">
                      <img src="assets/images/product/product-single-img2.jpg"
                        data-zoom="./assets/images/product/product-single-img2.jpg" alt="Preview" class="drift w-100"
                        data-zoom-options='{
                                                "paneSelector": "#zoomPane",

                                                "hoverDelay": 500,
                                                "touchDisable": true
                                        }' />
                    </div>
                    <div class="swiper-slide">
                      <img src="assets/images/product/product-single-img3.jpg"
                        data-zoom="./assets/images/product/product-single-img3.jpg" alt="Preview" class="drift w-100"
                        data-zoom-options='{
                                            "paneSelector": "#zoomPane",

                                            "hoverDelay": 500,
                                            "touchDisable": true
                                    }' />
                    </div>
                    <div class="swiper-slide">
                      <img src="assets/images/product/product-single-img4.jpg"
                        data-zoom="./assets/images/product/product-single-img4.jpg" alt="Preview" class="drift w-100"
                        data-zoom-options='{
                                                "paneSelector": "#zoomPane",

                                                "hoverDelay": 500,
                                                "touchDisable": true
                                        }' />
                    </div>

                    <!-- Add more slides as needed -->
                  </div>
                </div>

                <!-- Thumbs Swiper Container -->
                <div class="swiper-container swiper-thumbs mt-2 overflow-hidden">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="ratio ratio-1x1 border">
                        <img src="assets/images/product/product-single-img1.jpg" alt="product image" class="" />
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="ratio ratio-1x1 border">
                        <img src="assets/images/product/product-single-img2.jpg" alt="product image" class="" />
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="ratio ratio-1x1 border">
                        <img src="assets/images/product/product-single-img3.jpg" alt="product image" class="" />
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="ratio ratio-1x1 border">
                        <img src="assets/images/product/product-single-img4.jpg" alt="product image" class="" />
                      </div>
                    </div>

                    <!-- Add more thumbnails as needed -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('layouts-wishlist.footer')

@endsection

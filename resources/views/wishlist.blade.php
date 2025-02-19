<!doctype html>
<html lang="en">


<!-- Mirrored from freshcart-furniture.codescandy.com/account-wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jan 2025 08:34:24 GMT -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" />
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

    <title>Account Wishlist eCommerce HTML Template - FreshCart Furniture</title>
  </head>


<body>
@include('layouts-wishlist.menu')
@yield('sectionwishlist')

 @include('layouts-wishlist.footer')

  <!-- Libs JS -->
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Swiper JS -->
  <script src="assets/libs/swiper/swiper-bundle.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.min.js"></script>

  <!-- Theme JS -->
  <script src="assets/js/theme.min.js"></script>
  <!--modal-->
  <div class="modal fade " id="wishlistModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content p-5 d-flex flex-column gap-4">
        <div class="d-flex flex-row align-items-center justify-content-between">
          <h2 class="modal-title fs-5" id="wishlistModalLabel">Create New Wishlist</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">

          <form class="needs-validation" novalidate>
            <div class="row gy-3">
              <!-- row -->


              <div class="col-12">
                <!-- input -->

                <label for="accountWishList" class="form-label visually-hidden">Wishlist name</label>

                <input type="text" class="form-control" id="accountWishList" placeholder="Wishlist name*" required />

                <div class="invalid-feedback">Please enter wishlist name.</div>

              </div>
              <div class="col-12">
                <label for="accountDescription" class="form-label visually-hidden">Descriptions</label>
                <textarea class="form-control" id="accountDescription" placeholder="Descriptions" rows="4"
                  required></textarea>
                <div class="invalid-feedback">
                  Please enter a Descriptions.
                </div>
              </div>
              <div class="col-12">
                <select data-choices data-choices-removeitembutton="true" data-choices-classname="form-select"
                  aria-label="Default select example">
                  <option value="">Private</option>
                  <option value="1">Public</option>
                  <option value="2">Shared</option>

                </select>

                <div class="invalid-feedback">Example invalid select feedback</div>
              </div>
              <!-- btn -->
              <div class="d-flex gap-3">
                <button type="submit" class="btn btn-secondary w-100" data-bs-dismiss="modal"
                  data-bs-target="#wishlistModal">Cancel</button>

                <button type="submit" class="btn btn-primary w-100">Create wishlist</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <script src="assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

  <script src="assets/js/vendors/choice.js"></script>
  <script src="assets/js/vendors/flag.js"></script>
  <script src="assets/js/vendors/add-to-cart.js"></script>
  <script src="assets/js/vendors/validation.js"></script>
  <script src="assets/js/vendors/btn-scrolltop.js"></script>
  <script src="assets/js/vendors/sidenav.js"></script>
  <script src="assets/libs/drift-zoom/dist/Drift.min.js"></script>
  <script src="assets/js/vendors/drift.js"></script>
  <script src="assets/js/vendors/color-change.js"></script>
  <script src="assets/js/vendors/qty-input.js"></script>

</body>


<!-- Mirrored from freshcart-furniture.codescandy.com/account-wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jan 2025 08:34:24 GMT -->
</html>

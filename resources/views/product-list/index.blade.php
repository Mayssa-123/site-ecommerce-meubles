@extends('welcome')
@section('section')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<section class="bg-light d-flex flex-column align-items-center justify-content-center" style="
				background:
					linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.22)),
					url(assets/images/jpg/page-header-img.jpg) no-repeat;
				background-position: center;
				background-size: cover;
			">
		<div class="container">
			<div class="row align-items-center py-6">
				<div class="col-lg-6">

					<div class="position-relative z-1">
						<h1 class="mb-4 text-white">Office</h1>
						<p class="lead text-white">As everyone heads back to work, whether that be into the office or
							the classroom, having an organized desk space is essential.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="w-lg-50 w-100 position-absolute end-0 top-0 object-fit-cover"></div>
	</section>
    <div class="container">
		<div class="row">
			<div class="col-12 py-2">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 fw-medium">
						<li class="breadcrumb-item"><a href="#!">Shop</a></li>
						<li class="breadcrumb-item active" aria-current="page">Office</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	<!--Breadcrumb end-->
	<!--Filter button start-->
	<div class="position-fixed bottom-0 start-50 translate-middle d-block d-lg-none z-1">
		<a class="btn btn-dark d-flex align-items-center gap-2" data-bs-toggle="offcanvas" href="#offcanvasCategory"
			role="button" aria-controls="offcanvasCategory">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders2"
				viewBox="0 0 16 16">
				<path fill-rule="evenodd"
					d="M10.5 1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4H1.5a.5.5 0 0 1 0-1H10V1.5a.5.5 0 0 1 .5-.5M12 3.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-6.5 2A.5.5 0 0 1 6 6v1.5h8.5a.5.5 0 0 1 0 1H6V10a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5M1 8a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 1 8m9.5 2a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V13H1.5a.5.5 0 0 1 0-1H10v-1.5a.5.5 0 0 1 .5-.5m1.5 2.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5" />
			</svg>
			<span>Filter</span>
		</a>
	</div>

<section class="py-md-6 pb-6">
    <div class="container">
        <div class="row">
            <!--Filter-->
            <aside class="col-lg-3 col-md-4 mb-6 mb-md-0">
                <div class="offcanvas offcanvas-start offcanvas-collapse w-md-50 border-end-0" tabindex="-1"
                    id="offcanvasCategory" aria-labelledby="offcanvasCategoryLabel">
                    <div class="offcanvas-header d-lg-none">
                        <h5 class="offcanvas-title" id="offcanvasCategoryLabel">Filter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body ps-lg-2 pt-lg-0">

                        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                            <!--In stock only-->
                            <div>
                                <h5 class="mb-0 fs-6">In stock only</h5>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="flexSwitchCheckChecked" checked />
                                <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                            </div>
                        </div>
                        <!--Product type-->
                        <div class="mb-3 border-bottom pb-3">
                            <a class="d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
                               href="#collapseProductType" role="button" aria-expanded="true"
                               aria-controls="collapseProductType">
                                <h5 class="mb-0 fs-6">Product Type</h5>
                                <i class="bi bi-chevron-down chevron-down"></i>
                            </a>
                            <div class="collapse show" id="collapseProductType">
                                <div class="mt-3">
                                    <!-- Boucle pour afficher les catégories -->
                                    @foreach ($categories as $categorie)
                        <div class="form-check mb-2">
                            <input class="form-check-input category-checkbox" type="checkbox" value="{{ $categorie->id }}" id="categorie{{ $categorie->id }}" />
                            <label class="form-check-label" for="categorie{{ $categorie->id }}">{{ $categorie->name }}</label>
                        </div>
                    @endforeach

                                </div>
                            </div>
                        </div>

                        <!--Price-->
                        <div class="mb-3 border-bottom pb-3">
                            <a class="d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
                                href="#collapsePrice" role="button" aria-expanded="true"
                                aria-controls="collapsePrice">
                                <h5 class="mb-0 fs-6">Price</h5>
                                <i class="bi bi-chevron-down chevron-down"></i>
                            </a>
                            <div class="collapse show" id="collapsePrice">
                                <div class="mt-3">
                                    <!-- range -->
                                    <div id="priceRange" class="mb-3"></div>
                                    <!-- <small class="text-muted">Price:</small> -->
                                    <span id="priceRange-value" class="small d-flex justify-content-between"></span>
                                </div>
                            </div>
                        </div>
                        <!--Rating-->
                        <!--Rating-->
							<div class="mb-3 border-bottom pb-3">
								<a class="d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
									href="#collapseRating" role="button" aria-expanded="true"
									aria-controls="collapseRating">
									<h5 class="mb-0 fs-6">Rating</h5>
									<i class="bi bi-chevron-down chevron-down"></i>
								</a>
								<div class="collapse show" id="collapseRating">
									<div class="mt-3">
										<div>

                                            <div class="form-check mb-2">
                                                <input class="form-check-input rating-checkbox" type="checkbox" value="5" id="ratingFive" />
                                                <label class="form-check-label" for="ratingFive">⭐⭐⭐⭐⭐</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input rating-checkbox" type="checkbox" value="4" id="ratingFour" />
                                                <label class="form-check-label" for="ratingFour">⭐⭐⭐⭐</label>
                                            </div><div class="form-check mb-2">
                                                <input class="form-check-input rating-checkbox" type="checkbox" value="4" id="ratingThree" />
                                                <label class="form-check-label" for="ratingFour">⭐⭐⭐</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input rating-checkbox" type="checkbox" value="4" id="ratingTwo" />
                                                <label class="form-check-label" for="ratingFour">⭐⭐</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input rating-checkbox" type="checkbox" value="4" id="ratingOne" />
                                                <label class="form-check-label" for="ratingFour">⭐</label>
                                            </div>



										</div>
									</div>
								</div>
							</div>
                    </div>
                </div>
            </aside>
            <div class="col-lg-9">

                <div id="filterprod">
                    @include('product-list.contenu')
                </div>


            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function () {

        let priceRange = document.getElementById('priceRange');

        // Initialisation du slider avec wNumb
        /* noUiSlider.create(priceRange, {
            start: [0, 1000],
            connect: true,
            range: {
                'min': 0,
                'max': 1000
            },
            tooltips: [wNumb({ decimals: 0, prefix: '$' }), wNumb({ decimals: 0, prefix: '$' })]
        }); */

        // Fonction pour récupérer les valeurs des filtres
        function filterProducts() {

            let selectedCategories = [];
            $('.category-checkbox:checked').each(function () {
                selectedCategories.push($(this).val());
            });

            let selectedRatings = [];
            $('.rating-checkbox:checked').each(function () {
                selectedRatings.push($(this).val());
            });

            let priceValues = priceRange.noUiSlider.get();
            let minPrice = priceValues[0];
            let maxPrice = priceValues[1];

            $.ajax({
                url: "{{ route('product.filter') }}",
                type: "GET",
                data: {
                    categories: selectedCategories,
                    min_price: minPrice,
                    max_price: maxPrice,
                    ratings: selectedRatings
                },
                success: function (response) {
                    $('#filterprod').html(response);
                }
            });
        }

        // **Déclenchement des filtres**
        $('.category-checkbox, .rating-checkbox').on('change', filterProducts);
        priceRange.noUiSlider.on('change', filterProducts);
    });
</script>


@include('layouts.footer')
<!-- Styles de noUiSlider -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider/dist/nouislider.min.css">

<!-- Script de noUiSlider -->
<script src="https://cdn.jsdelivr.net/npm/nouislider/dist/nouislider.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/wnumb/wNumb.min.js"></script> <!-- Pour formater les nombres -->
@endsection



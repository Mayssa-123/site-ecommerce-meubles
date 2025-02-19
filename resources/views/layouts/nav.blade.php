<nav class="navbar navbar-expand-xl sticky-top bg-white  w-100 border-bottom">
		<div class="container">
			<div class="d-flex justify-content-between w-100 align-items-center">
				<div class="d-flex align-items-center w-100 w-md-auto">
					<button class="navbar-toggler offcanvas-nav-btn" type="button">
						<i class="bi bi-list"></i>
					</button>
					<a class="navbar-brand mx-auto mx-xxl-0 ms-4" href="{{ url('/') }}">
						<img src="{{ asset('assets/images/logo/logo.svg') }}" alt="" />
					</a>
				</div>
				<div class="">
					<div class="offcanvas offcanvas-bottom offcanvas-nav" style="height: 60vh">
						<div class="offcanvas-header position-absolute top-0 start-50 translate-middle mt-n5">

							<button type="button" class="btn-close bg-white opacity-100" data-bs-dismiss="offcanvas"
								aria-label="Close"></button>
						</div>
						<div class="offcanvas-body pt-xl-0 align-items-center">
							<ul class="navbar-nav mb-2 mb-lg-0 ">

								<li class="nav-item dropdown border-bottom border-bottom-xl-0">
									<a class="nav-link dropdown-toggle" href="#!" role="button"
										data-bs-toggle="dropdown" aria-expanded="false">Account</a>
									<ul class="dropdown-menu">
										<li class="dropdown-submenu dropend">
											<a class="dropdown-item dropdown-list-group-item dropdown-toggle"
												href="#!">Auth</a>
											<ul class=" dropdown-menu  px-1 pb-4 pt-0 p-xl-3">
												<li><a class="dropdown-item" href="{{ route('login') }}">Sign In</a></li>
												<li><a class="dropdown-item" href="{{ route('register') }}">Sign Up</a></li>

												<li><a class="dropdown-item" href="forgot-password.html">Forgot
														Password</a></li>
											</ul>
										</li>

										<li><a class="dropdown-item" href="{{ route('wishlists.index') }}">Wishlist</a>
										</li>

										<li><a class="dropdown-item" href="{{ route('passwords.index') }}">Personal
												Info</a>
										</li>


									</ul>
								</li>

                                @if (Auth::check() && optional(Auth::user()->role)->name === 'Admin')
                                <li class="nav-item dropdown w-100 w-lg-auto border-bottom border-bottom-xl-0">
                                    <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                                </li>
                            @endif
                                <li class="nav-item dropdown w-100 w-lg-auto border-bottom border-bottom-xl-0">
									<a class="nav-link " href="{{ route('product-list.index') }}" >List products</a>

								</li>
								<!-- <li class="nav-item">
								<a class="nav-link" href="./cheatsheet.html">Cheatsheet</a>
							</li> -->
							</ul>
							<div class="d-xl-none d-grid position-absolute bottom-0 w-100 start-0 end-0 p-4">
								<a href="signin.html" class="btn btn-primary">Sign in</a>
							</div>
						</div>
					</div>
				</div>

				<div class="d-flex align-items-center gap-4">

					<div class="d-flex align-items-center gap-3">

						<a href="{{ route('login') }}" class="d-none d-md-block">
							<svg width="20" height="20" viewBox="0 0 25 24" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M22.4882 19.6875C21.2029 17.4316 19.1958 15.6738 16.7901 14.6972C17.9864 13.7999 18.8701 12.549 19.316 11.1216C19.7619 9.69424 19.7474 8.16274 19.2745 6.74406C18.8016 5.32539 17.8943 4.09147 16.6812 3.21709C15.468 2.3427 14.0105 1.87219 12.5151 1.87219C11.0197 1.87219 9.5622 2.3427 8.34906 3.21709C7.13591 4.09147 6.22864 5.32539 5.75575 6.74406C5.28286 8.16274 5.26832 9.69424 5.71421 11.1216C6.16009 12.549 7.04379 13.7999 8.24012 14.6972C5.83442 15.6738 3.82735 17.4316 2.54199 19.6875C2.46235 19.8156 2.40926 19.9583 2.3859 20.1073C2.36253 20.2563 2.36936 20.4085 2.40598 20.5548C2.4426 20.7011 2.50826 20.8385 2.59906 20.9589C2.68985 21.0794 2.80393 21.1803 2.93452 21.2557C3.0651 21.3312 3.20952 21.3796 3.35919 21.3981C3.50886 21.4166 3.66073 21.4049 3.80576 21.3635C3.95079 21.3222 4.08603 21.2521 4.20344 21.1574C4.32084 21.0628 4.41801 20.9455 4.48918 20.8125C6.18793 17.8762 9.18793 16.125 12.5151 16.125C15.8423 16.125 18.8423 17.8772 20.5411 20.8125C20.6953 21.0605 20.9399 21.2388 21.2232 21.3097C21.5065 21.3806 21.8063 21.3386 22.0592 21.1925C22.312 21.0464 22.4982 20.8077 22.5783 20.5268C22.6583 20.246 22.6261 19.945 22.4882 19.6875ZM7.64012 9C7.64012 8.03582 7.92603 7.09328 8.4617 6.29159C8.99738 5.4899 9.75875 4.86506 10.6495 4.49609C11.5403 4.12711 12.5205 4.03057 13.4662 4.21867C14.4118 4.40677 15.2805 4.87107 15.9623 5.55285C16.644 6.23463 17.1083 7.10328 17.2964 8.04893C17.4846 8.99459 17.388 9.97479 17.019 10.8656C16.6501 11.7564 16.0252 12.5177 15.2235 13.0534C14.4218 13.5891 13.4793 13.875 12.5151 13.875C11.2226 13.8735 9.98353 13.3594 9.06962 12.4455C8.1557 11.5316 7.64161 10.2925 7.64012 9Z"
									fill="#211F1C" />
							</svg>
						</a>
						<a href="#!" id="quickBuyBtn" class="position-relative" data-bs-toggle="offcanvas"
							data-bs-target="#cartOffcanvas">
							<svg width="20" height="20" viewBox="0 0 25 24" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M22.9214 6.25781C22.7448 6.05922 22.5282 5.90019 22.2859 5.79114C22.0435 5.68208 21.7809 5.62547 21.5151 5.625H17.3742C17.2752 4.40426 16.7204 3.26548 15.8201 2.43518C14.9197 1.60487 13.7399 1.14387 12.5151 1.14387C11.2904 1.14387 10.1105 1.60487 9.21017 2.43518C8.30983 3.26548 7.75501 4.40426 7.65606 5.625H3.52262C3.25718 5.62396 2.99454 5.67929 2.75208 5.78733C2.50962 5.89537 2.29286 6.05367 2.11615 6.25174C1.93943 6.44981 1.80679 6.68315 1.72699 6.93632C1.64719 7.18948 1.62206 7.45671 1.65325 7.72031L2.98919 18.9703C3.04446 19.427 3.26522 19.8477 3.60971 20.1526C3.9542 20.4575 4.39851 20.6256 4.85856 20.625H20.1717C20.6317 20.6256 21.076 20.4575 21.4205 20.1526C21.765 19.8477 21.9858 19.427 22.0411 18.9703L23.377 7.72031C23.4083 7.4582 23.3839 7.19244 23.3054 6.94041C23.2268 6.68839 23.096 6.45578 22.9214 6.25781ZM12.5151 3.375C13.1463 3.37506 13.7563 3.60255 14.2334 4.01577C14.7105 4.429 15.0228 5.0003 15.1129 5.625H9.91731C10.0075 5.0003 10.3197 4.429 10.7968 4.01577C11.2739 3.60255 11.8839 3.37506 12.5151 3.375ZM19.8454 18.375H5.18481L3.937 7.875H21.0933L19.8454 18.375Z"
									fill="#211F1C" />
							</svg>
							<span id="quickBuyCount"
								class="badge text-bg-primary  rounded-pill  position-absolute start-50 top-0 p-1">0</span>
						</a>
					</div>
                    @if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
        @auth
            <ul>
                <li class="nav-item dropdown w-100 w-lg-auto border-bottom border-bottom-xl-0">
                    <a class="nav-link dropdown-toggle" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu">

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-left">
                                    Log out
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
            @endif
        @endauth
    </div>
@endif



    </div>

				</div>
			</div>
		</div>
	</nav>
	<!--Hero slider start-->

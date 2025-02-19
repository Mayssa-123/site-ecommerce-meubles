@extends('welcome')
@section('section')
    <div class="vh-100"
        style="background: url(assets/images/jpg/login-bg.jpg) no-repeat; background-position: center; background-size: cover">
        <div class="h-100 d-flex flex-column justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card mx-4 border-0">
                            <div class="card-body p-md-6 p-4">
                                <div class="mb-5 text-center">
                                    @yield('section-cart')

                                    <a href="index-2.html"><img src="assets/images/logo/logo.svg" alt="Logo" /></a>
                                </div>
                                <div class="mb-3">
                                    <h1 class="fs-4 mb-0">Welcome to your Dashboard</h1>
                                </div>
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    {{ __("You're logged in!") }}
                                </div>
                                <div class="col-12 d-grid gap-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Logout</button>
                                    </form>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

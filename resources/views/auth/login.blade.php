@extends('welcome')
@section('section')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
{{--
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}
    <div class="vh-100"
    style="background: url({{ asset('assets/images/jpg/login-bg.jpg')}}) no-repeat; background-position: center; background-size: cover">
    <div class="h-100 d-flex flex-column justify-content-center">
        <div class="container">
    <div class="row">
        <div class="col-xl-5 col-lg-7">
            <div class="card  mx-4 border-0">
                <div class="card-body p-md-6 p-4">
                    <div class="mb-5 text-center">
                        <a href="index-2.html"><img src="{{ asset("assets/images/logo/logo.svg") }}" alt="" /></a>
                    </div>
                    <div class="mb-3">
                        <h1 class="fs-4 mb-0">Welcome back</h1>
                    </div>
                    <form class="needs-validation" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row g-3">
                            <!-- row -->

                            <div class="col-12">
                                <!-- input -->
                                <label for="formSigninEmail" class="form-label visually-hidden">Email
                                    address</label>
                                <input type="email" class="form-control" id="formSigninEmail"
                                    placeholder="Email" name="email" :value="old('email')" required autofocus autocomplete="username" required />
                                <div class="invalid-feedback">Please enter name.</div>
                            </div>

                            <div class="col-12">
                                <!-- input -->
                                <div class="password-field position-relative">
                                    <label for="formSigninPassword"
                                        class="form-label visually-hidden">Password</label>
                                    <div class="password-field position-relative">
                                        <input type="password" class="form-control fakePassword"
                                            id="formSigninPassword" placeholder="*****" name="password"
                                            required autocomplete="current-password" required />
                                        <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                        <div class="invalid-feedback">Please enter password.</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Reset It link -->
                            <div class="col-12 text-end">
                                <p>Forgot password?
                                <a href="{{ route('password.request') }}" class="text-link">Reset It</a> </p>
                            </div>
                            <!-- btn -->
                            <div class="col-12 d-grid"> <a href="{{ route('profile.edit') }}"></a>
                                <button type="submit" class="btn btn-primary">Sign
                                    In</button></a></div>
                            <!-- link -->
                            <div>
                                Don’t have an account?
                                <a href="{{ route('register') }}" class="text-link">Sign Up</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

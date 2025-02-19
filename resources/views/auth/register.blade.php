@extends('welcome')
@section('section')

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="vh-100"
            style="background: url(assets/images/jpg/login-bg.jpg) no-repeat; background-position: center; background-size: cover">
            <div class="h-100 d-flex flex-column justify-content-center">
                <div class="container">
                    <!--Signup form-->
                    <div class="row">
                        <div class="col-xl-5 col-lg-7">
                            <div class="card mx-4 border-0">
                                <div class="card-body p-md-6 p-4">
                                    <div class="mb-5 text-center">
                                        <a href="index-2.html"><img src="assets/images/logo/logo.svg" alt="" /></a>
                                    </div>
                                    <div class="mb-3">
                                        <h1 class="fs-4 mb-0">Create an account</h1>
                                    </div>

                                    <!-- form -->
                                    <div class="row g-3">
                                        <!-- First Name -->
                                        <div class="col-md-6 col-12">
                                            <label for="formSignupfname" class="form-label visually-hidden">First Name</label>
                                            <input type="text" name="name" class="form-control" id="formSignupfname"
                                                placeholder="First Name" value="{{ old('name') }}" required />
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="col-12">
                                            <label for="formSignupEmail" class="form-label visually-hidden">Email Address</label>
                                            <input type="email" name="email" class="form-control" id="formSignupEmail"
                                                placeholder="Email" value="{{ old('email') }}" required />
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="col-12">
                                            <div class="password-field position-relative">
                                                <label for="formSignupPassword" class="form-label visually-hidden">Password</label>
                                                <input type="password" name="password" class="form-control fakePassword"
                                                    id="formSignupPassword" placeholder="*****" required />
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="col-12">
                                            <div class="password-field position-relative">
                                                <label for="formSignupPasswordConfirmation" class="form-label visually-hidden">Confirm Password</label>
                                                <input type="password" name="password_confirmation" class="form-control fakePassword"
                                                    id="formSignupPasswordConfirmation" placeholder="*****" required />
                                                @error('password_confirmation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12 d-grid">
                                            <button type="submit" class="btn btn-primary">Register</button>
                                        

                                        </div>

                                        <!-- Sign In Link -->
                                        <div class="col-12">
                                            <p class="mb-2">
                                                I already have an account
                                                <a href="{{ route('login') }}" class="text-link">Sign In</a>
                                            </p>
                                            <p class="mb-0">
                                                <small>
                                                    By continuing, you agree to our
                                                    <a href="#!" class="text-link">Terms of Service</a>
                                                    &amp;
                                                    <a href="#!" class="text-link">Privacy Policy</a>
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

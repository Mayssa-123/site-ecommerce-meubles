@extends('welcome')
@section('section')

				<!--Signin form-->
				<div class="row">
					<div class="col-xl-5 col-lg-7">
						<div class="card  mx-4 border-0">
							<div class="card-body p-md-6 p-4">
								<div class="mb-5 text-center">
									<a href="index-2.html"><img src="assets/images/logo/logo.svg" alt="" /></a>
								</div>
								<div class="mb-3">
									<h1 class="fs-4 mb-0">Welcome back</h1>
								</div>
								<form class="needs-validation" novalidate>
									<div class="row g-3">
										<!-- row -->
										<div class="col-12">
											<!-- input -->
											<label for="formSigninEmail" class="form-label visually-hidden">Email
												address</label>
											<input type="email" class="form-control" id="formSigninEmail"
												placeholder="Email" required />
											<div class="invalid-feedback">Please enter name.</div>
										</div>
										<div class="col-12">
											<!-- input -->
											<div class="password-field position-relative">
												<label for="formSigninPassword"
													class="form-label visually-hidden">Password</label>
												<div class="password-field position-relative">
													<input type="password" class="form-control fakePassword"
														id="formSigninPassword" placeholder="*****" required />
													<span><i class="bi bi-eye-slash passwordToggler"></i></span>
													<div class="invalid-feedback">Please enter password.</div>
												</div>
											</div>
										</div>
										<div class="d-md-flex justify-content-between">
											<!-- form check -->
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value=""
													id="flexCheckDefault" />
												<!-- label -->
												<label class="form-check-label" for="flexCheckDefault">Remember
													me</label>
											</div>
											<div>
												Forgot password?
												<a href="forgot-password.html" class="text-link">Reset It</a>
											</div>
										</div>
										<!-- btn -->
										<div class="col-12 d-grid"><button type="submit" class="btn btn-primary">Sign
												In</button></div>
										<!-- link -->
										<div>
											Don’t have an account?
											<a href="signup.html" class="text-link">Sign Up</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
                @endsection

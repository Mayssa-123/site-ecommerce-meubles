@extends('welcome')
@section('section')
	<!--Forgot start-->
	<div class="vh-100"
		style="background: url(assets/images/jpg/login-bg.jpg) no-repeat; background-position: center; background-size: cover">
		<div class="h-100 d-flex flex-column justify-content-center">
			<div class="container">
				<!--Forgot form-->
				<div class="row">
					<div class="col-lg-5">
						<div class="card  mx-4 border-0">
							<div class="card-body p-md-6 p-4">
								<div class="mb-5 text-center">
									<a href="index-2.html"><img src="assets/images/logo/logo.svg" alt="" /></a>
								</div>
								<div class="mb-3">
									<h1 class="fs-4 mb-0">Forgot password?</h1>
								</div>
								<!-- form -->
								    <form method="POST" action="{{ route('password.email') }}">
										@csrf
									<!-- row -->
									<div class="row g-3">
										<!-- col -->
										<div class="col-12">
											<!-- input -->
											<label for="formForgetEmail" class="form-label visually-hidden">Email
												address</label>
											<input type="email" class="form-control" id="formForgetEmail" name="email"
												placeholder="Email" required />
											<div class="invalid-feedback">Please enter email address.</div>
										</div>

										<!-- btn -->
										<div class="col-12 d-grid gap-2">
											<button type="submit" class="btn btn-primary">Reset Password</button>
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


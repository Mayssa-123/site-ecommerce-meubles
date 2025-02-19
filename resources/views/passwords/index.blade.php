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
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="modal-title fs-3">Change Password</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div>
                        <!-- Formulaire de changement de mot de passe -->
                        <form action="{{ route('update.password') }}" method="POST" class="row needs-validation" novalidate>
                            @csrf
                            <div class="mb-3 col-12">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Enter your current password" required />
                                @if ($errors->has('current_password'))
                                <div class="text-danger">
                                    {{ $errors->first('current_password') }}
                                </div>
                            @endif
                            </div>

                            <div class="mb-3 col-12">
                                <label for="new_password" class="form-label">New Password</label>
                                <div class="password-field position-relative">
                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Create new password" required />
                                    <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                </div>
                                @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-12">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" placeholder="Confirm your new password" required />
                            </div>

                            <!-- Boutons -->
                            <div class="d-flex gap-3 flex-column flex-md-row">
                                <button type="submit" class="btn btn-primary w-100">Save changes</button>
                            </div>
                        </form>
                    </div>

                    <!-- Bouton pour ouvrir le modal -->

                </div>
            </div>
        </div>
    </div>
</section>


@include('layouts-wishlist.footer')

@endsection

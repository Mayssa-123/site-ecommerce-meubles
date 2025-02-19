<div class="collapse d-md-block" id="collapseAccountMenu">
    <div class="mb-3">
      <h3 class="fs-5">My Account</h3>
    </div>
    <ul class="nav flex-column nav-account">
      <li class="nav-item">
        <a class="nav-link " href="{{ route('orders.index') }}">
          <span class="d-flex justify-content-between align-items-center">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-shopping-bag">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <path d="M16 10a4 4 0 0 1-8 0"></path>
              </svg>
              <span class="ms-1">Order</span>
            </span>
            <span class="">

              <span class="badge bg-danger rounded-pill">
                1
              </span>
            </span>
          </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('wishlists.index') }}">

          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-heart">
            <path
              d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
            </path>
          </svg>
          <span class="ms-1">Wishlist</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('passwords.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-lock">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            <span class="ms-1">Update Password</span>
        </a>
    </li>


      <li class="nav-item">
        <div class="nav-link text-light">
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="nav-link" aria-current="page" style="background: none; border: none; padding: 0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-log-out">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span class="ms-1">Log Out</span>
            </button>
        </form>
    </div>
      </li>


    </ul>
  </div>

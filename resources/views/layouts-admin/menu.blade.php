<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets-admin/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">
                <a href="{{ url('/') }}">Rocker</a>
            </h4>

        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>

        </li>

        <li class="menu-label">UI Elements</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">eCommerce</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('products.index') }}"><i class='bx bx-radio-circle'></i>Products</a>
                </li>


                <li> <a href="{{ route('categories.index')}}"><i class='bx bx-radio-circle'></i>Categories</a>
                </li>
                <li> <a href="{{ route('users.index')}}"><i class='bx bx-radio-circle'></i>Users</a>
                </li>
                <li> <a href="{{ route('roles.index')}}"><i class='bx bx-radio-circle'></i>Roles</a>
                </li>
                <li> <a href="{{ route('pictures.index')}}"><i class='bx bx-radio-circle'></i>Pictures-Ban</a>
                </li>
                <li> <a href="{{ route('admincheckouts.index')}}"><i class='bx bx-radio-circle'></i>Commandes</a>
                </li>
                <li> <a href="{{ route('reviews.index')}}"><i class='bx bx-radio-circle'></i>Reviews</a>
                </li>



            </ul>
        </li>








    </ul>
    <!--end navigation-->
</div>

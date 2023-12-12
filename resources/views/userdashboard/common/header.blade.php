<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{route('admin.dashboard')}}"><img
                src="{{ asset('public/images/logo.png') }}" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{route('admin.dashboard')}}"><img
                src="{{ asset('public/images/logo.png') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown mr-0 mr-sm-2">
                <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="https://via.placeholder.com/40x40" alt="profile" />
                    <span class="nav-profile-name">Admin </span>
                </a>
               
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
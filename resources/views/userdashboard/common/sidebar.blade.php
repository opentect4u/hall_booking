<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('Userdash')}}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('bookinghistory')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Booked History</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('cancelhistory')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Cancel list</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('paymenthis')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Payment  history</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('profileupdate')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Profile Update</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('userlogout')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Logout</span>
            </a>
        </li>
    </ul>
</nav>
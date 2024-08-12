<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row topUser_sec">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{route('Userdash')}}"><img
                src="{{ asset('public/user/images/logo.png') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        
            <div class="col-md-6 user_left">
            <b>Name :</b> {{Session::get('user_ftname')}}
          </div>
          <div class="col-md-6 user_right">
          <b>Date:</b>    <?=date('d/m/Y')?>
          </div>
       
    </div>
    
</nav>
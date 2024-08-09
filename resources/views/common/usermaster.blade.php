<!doctype html>
<html lang="en" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WBSCARDB</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('public/user/images/favicon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://www.wbscardb.com/wp-content/themes/WBSCARDB-child/assets_menu/css/style.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/font-awesome.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/apps.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/apps_inner.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/res.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/slick/slick-theme.css') }}">


    <link rel="stylesheet"
        href="https://www.wbscardb.com/wp-content/themes/WBSCARDB-child/assets/mobileMenu/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://www.wbscardb.com/wp-content/themes/WBSCARDB-child/assets/mobileMenu/style.css">
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!--    font-family: 'Roboto', sans-serif;-->

</head>

<body>

    @include('common.header')

    @include('common.navbar')

    @yield('content')

    @include('common.footer')

    <script>
    $("document").ready(function() {
        $(".tab-slider--body").hide();
        $(".tab-slider--body:first").show();
    });

    $(".tab-slider--nav li a").click(function() {
        $(".tab-slider--body").hide();
        var activeTab = $(this).attr("rel");
        $("#" + activeTab).fadeIn();
        if ($(this).attr("rel") == "tab2") {
            $('.tab-slider--tabs').addClass('slide');
        } else {
            $('.tab-slider--tabs').removeClass('slide');
        }
        $(".tab-slider--nav li a").removeClass("active");
        $(this).addClass("active");
    });
    </script>

    <script src="{{ asset('public/user/mobileMenu/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!--<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>-->
    <script src="{{ asset('public/user/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>


    <script src="{{ asset('public/user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/user/js/javascript.js') }}"></script>
    <script src="{{ asset('public/user/js/jquery.js') }}"></script>
    
    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    </script>
    @yield('script')

</body>

</html>
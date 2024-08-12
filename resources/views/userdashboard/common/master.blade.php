<!DOCTYPE html>
<html lang="en" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hall Booking</title>
    <link rel="stylesheet" href="{{ asset('public/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/jquery-toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/font-awesome.css') }}" href="css/font-awesome.css">
    <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <!-- header -->
        @include('userdashboard.common.header')
        <div class="container-fluid page-body-wrapper">
            <!-- sidebar -->
            @include('userdashboard.common.sidebar')

            <div class="main-panel">
                <!-- body -->
                @yield('content')

                <!-- footer -->
                @include('userdashboard.common.footer')
            </div>
        </div>
    </div>
    <script src="{{ asset('public/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('public/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('public/js/data-table.js') }}"></script>

    <!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('public/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('public/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $("select").select2();
    </script>
    @yield('script')

    <script>
    
    @if (session('success'))
    toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
</body>

</html>
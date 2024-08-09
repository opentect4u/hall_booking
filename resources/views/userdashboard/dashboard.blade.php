@extends('userdashboard.common.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card bg-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <h4 class="mt-1 mb-1">welcome to Dashboard </h4>
                    <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('bookinghistory')}}">  
                                <div class="d-flex flex-wrap align-items-baseline">
                                    <h3 class="mr-3">COMPLETED </h3>
                                </div>
                            </a>  
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('cancelhistory')}}">  
                                <div class="d-flex flex-wrap align-items-baseline">
                                <h3 class="mr-3">CANCELLED</h3>
                                </div>  
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('bookinghistory')}}"> 
                            <div class="d-flex flex-wrap align-items-baseline">
                                <h3 class="mr-3">UPCOMING(<?=$row_count?>)</h3>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('guestlist')}}"><div class="d-flex flex-wrap align-items-baseline">
                                <h3 class="mr-3">GUEST</h3>
                            </div></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('paymenthis')}}">  
                            <div class="d-flex flex-wrap align-items-baseline">
                                <h3 class="mr-3">PAID AMOUNT(<?=$paid_amt?>)</h3>
                                <span></span>
                            </div>
                            </a>  
                        </div>
                    </div>
                </div>
    </div>

</div>

@endsection

@section('script')


@endsection
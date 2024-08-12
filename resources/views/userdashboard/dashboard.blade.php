@extends('userdashboard.common.master')
@section('content')
<div class="content-wrapper">
    <!-- <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card bg-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <h4 class="mt-1 mb-1">welcome to Dashboard </h4>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row">
                <div class="col-md-3 grid-margin stretch-card">

                <div class="data_Box">
                 
                <!-- <div class="d-flex flex-wrap align-items-baseline"> -->
                <h3> 
                <a href="{{route('bookinghistory')}}"> 
                Completed <i class="fa fa-check-circle-o success" aria-hidden="true"></i>
            </a>
            <span>150</span>
        </h3>
                <!-- </div> -->
                

                </div>


                    <!-- <div class="card">
                        <div class="card-body">
                            <a href="{{route('bookinghistory')}}">  
                                <div class="d-flex flex-wrap align-items-baseline">
                                    <h3 class="mr-3">COMPLETED </h3>
                                </div>
                            </a>  
                        </div>
                    </div> -->
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                <div class="data_Box">
                <h3>
                <a href="{{route('cancelhistory')}}">  
                Cancelled <i class="fa fa-times-circle cancell" aria-hidden="true"></i> </a>
                <span>250</span>
                </h3>
                
                </div>

                    <!-- <div class="card">
                        <div class="card-body">
                            <a href="{{route('cancelhistory')}}">  
                                <div class="d-flex flex-wrap align-items-baseline">
                                <h3 class="mr-3">CANCELLED</h3>
                                </div>  
                            </a>
                        </div>
                    </div> -->
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    
                <div class="data_Box">
                <h3>
                <a href="{{route('bookinghistory')}}"> 
                    Upcoming  <i class="fa fa-briefcase upcoming" aria-hidden="true"></i>
                </a>
                <span><?=$row_count?></span>
                </h3>
              </div>
                
                
                
                <!-- <div class="card">
                        <div class="card-body">
                            <a href="{{route('bookinghistory')}}"> 
                            <div class="d-flex flex-wrap align-items-baseline">
                                <h3 class="mr-3">UPCOMING(<?=$row_count?>)</h3>
                            </div>
                            </a>
                        </div>
                    </div> -->
                </div>
                <div class="col-md-3 grid-margin stretch-card">

                <div class="data_Box">
                <h3>
                <a href="{{route('guestlist')}}">
                Guest <i class="fa fa-users guest" aria-hidden="true"></i>
                </a>
                <span>320</span>
                </h3>
              </div>


                    <!-- <div class="card">
                        <div class="card-body">
                            <a href="{{route('guestlist')}}"><div class="d-flex flex-wrap align-items-baseline">
                                <h3 class="mr-3">GUEST</h3>
                            </div></a>
                        </div>
                    </div> -->
                </div>
                <div class="col-md-3 grid-margin stretch-card">

                <div class="data_Box">
                <h3>
                <a href="{{route('paymenthis')}}"> 
                Paid Amount <i class="fa fa-money paid" aria-hidden="true"></i>
                </a>
                <span><?=$paid_amt?></span>
                </h3>
              </div>


                    <!-- <div class="card">
                        <div class="card-body">
                            <a href="{{route('paymenthis')}}">  
                            <div class="d-flex flex-wrap align-items-baseline">
                                <h3 class="mr-3">PAID AMOUNT(<?=$paid_amt?>)</h3>
                                <span></span>
                            </div>
                            </a>  
                        </div>
                    </div> -->
                </div>
    </div>

</div>

@endsection

@section('script')


@endsection
@extends('common.master')
@section('content')

<style type="text/css">
    
.container { margin: 50px auto; max-width: 960px; }

    .slider {
        width: 100%;
        margin: 50px auto;
    }

    .slick-slide {
      margin: 0px 20px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    .slick-slide {
      transition: all ease-in-out .3s;
      opacity: .2;
    }
    
    .slick-active {
      opacity: .5;
    }

    .slick-current {
      opacity: 1;
    }
  </style>

<div class="wrapper">
    <div class="col-md-12">
        <ul class="confirmation-step">
            <li><a href="#" class="active"><span>1</span> Hotel Details</a></li>
            <li><a href="#"><span>2</span> Guest Details</a></li>
            <li><a href="#"><span>3</span> Payment</a></li>
            <li><a href="#"><span>4</span> Confirm</a></li>
        </ul>
    </div>
</div>

@if(count($datas) > 0)

<div class="bookingInnerPage">
    <div class="wrapper">
        <div class="col-sm-8 float-left innerContentTxt">
            <div class="card">
                <h3 class="mainTitle">ICMARD Building</h3>
                <address class="addressSec">  6TH Floor,Block-14/2,C.I.T. Scheme-VIII (M), Ultadanga,Kolkata-700 067</address>
                <?php /*?><div class="gallery"> <img src="{{ asset('public/user/images/10-b.jpg') }}" alt=""></div><?php */?>
                
                <div class="gallery center">
                <?php /*?><img src="{{ asset('public/user/images/10-b.jpg') }}" alt=""><?php */?>
<div><img src="{{ asset('public/user/images/hall/hall_1.jpg') }}" alt=""></div>
<div><img src="{{ asset('public/user/images/hall/hall_2.jpg') }}" alt=""></div>
<div><img src="{{ asset('public/user/images/hall/hall_3.jpg') }}" alt=""></div>
<div><img src="{{ asset('public/user/images/hall/hall_4.jpg') }}" alt=""></div>
<div><img src="{{ asset('public/user/images/hall/hall_5.jpg') }}" alt=""></div>
<div><img src="{{ asset('public/user/images/hall/hall_6.jpg') }}" alt=""></div>
<div><img src="{{ asset('public/user/images/hall/hall_7.jpg') }}" alt=""></div>
<div><img src="{{ asset('public/user/images/hall/hall_8.jpg') }}" alt=""></div>
<div><img src="{{ asset('public/user/images/hall/hall_9.jpg') }}" alt=""></div>
<div><img src="{{ asset('public/user/images/hall/hall_10.jpg') }}" alt=""></div>
<div><img src="{{ asset('public/user/images/hall/hall_11.jpg') }}" alt=""></div>
<div><img src="{{ asset('public/user/images/hall/hall_12.jpg') }}" alt=""></div>
<div><img src="{{ asset('public/user/images/hall/hall_13.jpg') }}" alt=""></div>
<div><img src="{{ asset('public/user/images/hall/hall_14.jpg') }}" alt=""></div>

                </div>
                
            </div>
        </div>

        <div class="col-sm-4 float-left rightBookingPag">
            <div class="card">
                <div class="priceSec">
                    <h3>₹ <?php 
                        $normal_rate =isset($room_rent[0]->normal_rate)?$room_rent[0]->normal_rate:0;
                        $cgst_rate_percent =isset($room_rent[0]->cgst_rate)?$room_rent[0]->cgst_rate:0;
                        $sgst_rate_percent =isset($room_rent[0]->sgst_rate)?$room_rent[0]->sgst_rate:0;
                        $cgst_rate= ($normal_rate * $cgst_rate_percent)/100 ;
                        $sgst_rate= ($normal_rate * $sgst_rate_percent)/100 ;
                        echo $tot_amt= $normal_rate + $cgst_rate + $sgst_rate;
                    ?> </h3>
                    <span class="text-muted"><i class="fa fa-bed" aria-hidden="true"></i> {{$room_type}}</span>
                </div>
                <div class="checkMain">
                    <div class="">Dates : <?php 
                    for ($i=0; $i < count($searched->hallbookingdate); $i++) { 
                        echo $searched->hallbookingdate[$i];
                        if ($i != (count($searched->hallbookingdate)-1)) {
                            echo ", ";
                        }
                    }
                    ?></div>
                    <!-- <div class="checkIn">Dates : {{$searched->checkInDate}}</div> -->
                    <!-- <div class="checkOut">Check Out<br>
                    {{$searched->checkOutDate}}</div> -->
                </div>
                <div class="descrip">
                    <div class="descripLeft">
                        <!-- <p>1 Adult</p> -->

                        <p>1 Hall x {{count($searched->hallbookingdate)}} Days </p>
                    </div>
                    <div class="descripRight">
                        <p class="bigTxtBold_16">₹ {{$tot_amt * 1 * $interval}}</p>
                    </div>
                </div>

                <div class="total">
                    <span class="title">Total </span>
                    <span class="value"> ₹ {{$tot_amt * 1 * $interval}}</span>
                </div>

                @if(count($datas) >= 1)
                <div class="bookNowBtn">
                    <!-- <form method="post" action="{{route('hallGuestDetails')}}"> -->
                        @csrf
                        <input type="text" hidden name="location_id" id="location_id" value="{{$searched->hall_location_id}}">
                        <input type="text" hidden name="room_type_id" id="room_type_id" value="{{$searched->hall_room_type_id}}">
                        <input type="text" hidden name="hall_no_id" id="hall_no_id" value="{{$searched->hall_no}}">
                        <input type="text" hidden name="hallbookingdate" id="hallbookingdate" value="{{json_encode($searched->hallbookingdate)}}">
                        <input type="text" hidden name="days" id="days" value="{{$searched->days}}">
                        <!-- <button type="submit" class="btn btn-primary">Book Now</button> -->
                    </form>
                    <!-- <button type="button">Book Now</button> -->
                </div>
                @else
                <div class="bookNowBtn">
                    <p>{{$searched->rooms}} Room not available</p>
                    <!-- <button type="button" disabled>Book Now</button> -->
                </div>
                @endif
            </div>
        </div>

        <div class="col-sm-12 float-left innerContentTxt">
            <div class="card tabContent">

                <div class="tab-slider--nav">
                    <ul class="tab-slider--tabs">
                        <li class="tab-slider--trigger"><a href="javascript:void(0)" rel="tabRoom" class="active">Room &
                                Rates</a>
                        </li>
                        <!-- <li class="tab-slider--trigger"><a href="javascript:void(0)" rel="tabLoca">Location</a></li>
                        <li class="tab-slider--trigger"><a href="javascript:void(0)" rel="tabDescrip">Description</a> -->
                        </li>
                    </ul>
                </div>
                <div class="tab-slider--container">
                    <div id="tabRoom" class="tab-slider--body">
                    Please visit <a href="https://www.wbscardb.com/" target="_blank">https://www.wbscardb.com/</a>  for details. Hall booking facilities is not available in online mode. 
                    </div>
                    <div id="tabLoca" class="tab-slider--body">
                        vvvvvvvvvvvvvvvvvvv
                    </div>
                    <div id="tabDescrip" class="tab-slider--body">
                        vvvvvvvvvvvvvvvvvvv
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@else
<div class="bookingInnerPage">
    <div class="wrapper">
        <div class="col-sm-12 float-left innerContentTxt">
            <div class="card">
                <h3 class="mainTitle">No Hall available here!!</h3>
                <b><a href="{{route('index')}}">Back to home</a></b>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('script')

@endsection
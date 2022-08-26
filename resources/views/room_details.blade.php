@extends('common.master')
@section('content')


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
                <h3 class="mainTitle">Fortune Park Panchwati</h3>
                <address class="addressSec">Kona Expressway Howrah-Kolkata,West Bengal 711403 KOLKATA</address>
                <div class="gallery"><img src="{{ asset('public/user/images/10-b.jpg') }}" alt=""></div>
            </div>
        </div>

        <div class="col-sm-4 float-left rightBookingPag">
            <div class="card">
                <div class="priceSec">
                    <h3>₹ <?php 
                        $normal_rate = isset($room_rent[0]->normal_rate)?$room_rent[0]->normal_rate:0;
                        $cgst_rate_percent =isset($room_rent[0]->cgst_rate)?$room_rent[0]->cgst_rate:0;
                        $sgst_rate_percent =isset($room_rent[0]->sgst_rate)?$room_rent[0]->sgst_rate:0;
                        $cgst_rate= ($normal_rate * $cgst_rate_percent)/100 ;
                        $sgst_rate= ($normal_rate * $sgst_rate_percent)/100 ;
                        echo $tot_amt= $normal_rate + $cgst_rate + $sgst_rate;
                    ?> </h3>
                    <span class="text-muted"><i class="fa fa-bed" aria-hidden="true"></i> {{$room_type}}</span>
                </div>
                <div class="checkMain">
                    <div class="checkIn">Check In<br>
                        {{$searched->checkInDate}}</div>
                    <div class="checkOut">Check Out<br>
                        {{$searched->checkOutDate}}</div>
                </div>
                <div class="descrip">
                    <div class="descripLeft">
                        <?php 
                            $totadult=0;
                            $totchild=0;
                            for($i=1; $i<=$searched->rooms ; $i++){ 
                                $adult="adults_room".$i;
                                $child1_room="child1_room".$i;
                                $child2_room="child2_room".$i;
                                $totadult +=$searched->$adult;
                                if ($searched->$child1_room > 0) {
                                    $totchild += 1;
                                }
                                if ($searched->$child2_room > 0) {
                                    $totchild += 1;
                                }
                            }
                            if ($totchild > 0) {
                                $totdata=$totadult." Adults, ".$totchild." Childs" ;
                            } else {
                                $totdata=$totadult." Adults" ;
                            }
                        ?>
                        <p>{{$totdata}}</p>

                        <p>{{$searched->rooms}} Room x {{$interval}} Nights </p>
                    </div>
                    <div class="descripRight">
                        <p class="bigTxtBold_16">₹ {{$tot_amt * $searched->rooms * $interval}}</p>
                    </div>
                </div>

                <div class="total">
                    <span class="title">Total </span>
                    <span class="value"> ₹ {{$tot_amt * $searched->rooms * $interval}}</span>
                </div>

                @if(count($datas) >= $searched->rooms)
                <div class="bookNowBtn">
                    <form method="post" action="{{route('guestDetails')}}">
                        @csrf
                        <input type="text" hidden name="location_id" id="location_id"
                            value="{{$searched->location_id}}">
                        <input type="text" hidden name="room_type_id" id="room_type_id"
                            value="{{$searched->room_type_id}}">
                        <input type="text" hidden name="checkInDate" id="checkInDate"
                            value="{{$searched->checkInDate}}">
                        <input type="text" hidden name="checkOutDate" id="checkOutDate"
                            value="{{$searched->checkOutDate}}">
                        <input type="text" hidden name="max_person_number" id="max_person_number"
                            value="{{$searched->max_person_number}}">
                        <input type="text" hidden name="max_child_number" id="max_child_number"
                            value="{{$searched->max_child_number}}">
                        <input type="text" hidden name="rooms" id="rooms" value="{{$searched->rooms}}">
                        @for($i=1; $i<=$searched->rooms ; $i++)
                            <?php  
                        $adult="adults_room".$i;
                        $child1_room="child1_room".$i;
                        $child2_room="child2_room".$i;
                        ?>
                            <input type="text" hidden name="adults_room{{$i}}" id="adults_room{{$i}}"
                                value="{{$searched->$adult}}">
                            <input type="text" hidden name="child1_room{{$i}}" id="child1_room{{$i}}"
                                value="{{$searched->$child1_room}}">
                            <input type="text" hidden name="child2_room{{$i}}" id="child2_room{{$i}}"
                                value="{{$searched->$child2_room}}">
                            @endfor
                            <button type="submit" class="btn btn-primary">Book Now</button>
                    </form>
                </div>
                @else
                <div class="bookNowBtn">
                    @if($searched->rooms>1)
                    <p>{{$searched->rooms}} Room not available</p>
                    @else
                    <p> Room not available</p>
                    @endif
                    <button type="button" disabled>Book Now</button>
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
                        <li class="tab-slider--trigger"><a href="javascript:void(0)" rel="tabLoca">Location</a></li>
                        <li class="tab-slider--trigger"><a href="javascript:void(0)" rel="tabDescrip">Description</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-slider--container">
                    <div id="tabRoom" class="tab-slider--body">
                        xxxxxxxxxxxxxxxxx
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
                <h3 class="mainTitle">No Room available here!!</h3>
                <b><a href="{{route('index')}}">Back to home</a></b>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('script')

@endsection
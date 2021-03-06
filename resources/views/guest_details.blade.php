@extends('common.master')
@section('content')

<div class="wrapper">
    <div class="col-md-12">
        <ul class="confirmation-step">
            <li><a href="#" class="active"><span>1</span> Hotel Details</a></li>
            <li><a href="#" class="active"><span>2</span> Guest Details</a></li>
            <li><a href="#"><span>3</span> Payment</a></li>
            <li><a href="#"><span>4</span> Confirm</a></li>
        </ul>
    </div>
</div>



<div class="bookingInnerPage">
    <div class="wrapper">
        <div class="col-sm-8 float-left innerContentTxt">
            <div class="card">
                <div class="proDetails">
                    <div class="proDetailsThumSub"
                        style="background:url('{{asset('public/user/images/01-b.jpg')}}') no-repeat center center;background-size:cover;">
                        &nbsp;</div>
                    <div class="proDetailsTxt">
                        <h3>Taj Bengal, Kolkata</h3>
                        <p>34 B Belvedere Road Alipore Kolkata, West Bengal 700 027</p>
                        <h4>Facilities</h4>
                        <ul>
                            <li>Gift shops or newsstand</li>
                            <li>Dry cleaning/laundry service</li>
                        </ul>

                    </div>
                </div>

                <div class="card-body border rounded set mb-3">
                    <div class="passanger-details">
                        <form action="{{route('payment')}}" method="post">
                            @csrf
                            <input type="text" hidden name="location_id" id="location_id" value="{{$searched->location_id}}">
                            <input type="text" hidden name="room_type_id" id="room_type_id" value="{{$searched->room_type_id}}">
                            <input type="text" hidden name="checkInDate" id="checkInDate" value="{{$searched->checkInDate}}">
                            <input type="text" hidden name="checkOutDate" id="checkOutDate" value="{{$searched->checkOutDate}}">
                            <input type="text" hidden name="max_person_number" id="max_person_number" value="{{$searched->max_person_number}}">
                            <input type="text" hidden name="max_child_number" id="max_child_number" value="{{$searched->max_child_number}}">
                            <input type="text" hidden name="rooms" id="rooms" value="{{$searched->rooms}}">
                            @for($i=1; $i<=$searched->rooms ; $i++)
                            <?php  
                            $adult="adults_room".$i;
                            $child1_room="child1_room".$i;
                            $child2_room="child2_room".$i;
                            ?>
                            <input type="text" hidden name="adults_room{{$i}}" id="adults_room{{$i}}" value="{{$searched->$adult}}">
                            <input type="text" hidden name="child1_room{{$i}}" id="child1_room{{$i}}" value="{{$searched->$child1_room}}">
                            <input type="text" hidden name="child2_room{{$i}}" id="child2_room{{$i}}" value="{{$searched->$child2_room}}">
                            @endfor

                            @for($i=1; $i<=$searched->rooms ; $i++)
                                <div class="card-body border rounded set mb-3">
                                    <h6 class="font-weight-500 mb-3 bg-primary-light p-2"> Room {{$i}}</h6>
                                    <?php 
                            $adults="adults_room".$i; 
                            $child1_room="child1_room".$i;
                            $child2_room="child2_room".$i;
                            $childcount=1;
                            ?>
                                    @for($j=1; $j<=$searched->$adults ; $j++)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Adult ({{$j}})- first name</label>
                                                    <input type="text" required=""
                                                        name="room{{$i}}_adult{{$j}}_first_name" class="form-control"
                                                        placeholder="Enter first name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" required=""
                                                        name="room{{$i}}_adult{{$j}}_last_name" class="form-control"
                                                        placeholder="Enter last name">
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                        @if($searched->$child1_room)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Child ({{$childcount}})- first name</label>
                                                    <input type="text" required="" name="room{{$i}}_child1_first_name"
                                                        class="form-control" placeholder="Enter first name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" required="" name="room{{$i}}_child1_last_name"
                                                        class="form-control" placeholder="Enter last name">
                                                </div>
                                            </div>
                                        </div>
                                        <?php $childcount++ ;?>
                                        @endif
                                        @if($searched->$child2_room)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Child ({{$childcount}})- first name</label>
                                                    <input type="text" required="" name="room{{$i}}_child2_first_name"
                                                        class="form-control" placeholder="Enter first name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" required="" name="room{{$i}}_child2_last_name"
                                                        class="form-control" placeholder="Enter last name">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                </div>
                                @endfor


                                <div class="card-body border rounded set mb-3">
                                    <h6 class="font-weight-500 mb-3 bg-primary-light p-2"> Billing Details</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Post code</label>
                                                <input type="text" required="" name="post_code" class="form-control"
                                                    placeholder="Enter post code">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select name="state" id="state" required="" class="form-control">
                                                    <option value=""> -- Select State -- </option>
                                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                    <option value="Assam">Assam</option>
                                                    <option value="Bihar">Bihar</option>
                                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                                    <option value="Goa">Goa</option>
                                                    <option value="Gujarat">Gujarat</option>
                                                    <option value="Haryana">Haryana</option>
                                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                    <option value="Jharkhand">Jharkhand</option>
                                                    <option value="Karnataka">Karnataka</option>
                                                    <option value="Kerala">Kerala</option>
                                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                    <option value="Manipur">Manipur</option>
                                                    <option value="Meghalaya">Meghalaya</option>
                                                    <option value="Mizoram">Mizoram</option>
                                                    <option value="Nagaland">Nagaland</option>
                                                    <option value="Odisha">Odisha</option>
                                                    <option value="Punjab">Punjab</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                    <option value="Sikkim">Sikkim</option>
                                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                                    <option value="Telangana">Telangana</option>
                                                    <option value="Tripura">Tripura</option>
                                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                    <option value="Uttarakhand">Uttarakhand</option>
                                                    <option value="West Bengal">West Bengal</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" id="address" cols="" rows="2" class="form-control"
                                                    placeholder="Enter Address"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact No</label>
                                                <input type="number" required="" name="contact_no" class="form-control"
                                                    placeholder="Enter your contact no" max="9999999999"
                                                    oninvalid="this.setCustomValidity('Mobile no up to 10 digit')"
                                                    oninput="this.setCustomValidity('')">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email id</label>
                                                <input type="email" required="" name="email" class="form-control"
                                                    placeholder="Enter your email">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Confirm Booking</button>

                        </form>
                    </div>
                </div>


            </div>
        </div>

        <div class="col-sm-4 float-left rightBookingPag">
            <div class="card">
                <h4 class="title">Fare Summary</h4>
                <div class="checkMain">
                    <div class="checkIn">Check In<br>{{$searched->checkInDate}}</div>
                    <div class="checkOut">Check Out<br>{{$searched->checkOutDate}}</div>
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
                        <p>in {{$searched->rooms}} Room for {{$interval}} Nights </p>
                    </div>
                    <!--<div class="descripRight"> <p class="bigTxtBold_16">?? 833.27</p></div>-->
                </div>

                <div class="descrip2">
                    <?php 
                        $normal_rate =$room_rent[0]->normal_rate;
                        $total_room_charage=$normal_rate * $searched->rooms * $interval;
                        $cgst_rate_percent =$room_rent[0]->cgst_rate;
                        $sgst_rate_percent =$room_rent[0]->sgst_rate;
                        $cgst_rate= ($total_room_charage * $cgst_rate_percent)/100 ;
                        $sgst_rate= ($total_room_charage * $sgst_rate_percent)/100 ;
                        $tot_amt= ($total_room_charage + $cgst_rate + $sgst_rate) ;
                    ?> 
                    <p>Per Room Charges X Per Night<span class="floatRight">??? {{$normal_rate}} </span></p>
                    <p>Total Room Charges <span class="floatRight">??? {{$total_room_charage}} </span></p>
                    <p>CGST on Room Charges ({{$cgst_rate_percent}}%)<span class="floatRight"> ??? {{$cgst_rate}}</span></p>
                    <p>SGST on Room Charges ({{$sgst_rate_percent}}%)<span class="floatRight"> ??? {{$sgst_rate}}</span></p>
                    <!-- <p>Room Charges (GST Extra) <span class="floatRight"> ??? 0.00</span></p> -->
                    <!-- <p>Room Charges (GST Extra) <span class="floatRight"> ??? 0.00</span></p> -->
                </div>

                <div class="total">
                    <span class="title">Total </span>
                    <span class="value"> ??? {{$tot_amt}} </span>
                </div>

                <!-- <div class="bookNowBtn"><button type="button">Book Now</button></div> -->

            </div>
        </div>



    </div>
</div>


@endsection

@section('script')

@endsection
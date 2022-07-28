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
                        <form action="{{route('hallpayment')}}" method="post">
                            @csrf
                            <input type="text" hidden name="location_id" id="location_id"
                                value="{{$searched->location_id}}">
                            <input type="text" hidden name="room_type_id" id="room_type_id"
                                value="{{$searched->room_type_id}}">
                            <input type="text" hidden name="hall_no_id" id="hall_no_id"
                                value="{{$searched->hall_no_id}}">
                            <input type="text" hidden name="hallbookingdate" id="hallbookingdate"
                                value="{{$searched->hallbookingdate}}">
                            <input type="text" hidden name="days" id="days" value="{{$searched->days}}">

                            <div class="card-body border rounded set mb-3">
                                <h6 class="font-weight-500 mb-3 bg-primary-light p-2"> Other Services </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" name="laptop_prajector" id="laptop_prajector"
                                                    value="Y" class="form-check">Laptop & Projector
                                            </label>
                                            <!-- <input type="text" required="" name="room_adult_first_name"
                                                class="form-control" placeholder="Enter first name"> -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" name="sound_system" id="sound_system" value="Y"
                                                    class="form-check">Sound System

                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" name="catering_service" id="catering_service"
                                                    value="Y" class="form-check">Catering Service

                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-check" type="radio" id="individual"
                                                name="customer_type_flag" value="I" checked>
                                            <label for="individual ">Individual</label>
                                            <input class="form-check" type="radio" id="organisation"
                                                name="customer_type_flag" value="O">
                                            <label for="organisation ">Organisation </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border rounded set mb-3">
                                <h6 class="font-weight-500 mb-3 bg-primary-light p-2"> Room </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First name</label>
                                            <input type="text" required="" name="room_adult_first_name"
                                                class="form-control" placeholder="Enter first name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" required="" name="room_adult_last_name"
                                                class="form-control" placeholder="Enter last name">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card-body border rounded set mb-3">
                                <h6 class="font-weight-500 mb-3 bg-primary-light p-2"> Billing Details</h6>
                                <div class="row" id="organisationDiv">
                                    <!-- GSTIN,PAN,TAN,Registration No. -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>GSTIN</label>
                                            <input type="text" name="GSTIN" class="form-control"
                                                placeholder="Enter GSTIN">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>PAN</label>
                                            <input type="text" name="PAN" class="form-control" placeholder="Enter PAN">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>TAN</label>
                                            <input type="text" name="TAN" class="form-control" placeholder="Enter TAN">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Registration No.</label>
                                            <input type="text" name="RegistrationNo" class="form-control"
                                                placeholder="Enter Registration No.">
                                        </div>
                                    </div>
                                </div>

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
                    <div class="">Days : <?php 
                    $searched->hallbookingdate=json_decode($searched->hallbookingdate);
                    for ($i=0; $i < count($searched->hallbookingdate); $i++) { 
                        echo $searched->hallbookingdate[$i];
                        if ($i != (count($searched->hallbookingdate)-1)) {
                            echo ", ";
                        }
                    }
                    ?></div>
                    <!-- <div class="checkIn">Check In<br>{{$searched->checkInDate}}</div>
                    <div class="checkOut">Check Out<br>{{$searched->checkOutDate}}</div> -->
                </div>
                <div class="descrip">
                    <div class="descripLeft">
                        <!-- <p>0 Adults</p> -->
                        <p>in 1 Hall for {{$interval}} Days </p>
                    </div>
                    <!--<div class="descripRight"> <p class="bigTxtBold_16">£ 833.27</p></div>-->
                </div>

                <div class="descrip2">
                    <?php 
                        $normal_rate =$room_rent[0]->normal_rate;
                        $total_room_charage=$normal_rate * 1 * $interval;
                        $cgst_rate_percent =$room_rent[0]->cgst_rate;
                        $sgst_rate_percent =$room_rent[0]->sgst_rate;
                        $cgst_rate= ($total_room_charage * $cgst_rate_percent)/100 ;
                        $sgst_rate= ($total_room_charage * $sgst_rate_percent)/100 ;
                        $tot_amt= ($total_room_charage + $cgst_rate + $sgst_rate) ;
                    ?>
                    <p>Per Hall Charges X Per Night<span class="floatRight">₹ {{$normal_rate}} </span></p>
                    <p>Total Hall Charges <span class="floatRight">₹ {{$total_room_charage}} </span></p>
                    <p>CGST on Hall Charges ({{$cgst_rate_percent}}%)<span class="floatRight"> ₹ {{$cgst_rate}}</span>
                    </p>
                    <p>SGST on Hall Charges ({{$sgst_rate_percent}}%)<span class="floatRight"> ₹ {{$sgst_rate}}</span>
                    </p>
                    <!-- <p>Room Charges (GST Extra) <span class="floatRight"> ₹ 0.00</span></p> -->
                    <!-- <p>Room Charges (GST Extra) <span class="floatRight"> ₹ 0.00</span></p> -->
                </div>

                <div class="total">
                    <span class="title">Total </span>
                    <span class="value"> ₹ {{$tot_amt}} </span>
                </div>

                <!-- <div class="bookNowBtn"><button type="button">Book Now</button></div> -->

            </div>
        </div>



    </div>
</div>


@endsection

@section('script')


<script type='text/javascript'>
jQuery(document).ready(function() {
    $('#organisationDiv').hide();
    $('input:radio[name="customer_type_flag"]').change(function() {
        if ($(this).val() == 'I') {
            $('#organisationDiv').hide();
        } else {
            $('#organisationDiv').show();
        }
    });

});
</script>
@endsection
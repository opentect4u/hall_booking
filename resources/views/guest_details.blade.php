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
                        <h3>ICMARD Building</h3>
                        <p>6TH Floor,Block-14/2,C.I.T. Scheme-VIII (M), Ultadanga,Kolkata-700 067</p>
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

                                <div class="card-body border rounded set mb-3">
                                    <h6 class="font-weight-500 mb-3 bg-primary-light p-2"> Other Services </h6>
                                    <div class="row">
                                        <!-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    <input type="checkbox" name="catering_service" id="catering_service"
                                                        value="Y" class="form-check">Catering Service
                                                </label>
                                            </div>
                                        </div> -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input class="form-check" type="radio" id="individual"
                                                    name="customer_type_flag" value="I" checked>
                                                <label for="individual ">Individual</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                
                                                <input class="form-check" type="radio" id="organisation"
                                                    name="customer_type_flag" value="O">
                                                <label for="organisation ">Organisation </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body border rounded set mb-3" id="menuListDiv">
                                    <h6 class="font-weight-500 mb-3 bg-primary-light p-2"> Menu List
                                        <?php if($interval_menuselect <= $menuselect_day){echo " (You can not select menu)";}?>
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Item Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Price</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>GST</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Total Price</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>No of Head</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="height: 250px;overflow: auto;">

                                        @foreach($menus as $menu)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    <input type="checkbox" name="menus[]" id="menus_{{$menu->id}}"
                                                        value="{{$menu->id}}" class="form-check menuCheckInp"
                                                        <?php if($interval_menuselect <= $menuselect_day){echo "disabled";}?>>{{$menu->item_name}}

                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>{{number_format((float)$menu->price, 2, '.', '')}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>{{number_format((float)(($menu->price*$food_cgst_charge)/100)+(($menu->price*$food_sgst_charge)/100), 2, '.', '')}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>{{number_format((float)(($menu->price*$food_cgst_charge)/100)+(($menu->price*$food_sgst_charge)/100)+$menu->price, 2, '.', '')}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <!-- <label>Last Name</label> -->
                                                <input type="text" name="no_of_head[]" id="no_of_head_{{$menu->id}}"
                                                    class="form-control noOfHeadInp"
                                                    <?php if($interval_menuselect <= $menuselect_day){echo "disabled";}?>>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
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
                                                        <label>Adult ({{$j}})- first name <span>*</span></label>
                                                        <input type="text" required=""
                                                            name="room{{$i}}_adult{{$j}}_first_name"
                                                            class="form-control" placeholder="Enter first name">
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
                                                        <input type="text" required=""
                                                            name="room{{$i}}_child1_first_name" class="form-control"
                                                            placeholder="Enter first name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" required=""
                                                            name="room{{$i}}_child1_last_name" class="form-control"
                                                            placeholder="Enter last name">
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
                                                        <input type="text" required=""
                                                            name="room{{$i}}_child2_first_name" class="form-control"
                                                            placeholder="Enter first name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" required=""
                                                            name="room{{$i}}_child2_last_name" class="form-control"
                                                            placeholder="Enter last name">
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                    </div>
                                    @endfor


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
                                                    <input type="text" name="PAN" class="form-control"
                                                        placeholder="Enter PAN">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>TAN</label>
                                                    <input type="text" name="TAN" class="form-control"
                                                        placeholder="Enter TAN">
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
                                                    <label>Post code <span>*</span></label>
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
                                                    <textarea name="address" id="address" cols="" rows="2"
                                                        class="form-control" placeholder="Enter Address"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Contact No <span>*</span></label>
                                                    <input type="number" required="" name="contact_no"
                                                        class="form-control" placeholder="Enter your contact no"
                                                        max="9999999999"
                                                        oninvalid="this.setCustomValidity('Mobile no up to 10 digit')"
                                                        oninput="this.setCustomValidity('')">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email id <span>*</span></label>
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
                    <!--<div class="descripRight"> <p class="bigTxtBold_16">£ 833.27</p></div>-->
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
                    <p>Per Room Charges X Per Night<span class="floatRight">₹ {{$normal_rate}} </span></p>
                    <p>Total Room Charges <span class="floatRight">₹ {{$total_room_charage}} </span></p>
                    <p>CGST on Room Charges ({{$cgst_rate_percent}}%)<span class="floatRight"> ₹ {{$cgst_rate}}</span>
                    </p>
                    <p>SGST on Room Charges ({{$sgst_rate_percent}}%)<span class="floatRight"> ₹ {{$sgst_rate}}</span>
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
    // var val = $("#catering_service").is(':checked').val();

    if ($("#catering_service").is(':checked')) {
        $('#organisationDiv').show();
    } else {
        $('#organisationDiv').hide();
    }
    $('input:radio[name="customer_type_flag"]').change(function() {
        if ($(this).val() == 'I') {
            $('#organisationDiv').hide();
        } else {
            $('#organisationDiv').show();
        }
    });

    // menuListDiv
    $('#menuListDiv').hide();
    $("#catering_service").on('change', function() {
        if ($("#catering_service").is(':checked')) {
            // alert("checked");
            $('#menuListDiv').show();
        } else {
            // $('#menus_1').removeAttr('checked');
            // $("#menus_1")[0].checked = false;
            // $('#menus_1').prop('checked', false);
            $('input[name="menus[]"]').prop('checked', false);
            $('input[name="no_of_head[]"]').val('');
            // menuCheckInp
            $('#menuListDiv').hide();
            // alert("unchecked");
        }
    });

    var countmenus = '<?php echo count($menus);?>';
    // alert(countmenus)
    for (let index = 1; index <= countmenus; index++) {
        $("#menus_" + index).on('change', function() {
            if ($("#menus_" + index).is(':checked')) {
                // alert(index + " Yes")
                $("#no_of_head_" + index).attr('required', 'required');
            } else {
                // alert(index + " no")
                $("#no_of_head_" + index).removeAttr('required', 'required');
            }
        });
    }
});
</script>
@endsection
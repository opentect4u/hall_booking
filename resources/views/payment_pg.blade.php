@extends('common.master')
@section('content')


<div class="wrapper">
    <div class="col-md-12">
        <ul class="confirmation-step">
            <li><a href="#" class="active"><span>1</span> Hotel Details</a></li>
            <li><a href="#" class="active"><span>2</span> Guest Details</a></li>
            <li><a href="#" class="active"><span>3</span> Payment</a></li>
            <li><a href="#"><span>4</span> Confirm</a></li>
        </ul>
    </div>
</div>

<?php 
   
?>
<div class="bookingInnerPage">
    <div class="wrapper">
        <div class="col-sm-8 float-left innerContentTxt">
            <div class="card">
                <h4 class="title222">Payment Details</h4>
                <hr>

                <div class="card-body border rounded set mb-3">
                    <div id="accordion" class="w-100 passanger-details">
                        <div class="card-body border rounded set mb-3">
                            <div class="card-header bg-primary-light font-weight-500 h6 border-0" id="headingOne">
                               Booking Detail
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group">
                                        <label>Guest Name</label>
                                        <input type="text" maxlength="4" class="form-control" readonly
                                            placeholder="" name="" value="{{$guest_details[0]->first_name}} {{$guest_details[0]->middle_name}} {{$guest_details[0]->last_name}} {{$guest_details[0]->organisation_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile No</label>
                                        <input type="text" maxlength="4" class="form-control" readonly
                                            placeholder="" name="" value="{{$booking_details[0]->mobileno}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email"  class="form-control" readonly
                                            placeholder="" name="" value="{{$booking_details[0]->emailid}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                            <form method="post" name="redirect" action="<?=$test_url?>"> 
                            @csrf
                                <?php
                                echo "<input type=hidden name=encRequest value=$encrypted_data>";
                                echo "<input type=hidden name=access_code value=$access_code>";
                                ?>
                                    <div id="collapse1" class="mt-2 collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordion" style="">                                        
                                        
                                        <button type="submit" class="btn" id="PayBtn" >Pay With HDFC BANK ₹
                                            {{$tot_amt }}</button>
                                    </div>
                            <!-- </form> -->
                          </div>
                          <div class="col-md-6">
                          <form id="Formdata" method='POST' action='<?=$billdesk_url?>'>
                          @csrf
                            <input type='hidden' name='msg' id='msg' value="<?php echo ( $msg ); ?>">
                            <div id="collapse1" class="mt-2 collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordion" style=""> 
                            <button type="submit" value="submit" class="btn btn-warning" >Pay With Bill Desk ₹
                                            {{$tot_amt }}</button>
                                            </div>
                            </form>
                         </div> 
                             </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4 float-left rightBookingPag">
            <div class="card">
                <h4 class="title">Fare Summary</h4>
                <div class="checkMain">
                    <div class="checkIn">Check In<br>{{date('d-m-Y',strtotime($booking_details[0]->from_date))}}</div>
                    <div class="checkOut">Check Out<br>{{date('d-m-Y',strtotime($booking_details[0]->to_date))}}</div>
                </div>
                <div class="descrip">
                  
                </div>

                <div class="descrip2">
                    <?php 
                    
                    $total_room_charage=$booking_details[0]->amount;
                    $cgst_rate_percent =$booking_details[0]->total_cgst_amount;
                    $sgst_rate_percent =$booking_details[0]->total_sgst_amount;
                    $cgst_rate= ($total_room_charage * $cgst_rate_percent)/100 ;
                    $sgst_rate= ($total_room_charage * $sgst_rate_percent)/100 ;
                    
                    
                    
                    
                    ?>

                    <!-- <p>Per Room Charges X Per Night<span class="floatRight">₹  </span></p> -->
                    <p>Total Room Charges <span class="floatRight">₹  {{$booking_details[0]->amount}}</span></p>
                    <p>CGST on Room Charges <span class="floatRight"> ₹ {{$cgst_rate}}</span></p>
                    <p>SGST on Room Charges <span class="floatRight"> ₹ {{$sgst_rate}}</span></p>
                    <p>Convenience Charges <span class="floatRight">₹ {{$pg_charge}}</span></p>
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


<script>
$(document).ready(function() {

    $('#credit_or_debit [name=payment]').on('change', function() {
        // alert($('input[name=payment]:checked', '#credit_or_debit').val());
        var amt = $('input[name=payment]:checked', '#credit_or_debit').val();
        tot_deatils = "Pay ₹ " + amt;
        $("#PayBtn").empty()
        $("#PayBtn").append(tot_deatils)
    });
});
</script>
@endsection
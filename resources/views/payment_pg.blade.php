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
                                <a href="javascript:void(0)" data-toggle="collapse" data-target="#collapse1"
                                    aria-expanded="false" aria-controls="collapseOne">
                                    Credit or Debit Card
                                </a>
                            </div>
                            
                            <form method="post" name="redirect" action="<?=$test_url?>"> 
                            @csrf
                                <?php
                                echo "<input type=hidden name=encRequest value=$encrypted_data>";
                                echo "<input type=hidden name=access_code value=$access_code>";
                                ?>
                                    <div id="collapse1" class="mt-2 collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordion" style="">                                        
                                        
                                        <button type="submit" class="btn btn-primary" id="PayBtn">Pay ₹
                                            {{$tot_amt }}</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4 float-left rightBookingPag">
            <div class="card">
                <h4 class="title">Fare Summary</h4>
                <div class="checkMain">
                    <div class="checkIn">Check In<br></div>
                    <div class="checkOut">Check Out<br></div>
                </div>
                <div class="descrip">
                  
                </div>

                <div class="descrip2">

                    <p>Per Room Charges X Per Night<span class="floatRight">₹  </span></p>
                    <p>Total Room Charges <span class="floatRight">₹  </span></p>
                    <p>CGST on Room Charges <span class="floatRight"> ₹</span>
                    </p>
                    <p>SGST on Room Charges <span class="floatRight"> ₹ </span>
                    </p>
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
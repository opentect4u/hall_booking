<!-- <div class="form-group "> -->
<div class="form-group row">

    <div class="col-sm-12">
        <label>Check In : {{$from_date}} | Check Out : {{$to_date}}</label>
    </div>
    <!-- <div class="col-sm-6">
    <label>Check Out : {{$to_date}}</label><br>
</div> -->
    <?php 
    $totalnoroom=1;
    $cal_tot_amt=0;
    $cal_tot_cgst=0;
    $cal_tot_sgst=0;
    $cal_tot_total_amount=0;
    ?>
    @foreach($room_rent as $key => $room_rents)
    <!-- {{$room_rents['normal_rate']}} -->
    <!-- <div class="col-sm-12">
        <label>Hall : {{($key + 1)}}</label>
    </div> -->
    <input type="text" hidden name="book_flag_{{$key}}" id="book_flag_{{$key}}" value="{{$room_rents['book_flag']}}">
    <div class="col-sm-6">
        <label>Per Room / Per <?php if( $room_rents['book_flag']=='H'){echo "Hourly";}else{echo "Day";}?> : </label>
        <input type="text" name="per_room_per_night_{{$key}}" id="per_room_per_night_{{$key}}" required class="form-control" value="{{$room_rents['normal_rate']}}"
            readonly>
    </div>
    <div class="col-sm-6">
        <label>Total no of <?php if( $room_rents['book_flag']=='H'){echo "Hourly";}else{echo "Day";}?> :</label>
        <input type="text" name="tot_no_of_night_{{$key}}" id="tot_no_of_night_{{$key}}" required class="form-control" value="{{$interval}}" readonly>
    </div>
    <div class="col-sm-6">
        <label>Amount :<?php 
        $amount= (($room_rents['normal_rate']*$interval)*$totalnoroom) ;
        $cal_tot_amt +=$amount;
        ?></label>
        <input type="text" name="amount_{{$key}}" id="amount_{{$key}}" required class="form-control" value="{{$amount}}" readonly>
    </div>
    <input type="text" hidden name="cgst_rate_per_{{$key}}" id="cgst_rate_per_{{$key}}" value="{{$room_rents['cgst_rate']}}">
    <input type="text" hidden name="sgst_rate_per_{{$key}}" id="sgst_rate_per_{{$key}}" value="{{$room_rents['sgst_rate']}}">
    <div class="col-sm-6">
        <label>CGST : <?php 
        $cgst=($amount * $room_rents['cgst_rate'])/100; 
        $cal_tot_cgst +=$cgst;
        ?></label>
        <input type="text" id="cgst_rate_{{$key}}" name="cgst_rate_{{$key}}" id="" required class="form-control" value="{{$cgst}}" readonly>
    </div>
    <div class="col-sm-6">
        <label>SGST : <?php  
        $sgst=($amount * $room_rents['sgst_rate'])/100; 
        $cal_tot_sgst +=$sgst;
        ?></label>
        <input type="text" id="sgst_rate_{{$key}}" name="sgst_rate_{{$key}}" id="" required class="form-control" value="{{$sgst}}" readonly>
    </div>
    <div class="col-sm-6">
        <label> Net Amount : <?php  
        $total_amount=$amount + $cgst + $sgst;
        $cal_tot_total_amount +=$total_amount;
        ?></label>
        <input type="text" id="net_amount_{{$key}}" name="cal_total_amount" id="cal_total_amount" required class="form-control"
            value="{{$total_amount}}" readonly>
    </div>
    @endforeach
    <input type="text" hidden name="cal_tot_total_amount" id="cal_tot_total_amount" value="{{$cal_tot_total_amount}}">
    <!-- <div class="col-sm-6">
        <label>Per Room / Per Night : </label>
        <input type="text" id="per_room_per_night" required class="form-control" value="{{$room_rent[0]['normal_rate']}}" readonly>
    </div> -->
    <!-- <div class="col-sm-6">
        <label>Total no of Rooms : <?php $totalnoroom=1;?></label>
        <input type="text" id="tot_no_of_room" required class="form-control" value="{{$totalnoroom}}" readonly>
    </div>
    <div class="col-sm-6">
        <label>Total no of Nights :</label>
        <input type="text" id="tot_no_of_night" required class="form-control" value="{{$interval}}" readonly>
    </div> -->
    <!-- <div class="col-sm-6">
        <label>Amount :<?php $amount= (($room_rent[0]['normal_rate']*$interval)*$totalnoroom) ;?></label>
        <input type="text" id="amount" required class="form-control" value="{{$amount}}" readonly>
    </div>
   
    <div class="col-sm-6">
        <label>CGST : <?php $cgst=($amount * $room_rent[0]['cgst_rate'])/100; ?></label>
        <input type="text" id="cgst_rate" name="" id="" required class="form-control" value="{{$cgst}}" readonly>
    </div>
    <div class="col-sm-6">
        <label>SGST : <?php  $sgst=($amount * $room_rent[0]['sgst_rate'])/100; ?></label>
        <input type="text" id="sgst_rate" name="" id="" required class="form-control" value="{{$sgst}}" readonly>
    </div> -->

    <!-- <div class="col-sm-6">
        <label> Net Amount : <?php  $total_amount=$amount + $cgst + $sgst;?></label>
        <input type="text" id="net_amount" name="cal_total_amount" id="cal_total_amount" required class="form-control"
            value="{{$total_amount}}" readonly>
    </div> -->
</div>
<div class="form-group row">
    <div class="col-sm-6">
        <label>Discount : </label>
        <input type="text" name="discount_price" id="discount_price" required class="form-control" value="0"
            onchange="youFunction({{$advance_payment}});">
    </div>

    <div class="col-sm-6">
        <label>Total Amount : </label>
        <input type="text" name="total_amount" id="total_amount" required class="form-control"
            value="{{$cal_tot_total_amount}}" readonly>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-12">
        <label>Remark : </label>
        <textarea name="remark" id="remark" cols="30" rows="5" required class="form-control"></textarea>
    </div>
</div>
<div class="form-group row">
    @if($catering_service=='Y')
    <div class="col-sm-4">
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="" id="" value="Y" checked>
                Catering Service
                <i class="input-helper"></i></label>
        </div>
    </div>
    @endif
    @if($laptop_prajector=='Y')
    <div class="col-sm-4">
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="" id="" value="Y" checked>
                Laptop Projector
                <i class="input-helper"></i></label>
        </div>
    </div>
    @endif 
    @if($sound_system=='Y')
    <div class="col-sm-4">
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="" id="" value="Y" checked>
                Sound System
                <i class="input-helper"></i></label>
        </div>
    </div>
    @endif
</div>
</div>


<div class="form-group row" id="paymentDiv">

    <div class="col-sm-6">
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="payment" id="payment_advance"
                    value="{{($total_amount * $advance_payment)/100}}" checked="">
                Advance Payment ({{($total_amount * $advance_payment)/100}})
                <i class="input-helper"></i></label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="payment" id="payment_full" value="{{$total_amount}}">
                 Full Payment ({{$total_amount}})
                <i class="input-helper"></i></label>
        </div>
    </div>
    <div class="col-sm-6">

    </div>
</div>
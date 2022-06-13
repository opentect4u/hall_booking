<!-- <div class="form-group "> -->
<div class="form-group row">

    <div class="col-sm-12">
        <label>Check In : {{$from_date}} | Check Out : {{$to_date}}</label>
    </div>
    <!-- <div class="col-sm-6">
    <label>Check Out : {{$to_date}}</label><br>
</div> -->
    <div class="col-sm-6">
        <label>Per Room / Per Night : </label>
        <input type="text" required class="form-control" value="{{$room_rent[0]['normal_rate']}}" readonly>
    </div>
    <div class="col-sm-6">
        <label>Total no of Rooms :</label>
        <input type="text" required class="form-control" value="{{$totalnoroom}}" readonly>
    </div>
    <div class="col-sm-6">
        <label>Total no of Nights :</label>
        <input type="text" required class="form-control" value="{{$interval}}" readonly>
    </div>
    <div class="col-sm-6">
        <label>Amount :<?php $amount= (($room_rent[0]['normal_rate']*$interval)*$totalnoroom) ;?></label>
        <input type="text" required class="form-control" value="{{$amount}}" readonly>
    </div>
    <!-- <div class="col-sm-12">
    <label>{{$totalnoroom}} Room x {{$interval}} Nights :
        <?php echo $amount= (($room_rent[0]['normal_rate']*$interval)*$totalnoroom) ;?></label>
</div> -->
    <div class="col-sm-6">
        <label>CGST : <?php $cgst=($amount * $room_rent[0]['cgst_rate'])/100; ?></label>
        <input type="text" name="" id="" required class="form-control" value="{{$cgst}}" readonly>
    </div>
    <div class="col-sm-6">
        <label>SGST : <?php  $sgst=($amount * $room_rent[0]['sgst_rate'])/100; ?></label>
        <input type="text" name="" id="" required class="form-control" value="{{$sgst}}" readonly>
    </div>
    @if($catering_service=='Y')
    <div class="col-sm-6">
        <label>Catering service per night : </label>
        <input type="text" name="" id="" required class="form-control" value="{{$catering_service_amount}}" readonly>
    </div>
    <div class="col-sm-6">
        <label>Catering service Total Amount : <?php  $cat_ser_tot_amount=$catering_service_amount * $interval ;?></label>
        <input type="text" name="" id="" required class="form-control" value="{{$cat_ser_tot_amount}}" readonly>
    </div>
    @else
    <?php $cat_ser_tot_amount=0; ?>
    @endif
    <div class="col-sm-6">
        <label> Amount : <?php  $total_amount=$amount + $cgst + $sgst + $cat_ser_tot_amount;?></label>
        <input type="text" name="cal_total_amount" id="cal_total_amount" required class="form-control" value="{{$total_amount}}" readonly>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-6">
        <label>Discount : </label>
        <input type="text" name="discount_price" id="discount_price" required class="form-control" value="0" onchange="youFunction();">
    </div>
    <div class="col-sm-6">
        <label>Remark : </label>
        <input type="text" name="remark" id="remark" required class="form-control" >
    </div>
    <div class="col-sm-6">
        <label>Total Amount : </label>
        <input type="text" name="total_amount" id="total_amount" required class="form-control" value="{{$total_amount}}" readonly>
    </div>
</div>

<div class="form-group row">

    @if($totalnoroom >=$advance_payment_needed)
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
    @endif
    <!-- </div> -->
    <div class="col-sm-6">

    </div>
</div>



<!-- <div class="col-sm-6">
    <label>Check In : <?php echo $amount = $room_rent[0]['normal_rate'] * $totalnoroom ?></label><br>
</div>
<div class="col-sm-6">
    <label>Check Out : ({{$room_rent[0]['discount_percentage']}}%) : <?php echo $discount_amount=(($room_rent[0]['discount_percentage'] * $amount)/100) ; ?></label><br>
</div>
<div class="col">
    <label>Total No of Room : {{$totalnoroom}}</label><br>
</div>
<div class="col">
    <label> CGST ({{$room_rent[0]['cgst_rate']}}%) : <?php echo $cgst = (($amount - $discount_amount)*$room_rent[0]['cgst_rate'])/100?></label><br>
</div>
<div class="col">
    <label> SGST ({{$room_rent[0]['sgst_rate']}}%) : <?php echo $cgst = (($amount - $discount_amount)*$room_rent[0]['sgst_rate'])/100?></label><br>
</div>
<div class="col">
    <label>Total Amount : <?php echo $total_amount=($amount - $discount_amount) + $cgst + $cgst ;?></label><br>
</div> -->
<!-- <div class="form-group "> -->
<div class="col-sm-12">
    <label>Check In : {{$from_date}} | Check Out : {{$to_date}}</label>
</div>
<!-- <div class="col-sm-6">
    <label>Check Out : {{$to_date}}</label><br>
</div> -->
<div class="col-sm-12">
    <label>Per Room / Per Night : {{$room_rent[0]['normal_rate']}}</label>
</div>
<div class="col-sm-12">
    <label>{{$totalnoroom}} Room x {{$interval}} Nights :
        <?php echo $amount= (($room_rent[0]['normal_rate']*$interval)*$totalnoroom) ;?></label>
</div>
<div class="col-sm-12">
    <label>CGST : <?php echo $cgst=($amount * $room_rent[0]['cgst_rate'])/100; ?></label>
</div>
<div class="col-sm-12">
    <label>SGST : <?php echo $sgst=($amount * $room_rent[0]['sgst_rate'])/100; ?></label>
</div>
<div class="col-sm-12">
    <label>Total Amount : <?php echo $total_amount=$amount + $cgst + $sgst ;?></label><br>
</div>
@if($totalnoroom >=$advance_payment_needed)
<div class="col-sm-6">
    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="payment" id="payment_advance" value="{{($total_amount * $advance_payment)/100}}" checked="">
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
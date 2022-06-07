
<div class="col-sm-5">
    <label>Amount : <?php echo $amount = $room_rent[0]['normal_rate'] * $totalnoroom ?></label><br>
    <label>Discount Amount ({{$room_rent[0]['discount_percentage']}}%) : <?php echo $discount_amount=(($room_rent[0]['discount_percentage'] * $amount)/100) ; ?></label><br>
    <label>Total No of Room : {{$totalnoroom}}</label><br>
    <label> CGST ({{$room_rent[0]['cgst_rate']}}%) : <?php echo $cgst = (($amount - $discount_amount)*$room_rent[0]['cgst_rate'])/100?></label><br>
    <label> SGST ({{$room_rent[0]['sgst_rate']}}%) : <?php echo $cgst = (($amount - $discount_amount)*$room_rent[0]['sgst_rate'])/100?></label><br>
    <label>Total Amount : <?php echo $total_amount=($amount - $discount_amount) + $cgst + $cgst ;?></label><br>
</div>
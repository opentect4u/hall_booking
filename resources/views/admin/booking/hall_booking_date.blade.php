<div class="form-group row">
    @for ($o = 0; $o < $days; $o++) <div class="col-sm-4">
        <label>Date</label>
        <input type="text" name="all_dates[]" id="all_dates_{{$o}}" placeholder="DD-MM-YYYY" class="form-control">
</div>

<script>

var maxbooking_date = '<?php echo $advance_book_date;?>';
    var dateAr = maxbooking_date.split('-');
    var maxbooking_date_format = dateAr[1] + '/' + dateAr[2] + '/' + dateAr[0];
    // alert(maxbooking_date_format)
    var someDate = new Date();
    var numberOfDaysToAdd = 1;
    var result = someDate.setDate(someDate.getDate() + numberOfDaysToAdd);
    // alert(result);
    $("#all_dates_"+<?php echo $o;?>).datepicker({
        format: 'dd-mm-yyyy',
        // todayHighlight: true,
        orientation: 'top',
        autoclose: true,
        startDate: new Date(result),
        endDate: new Date(maxbooking_date_format)
    });
</script>
@endfor
</div>

<!-- <div class="form-group row">
    <div class="col-sm-12">
        <label><b>Check In Time :  A.M. | Check Out Time :
                 A.M.</b></label>
    </div>
    <div class="col-sm-12">
        <label><b id="totalNightsB"></b></label>
    </div>
</div> -->

<div class="form-group row">
</div>

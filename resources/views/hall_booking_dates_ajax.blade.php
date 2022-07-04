@for ($o = 1; $o <= $days; $o++)
<div class="col-sm-6 fieldCus float-left">
    <label>Date {{$o}}</label>
    <input type="text" id="hallbookingdate_{{$o}}" name="hallbookingdate[]" class="form-control" placeholder="dd-mm-yyyy" required>
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
    $("#hallbookingdate_"+<?php echo $o;?>).datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: false,
        orientation: 'top',
        autoclose: true,
        startDate: new Date(result),
        endDate: new Date(maxbooking_date_format)
    });
</script>
@endfor

@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Room Rent {{ isset($customer)?'Edit':'Add'}}</h4>
                    @if(Session::has('update'))
                    <div class="alert alert-success" role="alert">Room Rent updated successfully.</div>
                    @endif
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form autocomplete="off" class="forms-sample" method="post"
                        action="{{ isset($customer)?route('admin.roomRenteditconfirm'):route('admin.roomRentadd')}}">
                        @csrf
                        <input type="text" hidden name="id" id="id" value="{{isset($customer)?$customer->id:''}}">

                        <div class="form-group">
                            <label for="exampleInputName1">Effective Date</label>
                            <input type="text" class="form-control" required name="effective_date" id="effective_date"
                                value="{{isset($customer)?date('d-m-Y',strtotime($customer->effective_date)):''}}"
                                placeholder="DD-MM-YYYY">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Location </label>
                            <select name="location_id" id="location_id" required class="form-control">
                                <option value=""> -- Select -- </option>
                                @foreach($locations as $location)
                                <option value="{{$location->id}}" <?php if(isset($customer) && $customer->location_id==$location->id){echo "selected";}?>>{{$location->location}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Room Type </label>
                            <select name="room_type_id" id="room_type_id" required class="form-control">
                                <option value=""> -- Select -- </option>
                                
                            </select>
                        </div>
                        

                        <div class="form-group">
                            <label for="exampleInputName1">Hour Flag </label>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="book_flag" required
                                                    id="hour_flag1" value="H" <?php if(isset($customer) && $customer->book_flag=='H'){echo "checked";}?> >
                                                    Hourly
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="book_flag"
                                                    id="hour_flag2" value="B" <?php if(isset($customer) && $customer->book_flag=='B'){echo "checked";}?> >
                                                    Per Bed
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="book_flag"
                                                    id="hour_flag2" value="W" <?php if(isset($customer) && $customer->book_flag=='W'){echo "checked";}?> >
                                                    Whole Room
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputName1">Amount</label>
                            <input type="text" class="form-control" required name="normal_rate" id="normal_rate"
                                value="{{isset($customer)?$customer->normal_rate:''}}" placeholder="Amount">
                        </div>
                       
                        <!-- <button type="submit" class="btn btn-primary mr-2">Submit</button> -->
                        <input type="submit" class="btn btn-primary mr-2" value="{{ isset($customer)?'Edit':'Add'}}">
                        <!-- <button class="btn btn-light">Cancel</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<!-- <link rel="stylesheet" href="{{ asset('public/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<script src="{{ asset('public/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script> -->
<!-- <script src="{{ asset('public/js/formpickers.js') }}"></script> -->

<script>
$(document).ready(function() {
    // console.log("ready!");
    // alert('hii');
    // HourFlag
    // PerBedFlag

    $("#effective_date").datepicker({
        enableOnReadonly: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        autoclose: true,
        startDate: new Date()
        // endDate: new Date()
    });

});

</script>
@if(isset($customer))
<script>
$(document).ready(function() {
    var location_id = '<?php echo $customer->location_id;?>';
    var select_location_id = '<?php echo $customer->room_type_id;?>';
    RoomTypeAjax(location_id, select_location_id);
});
</script>
@else
<script>
$('#location_id').on('change', function() {
    // alert('hii');
    var location_id = $('#location_id').val();
    var select_location_id = '';
    // alert(location_id);
    RoomTypeAjax(location_id, select_location_id);

})
</script>
@endif
<script>
function RoomTypeAjax(location_id, select_location_id) {
    $.ajax({
        url: "{{route('admin.roomTypeAjax')}}",
        method: "POST",
        data: {
            location_id: location_id,
            select_location_id: select_location_id,
            code: 'R',
        },
        success: function(data) {
            // alert(data);
            // var obj=JSON.parse(data);
            $('#room_type_id').empty();
            $("#room_type_id").html(data);

        }
    });
}
</script>
@endsection
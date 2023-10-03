@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Hall Rent {{ isset($customer)?'Edit':'Add'}}</h4>
                    @if(Session::has('update'))
                    <div class="alert alert-success" role="alert">Hall Rent updated successfully.</div>
                    @endif
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form autocomplete="off" class="forms-sample" method="post"
                        action="{{ isset($customer)?route('admin.hallRenteditconfirm'):route('admin.hallRentadd')}}">
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
                                <option value="{{$location->id}}"
                                    <?php if(isset($customer) && $customer->location_id==$location->id){echo "selected";}?>>
                                    {{$location->location}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Hall Type </label>
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
                                                    id="hour_flag1" value="H"
                                                    <?php if(isset($customer) && $customer->book_flag=='H'){echo "checked";}?>>
                                                Hourly
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="book_flag"
                                                    id="hour_flag2" value="B"
                                                    <?php if(isset($customer) && $customer->book_flag=='B'){echo "checked";}?>>
                                                Per Bed
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="book_flag"
                                                    id="hour_flag2" value="W"
                                                    <?php if(isset($customer) && $customer->book_flag=='W'){echo "checked";}?>>
                                                Whole Room
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Hall no</label>
                            <select name="room_id" id="room_id" required class="form-control">
                                <option value=""> -- Select -- </option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Amount</label>
                            <input type="text" class="form-control" required name="normal_rate" id="normal_rate"
                                value="{{isset($customer)?$customer->normal_rate:''}}" placeholder="Amount">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Holiday Amount</label>
                            <input type="text" class="form-control" required name="holiday_rate" id="holiday_rate"
                                value="{{isset($customer)?$customer->holiday_rate:''}}" placeholder="Holiday Amount">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Caution money (%)</label>
                            <input type="text" class="form-control" required name="caution_money"
                                id="caution_money" value="{{isset($customer)?$customer->caution_money:''}}"
                                placeholder="caution money">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">CGST Rate (%)</label>
                            <input type="text" class="form-control" required name="cgst_rate" id="cgst_rate"
                                value="{{isset($customer)?$customer->cgst_rate:''}}" placeholder="CGST Rate">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">SGST Rate (%)</label>
                            <input type="text" class="form-control" required name="sgst_rate" id="sgst_rate"
                                value="{{isset($customer)?$customer->sgst_rate:''}}" placeholder="SGST Rate">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Check In </label>
                            <input type="text" class="form-control" required name="check_in_time" id="check_in_time"
                                value="{{isset($customer)?$customer->check_in_time:''}}" placeholder="check in time">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Period</label>
                            <input type="text" class="form-control" required name="period" id="period"
                                value="{{isset($customer)?$customer->period:''}}" placeholder="Period">
                        </div>

                        <!-- <button type="submit" class="btn btn-primary mr-2">Submit</button> -->
                        <input type="submit" class="btn btn-primary mr-2" value="{{ isset($customer)?'Submit':'Add'}}">
                        <!-- <button class="btn btn-light">Cancel</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<link rel="stylesheet" href="{{ asset('public/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<script src="{{ asset('public/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
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
        // // startDate: new Date()
        endDate: new Date()
    });

});
</script>
@if(isset($customer))
<script>
$(document).ready(function() {
    var location_id = '<?php echo $customer->location_id;?>';
    var select_location_id = '<?php echo $customer->room_type_id;?>';
    var select_room_id = '<?php echo $customer->room_id;?>';
    RoomTypeAjax(location_id, select_location_id);
    HallNoAjax(location_id,select_location_id, select_room_id);
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

$('#room_type_id').on('change', function() {
    // alert('hii');
    var location_id = $('#location_id').val();
    var room_type_id = $('#room_type_id').val();
    var select_room_id = '';
    // alert(location_id);
    HallNoAjax(location_id,room_type_id, select_room_id);

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
            code: 'H',
        },
        success: function(data) {
            // alert(data);
            // var obj=JSON.parse(data);
            $('#room_type_id').empty();
            $("#room_type_id").html(data);

        }
    });
}

function HallNoAjax(location_id, room_type_id, select_room_id) {
    $.ajax({
        url: "{{route('admin.hallNoAjax')}}",
        method: "POST",
        data: {
            location_id: location_id,
            room_type_id: room_type_id,
            select_room_id: select_room_id,
            code: 'H',
        },
        success: function(data) {
            // alert(data);
            // var obj=JSON.parse(data);
            $('#room_id').empty();
            $("#room_id").html(data);

        }
    });
}
</script>
@endsection
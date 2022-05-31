@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Search Room</h4>
                    <!-- <p class="card-description">A simple suggestion engine</p> -->
                    <form action="{{route('admin.searchroom')}}" method="get" autocomplete="off">
                        <div class="form-group row">
                            <div class="col">
                                <label>Location</label>
                                <select name="location_id" id="location_id" required class="form-control">
                                    <option value=""> -- Select -- </option>
                                    @foreach($locations as $location)
                                    <option value="{{$location->id}}"
                                        <?php if(isset($customer) && $customer->location_id==$location->id){echo "selected";}?>>
                                        {{$location->location}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Room Type</label>
                                <!-- <input type="text" class="form-control"> -->
                                <select name="room_type_id" id="room_type_id" required class="form-control">
                                    <option value=""> -- Select -- </option>
                                    @foreach($room_types as $room_type)
                                    <option value="{{$room_type->id}}"
                                        <?php if(isset($customer) && $customer->room_type_id==$room_type->id){echo "selected";}?>>
                                        {{$room_type->type}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Check In Date</label>
                                <input type="text" name="from_date" id="from_date" placeholder="DD-MM-YYYY"
                                    class="form-control">
                            </div>
                            <div class="col">
                                <label>Check Out Date</label>
                                <input type="text" name="to_date" id="to_date" placeholder="DD-MM-YYYY"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>No of Room</label>
                                <input type="number" name="no_room" id="no_room" value="1" placeholder=""
                                    class="form-control">
                            </div>
                            <div class="col">
                                <label>No of Adult</label>
                                <input type="number" name="no_adult" id="no_adult" value="1" placeholder=""
                                    class="form-control">
                            </div>
                            <div class="col">
                                <label>No of Child</label>
                                <input type="number" name="no_child" id="no_child" value="0" placeholder=""
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col col-sm-12">
                                <!-- <label>Basic</label> -->
                                <input type="submit" class="btn btn-primary mr-2" value="Submit">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
</script>
<script>
jQuery('#from_date').datetimepicker({
    timepicker: false,
    format: 'd-m-Y',
    // formatDate:'DD/MM/YYYY',
    // mask: true,
    minDate: ' -1970/01/02', //yesterday is minimum date(for today use 0 or -1970/01/01)
    // maxDate: '+1970/01/02' //tomorrow is maximum date calendar
});
jQuery('#to_date').datetimepicker({
    timepicker: false,
    format: 'd-m-Y',
    // mask: true,
    minDate: ' -1970/01/02', //yesterday is minimum date(for today use 0 or -1970/01/01)
    // maxDate: '+1970/01/02' //tomorrow is maximum date calendar
});

// jQuery(function() {
//     jQuery('#from_date').datetimepicker({
//         format: 'Y/m/d',
//         minDate: ' -1970/01/02',
//         onShow: function(ct) {
//             this.setOptions({
//                 maxDate: jQuery('#to_date').val() ? jQuery(
//                     '#to_date').val() : false
//             })
//         },
//         timepicker: false
//     });
//     jQuery('#to_date').datetimepicker({
//         format: 'Y/m/d',
//         // minDate: ' -1970/01/02',
//         onShow: function(ct) {
//             this.setOptions({
//                 minDate: jQuery('#from_date').val() ? jQuery(
//                     '#from_date').val() : ' -1970/01/02'
//             })
//             // this.setOptions({
//             //     minDate: jQuery('#from_date').val() ? jQuery(
//             //         '#from_date').val() : false
//             // })
//         },
//         timepicker: false
//     });
// });
</script>
@endsection
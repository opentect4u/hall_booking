@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- <div class="col-12">
                            <form action="#">
                                <div class="form-group d-flex">
                                    <input type="text" class="form-control" placeholder="Search Here" value="Urbanui">
                                    <button type="submit" class="btn btn-primary ml-3">Search</button>
                                </div>
                            </form>
                        </div> -->
                        <div class="col-12 mb-5">
                            <h2>Search Result For<u class="ml-2">"{{$room_type}}"</u></h2>
                            <!-- <p class="text-muted">About 10 results</p> -->
                        </div>


                        <!-- <div class="col-12 results">
                            <div class="pt-4 border-bottom">
                                <a class="d-block h4" href="#">Urbanui Team – Medium</a>
                                <a class="page-url text-primary" href="#">https://medium.com/@urbanui</a>
                                <p class="page-description mt-1 w-75 text-muted">Read writing from Urbanui Team on
                                    Medium. We design and develop awesome admin dashboard templates with Bootstrap, so
                                    you can kick-start and speed up your development. www.urbanui.com.</p>
                            </div>
                        </div> -->



                    </div>
                  

                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Passenger Details</h4>
                    <!-- <p class="card-description">A simple suggestion engine</p> -->
                    <form action="{{route('admin.passengerDetails')}}" method="post" autocomplete="off">
                        @csrf
                        <input type="text" hidden name="amount" id="amount" value="{{$request->amount}}">
                        <input type="text" hidden name="location_id" id="location_id" value="{{$request->location_id}}">
                        <input type="text" hidden name="room_type_id" id="room_type_id" value="{{$request->room_type_id}}">
                        <input type="text" hidden name="from_date" id="from_date" value="{{$request->from_date}}">
                        <input type="text" hidden name="to_date" id="to_date" value="{{$request->to_date}}">
                        <input type="text" hidden name="no_room" id="no_room" value="{{$request->no_room}}">
                        <input type="text" hidden name="no_adult" id="no_adult" value="{{$request->no_adult}}">
                        <input type="text" hidden name="no_child" id="no_child" value="{{$request->no_child}}">
                        <p class="card-description">Adult 1</p>
                        <div class="form-group row">
                            <div class="col">
                                <label>First Name</label>
                                <input type="text" name="adt_first_name" id="adt_first_name" value="" placeholder=""
                                    class="form-control">
                            </div>
                            <div class="col">
                                <label>Middle Name</label>
                                <input type="text" name="adt_middle_name" id="adt_middle_name" value="" placeholder=""
                                    class="form-control">
                            </div>
                            <div class="col">
                                <label>Last Name</label>
                                <input type="text" name="adt_last_name" id="adt_last_name" value="" placeholder=""
                                    class="form-control">
                            </div>
                            
                        </div>
                        <!-- <p class="card-description">Child 1</p>
                        <div class="form-group row">
                            <div class="col">
                                <label>First</label>
                                <input type="number" name="child_first_name" id="child_first_name" value="1" placeholder=""
                                    class="form-control">
                            </div>
                            <div class="col">
                                <label>No of Child</label>
                                <input type="number" name="child_middle_name" id="child_middle_name" value="0" placeholder=""
                                    class="form-control">
                            </div>
                            <div class="col">
                                <label>No of Adult</label>
                                <input type="number" name="child_last_name" id="child_last_name" value="1" placeholder=""
                                    class="form-control">
                            </div>
                            
                        </div> -->
                        <p class="card-description">Billing details</p>
                        <div class="form-group row">
                            <div class="col">
                                <label>post code</label>
                                <input type="text" name="post_code" id="post_code" placeholder=""
                                    class="form-control">
                            </div>
                            <div class="col">
                                <label>Address</label>
                                <input type="text" name="address" id="address" placeholder=""
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>City</label>
                                <input type="text" name="city" id="city" placeholder=""
                                    class="form-control">
                            </div>
                            <div class="col">
                                <label>Country</label>
                                <input type="text" name="country" id="country" placeholder=""
                                    class="form-control">
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Email</label>
                                <input type="email" name="email" id="email" placeholder=""
                                    class="form-control">
                            </div>
                            <div class="col">
                                <label>Contact</label>
                                <input type="text" name="contact" id="contact" placeholder=""
                                    class="form-control">
                            </div>
                            
                        </div>
                        
                        <div class="form-group row">
                            <div class="col col-sm-12">
                                <!-- <label>Basic</label> -->
                                <input type="submit" class="btn btn-primary mr-2" value="Book Now">
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
    format: 'd/m/Y',
    // formatDate:'DD/MM/YYYY',
    // mask: true,
    minDate: ' -1970/01/02', //yesterday is minimum date(for today use 0 or -1970/01/01)
    // maxDate: '+1970/01/02' //tomorrow is maximum date calendar
});
jQuery('#to_date').datetimepicker({
    timepicker: false,
    format: 'd/m/Y',
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
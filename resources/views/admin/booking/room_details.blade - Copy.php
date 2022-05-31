@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
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
                            <!-- <p class="text-muted">About {{count($datas)}} results</p> -->
                        </div>
                        @foreach($datas as $data)
                        <div class="col-12 results">
                            <div class="pt-4 border-bottom">
                                <!-- <a class="d-block h4" href="java">Urbanui</a> -->
                                <h2>{{$data->room_name}}</h2>
                                <a class="page-url text-primary" href="#">https://www.urbanui.com/</a>
                                <p class="page-description mt-1 w-75 text-muted">Urbanui gives you the most beautiful,
                                    free and premium bootstrap admin dashboard templates and control panel themes based
                                    on Bootstrap 3 and 4.</p>
                                <p class="">Amount : 100</p>
                                <p class="">SGST : 10</p>
                                <p class="">CGST : 10</p>
                                
                                <form action="{{route('admin.roomBook')}}" method="post">
                                    @csrf
                                    <!-- <input type="text" value="{{json_encode($data)}}"> -->
                                    <input type="text" hidden name="amount" id="amount" value="100">
                                    <input type="text" hidden name="location_id" id="location_id" value="{{$request->location_id}}">
                                    <input type="text" hidden name="room_type_id" id="room_type_id" value="{{$request->room_type_id}}">
                                    <input type="text" hidden name="from_date" id="from_date" value="{{$request->from_date}}">
                                    <input type="text" hidden name="to_date" id="to_date" value="{{$request->to_date}}">
                                    <input type="text" hidden name="no_room" id="no_room" value="{{$request->no_room}}">
                                    <input type="text" hidden name="no_adult" id="no_adult" value="{{$request->no_adult}}">
                                    <input type="text" hidden name="no_child" id="no_child" value="{{$request->no_child}}">

                                    <input type="submit" class="btn btn-primary" value="Book Now">
                                </form>
                            </div>
                            
                        </div>
                        @endforeach

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
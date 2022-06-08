@extends('admin.common.master')
@section('content')
<style>

</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Room Booking</h4>
                    <form id="Booking_form" name="Booking_form" action="{{route('admin.bookingConfirm')}}" method="post"
                        autocomplete="off">
                        @csrf
                        <div>
                            <h3>Search</h3>
                            <section>
                                <h3>Search</h3>
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
                                        <label>Room Type </label>
                                        <select name="room_type_id" id="room_type_id" required class="form-control">
                                            <option value=""> -- Select -- </option>

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
                                    <div class="col-sm-12">
                                        <label><b>Check In Time : {{$checking_time}} A.M. | Check Out Time :
                                                {{$checkout_time}} A.M.</b></label>
                                    </div>
                                    <div class="col-sm-12">
                                        <label><b id="totalNightsB"></b></label>
                                    </div>
                                </div>

                            </section>
                            <h3>Rooms</h3>
                            <section>
                                <h3>Rooms</h3>
                                <div id="availableRoomNo">
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>Room No</label>
                                        <input type="number" name="total_room_no" id="total_room_no" readonly
                                            class="form-control" placeholder="">
                                    </div>
                                    <!-- <div class="col">
                                        <label>Adult No</label>
                                        <input type="number" name="adult_no" id="adult_no" value="1"
                                            class="form-control" placeholder="">
                                    </div>
                                    <div class="col">
                                        <label>Child No</label>
                                        <input type="number" name="child_no" id="child_no" value="0"
                                            class="form-control" placeholder="">
                                    </div> -->
                                </div>
                                <div id="roomPerson"></div>

                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="membershipRadios"
                                                    id="membershipRadios1" value="">
                                                Catering Service
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="membershipRadios"
                                                    id="membershipRadios2" value="option2">
                                                Food Charge
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div> -->
                                </div>
                            </section>
                            <h3>Passenger</h3>
                            <section>
                                <h3>Passenger Details</h3>
                                <div class="form-check" id="passengerDetailsDiv">

                                </div>
                            </section>
                            <h3>Price</h3>
                            <section>
                                <h3>Price Details</h3>
                                <div class="form-group row" id="priceDetailsDiv">

                                </div>
                            </section>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>


@endsection

@section('script')

<!-- Plugin js for this page -->
<script src="{{ asset('public/vendors/jquery-steps/jquery.steps.min.js') }}"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>

<script>
// jQuery('#from_date').datetimepicker({
//     timepicker: false,
//     format: 'd-m-Y',
//     // formatDate:'DD/MM/YYYY',
//     // mask: true,
//     minDate: ' -1970/01/02', //yesterday is minimum date(for today use 0 or -1970/01/01)
//     // maxDate: '+1970/01/02' //tomorrow is maximum date calendar
// });
// jQuery('#to_date').datetimepicker({
//     timepicker: false,
//     format: 'd-m-Y',
//     // mask: true,
//     minDate: ' -1970/01/02', //yesterday is minimum date(for today use 0 or -1970/01/01)
//     // maxDate: '+1970/01/02' //tomorrow is maximum date calendar
// });

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

$(document).ready(function() {

    // console.log("ready!");
    var form = $("#Booking_form");
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        // labels: {
        //     finish: "Go",
        // },
        // onStepChanged: function(event, currentIndex, newIndex) {
        //     alert("Next !!!!"+currentIndex);
        // },
        onStepChanging: function(event, currentIndex, newIndex) {
            // alert("Next !!!!" + newIndex);
            var location_id = $('#location_id').val();
            var room_type_id = $('#room_type_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (newIndex == 0) {
                return true;
            } else if (newIndex == 1) {
                var maxbooking_date = '<?php echo date('Y-d-m',strtotime($advance_book_date));?>';
                // alert(from_date)
                // alert("from_date M "+ moment(from_date).format('YYYY-DD-MM') )
                // alert("from_date "+ new Date(moment(from_date).format('YYYY-DD-MM')) )
                // alert("to_date"+ new Date(maxbooking_date) )
                if (location_id == '') {
                    alert('Select Location')
                    return false;
                } else if (room_type_id == '') {
                    alert('Select Room Type')
                    return false;
                } else if (from_date == '') {
                    alert('Select from date')
                    return false;
                } else if (to_date == '') {
                    alert('Select to date')
                    return false;
                } else if (new Date(moment(from_date).format('YYYY-DD-MM')) > new Date(
                        maxbooking_date)) {
                    // alert(maxbooking_date )
                    alert('Select booking date below ' + new Date(maxbooking_date))
                    return false;
                }
                // alert(room_type_id);
                Available_Room(location_id, room_type_id, from_date, to_date);
                return true;
            } else if (newIndex == 2) {
                var totalnoroom = $(".roomNoChecked:checked").length;
                var max_person_number = $('#max_person_number').val();
                // alert(x)
                if (totalnoroom == 0) {
                    alert('Please select any room No');
                    return false;
                }

                for (let index = 1; index <= totalnoroom; index++) {
                    var adult_no = $("#adult_no_" + index).val();
                    if (adult_no == 0) {
                        alert('Enter adult No room ' + index);
                        return false;
                    } else if (adult_no > max_person_number) {
                        alert('Enter maximum adult No ' + max_person_number + ' for room ' + index);
                        return false;
                    }

                }
                var total_room_no = $('#total_room_no').val();
                var adult_no = $('#adult_no').val();
                var child_no = $('#child_no').val();
                PassengerDetails(total_room_no, adult_no, child_no);
                return true;
                // return 0;
            } else if (newIndex == 3) {
                // alert(currentIndex+"hii")
                // alert('hello')
                var total_room_no = $('#total_room_no').val();
                var totalnoroom = $(".roomNoChecked:checked").length;
                var max_person_number = $('#max_person_number').val();
                // alert(total_room_no)
                var adult_no_count = 0;
                var child_no_count = 0;
                for (let index = 1; index <= total_room_no; index++) {
                    adult_no_count = Number(adult_no_count) + Number($('#adult_no_' + index).val());
                    child_no_count = Number(child_no_count) + Number($('#child_no_' + index).val());
                }
                // alert(adult_no_count)
                for (let i = 0; i < adult_no_count; i++) {
                    var first_name = $('#adt_first_name' + i).val();
                    var last_name = $('#adt_last_name' + i).val();
                    if (first_name == '' && last_name == '') {
                        alert("Adult " + (i + 1) + " first name and last name can not be blank");
                        return false;
                    }
                }
                var post_code = $('#post_code').val();
                var address = $('#address').val();
                var city = $('#city').val();
                var country = $('#country').val();
                var email = $('#email').val();
                var contact = $('#contact').val();
                if (post_code == '') {
                    alert('Enter post code')
                    return false;
                } else if (address == '') {
                    alert('Enter address')
                    return false;
                } else if (city == '') {
                    alert('Enter city')
                    return false;
                } else if (country == '') {
                    alert('Enter country')
                    return false;
                } else if (email == '') {
                    alert('Enter email')
                    return false;
                } else if (contact == '') {
                    alert('Enter post code')
                    return false;
                }

                PriceDetails(location_id, room_type_id, totalnoroom, from_date, to_date);
                return true;
            } else if (newIndex == 4) {
                // alert(currentIndex)
                return true;
                // return 0;
            }
            // var setp=$('#setp').val();
            // alert(setp)
            // return false;
        },
        onFinished: function(event, currentIndex) {
            // alert("Submitted !!!!" + currentIndex);

            $("#Booking_form").submit();
        }
    });

    // form.children("div").steps({
    //     headerTag: "h3",
    //     bodyTag: "section",
    //     transitionEffect: "slideLeft",
    //     onStepChanging: function(event, currentIndex, newIndex) {
    //         alert(currentIndex+" - "+newIndex);
    //         form.val({
    //             ignore: [":disabled", ":hidden"]
    //         })
    //         return form.val();
    //     },
    //     onFinishing: function(event, currentIndex) {
    //         form.val({
    //             ignore: [':disabled']
    //         })
    //         return form.val();
    //     },
    //     onFinished: function(event, currentIndex) {
    //         alert("Submitted!");
    //     }
    // });

    $('#location_id').on('change', function() {
        // alert('hii');
        var location_id = $('#location_id').val();
        // alert(location_id);
        RoomTypeAjax(location_id);

    })
});

// $('.roomNoChecked').change(function() {
//     alert('hii')
//     // $('#textbox1').val($(this).is(':checked'));
//     var x = $(".roomNoChecked:checked").length;
//     $("#room_no").val()
//     $("#room_no").val(x)
// });


function Available_Room(location_id, room_type_id, from_date, to_date) {
    // alert(room_type_id);
    $.ajax({
        url: "{{route('admin.searchroomAjax')}}",
        method: "POST",
        data: {
            location_id: location_id,
            room_type_id: room_type_id,
            from_date: from_date,
            to_date: to_date,
        },
        success: function(data) {
            // alert(data);
            // var obj=JSON.parse(data);
            $('#availableRoomNo').empty();
            $("#availableRoomNo").html(data);

        }
    });
}

function PriceDetails(location_id, room_type_id, totalnoroom, from_date, to_date) {
    $.ajax({
        url: "{{route('admin.priceDetailsAjax')}}",
        method: "POST",
        data: {
            location_id: location_id,
            room_type_id: room_type_id,
            totalnoroom: totalnoroom,
            from_date: from_date,
            to_date: to_date,
        },
        success: function(data) {
            // alert(data);
            // var obj=JSON.parse(data);
            $('#priceDetailsDiv').empty();
            $("#priceDetailsDiv").html(data);

        }
    });
}

function PassengerDetails(total_room_no, adult_no, child_no) {
    var adult_no_count = 0;
    var child_no_count = 0;
    for (let index = 1; index <= total_room_no; index++) {
        // const element = array[index];
        // adult_no_1
        // child_no_1
        adult_no_count = Number(adult_no_count) + Number($('#adult_no_' + index).val());
        child_no_count = Number(child_no_count) + Number($('#child_no_' + index).val());

    }
    // alert(adult_no_count);
    $.ajax({
        url: "{{route('admin.passengerDetailsAjax')}}",
        method: "POST",
        data: {
            total_room_no: total_room_no,
            adult_no: adult_no_count,
            child_no: child_no_count,
        },
        success: function(data) {
            // alert(data);
            // var obj=JSON.parse(data);
            $('#passengerDetailsDiv').empty();
            $("#passengerDetailsDiv").html(data);

        }
    });
}



function RoomTypeAjax(location_id) {
    $.ajax({
        url: "{{route('admin.bookingroomTypeAjax')}}",
        method: "POST",
        data: {
            location_id: location_id,
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
@if(Session::has('bookingSuccess'))
<script>
$.toast({
    heading: 'Success',
    text: 'Booking Successfull.',
    showHideTransition: 'slide',
    icon: 'success',
    loaderBg: '#f96868',
    position: 'top-right'
})
</script>
@endif


<script>
$(document).ready(function() {



    $("#from_date").datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        orientation: 'top',
        autoclose: true,
        startDate: new Date()
        // endDate: new Date()
    });
    $("#to_date").datepicker({
        format: 'dd-mm-yyyy',
        orientation: 'top',
        todayHighlight: true,
        autoclose: true,
        startDate: new Date()
    });

    // $('#from_date').datepicker({
    //     todayHighlight: true,
    //     orientation: 'top',
    //     format: 'dd-mm-yyyy',
    //     autoclose: true,
    //     startDate: new Date(),
    //     onShow: function(ct) {
    //         this.setOptions({
    //             maxDate: $('#to_date').val() ? new Date($(
    //                 '#to_date').val()) : false
    //         })
    //     },
    //     // timepicker: false
    // });
    // $('#to_date').datepicker({
    //     format: 'Y/m/d',
    //     minDate: ' -1970/01/02',
    //     onShow: function(ct) {
    //         this.setOptions({
    //             minDate: $('#from_date').val() ? $(
    //                 '#from_date').val() : ' -1970/01/02'
    //         })
    //         this.setOptions({
    //             minDate: $('#from_date').val() ? $(
    //                 '#from_date').val() : false
    //         })
    //     },
    //     timepicker: false
    // });

    $('#to_date').on('change', function() {
        // alert('hii');
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        // alert(from_date);
        // alert(to_date);
        var dateAr = from_date.split('-');
        var dateAr1 = to_date.split('-');
        var new_from_date = dateAr[1] + '/' + dateAr[0] + '/' + dateAr[2];
        var new_to_date = dateAr1[1] + '/' + dateAr1[0] + '/' + dateAr1[2];
        // alert(new_from_date)
        // alert(new_to_date)
        var format_form_date = new Date(new_from_date)
        var format_to_date = new Date(new_to_date)

        var days = Math.round((format_to_date - format_form_date) / (1000 * 60 * 60 * 24));
        // alert(days);

        if (days != "NaN") {
            var data = "Total Nights : " + days;
            $('#totalNightsB').empty();
            $('#totalNightsB').append(data);
        }

    })
});
</script>
@endsection
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
                                <input type="text" hidden name="setp0" id="setp0" value="Y">
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
                                <input type="text" hidden name="setp1" id="setp1" value="Y">
                                <div id="availableRoomNo">
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>No. of Room</label>
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
                                                <input type="checkbox" class="form-check-input" name="catering_service"
                                                    id="catering_service" value="Y">
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
                            <h3>Guest</h3>
                            <section>
                                <h3>Guest Details</h3>
                                <input type="text" hidden name="setp2" id="setp2" value="Y">
                                <div class="form-check" id="passengerDetailsDiv">

                                </div>
                            </section>
                            <h3>Price</h3>
                            <section>
                                <h3>Price Details</h3>
                                <input type="text" hidden name="setp3" id="setp3" value="Y">
                                <div id="priceDetailsDiv">

                                </div>
                            </section>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- start model -->
    <div class="text-center">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Click for
            demo<i class="mdi mdi-play-circle ml-1"></i></button>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Preview Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <div>Location: <span id="prvlocation"></span></div>
                        </div>
                        <div class="col-sm-4">
                            <div>Room Type: <span id="prvroom_type"></span></div>
                        </div>
                        <div class="col-sm-3">
                            <div>Check In Date: <span id="prvcheckin_date"></span></div>
                        </div>
                        <div class="col-sm-3">
                            <div>Check Out Date: <span id="prvcheckout_date"></span></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div>Room No: <span id="prvroom_nos"></span></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div>No. of Room: <span id="prvno_of_room"></span></div>
                        </div>
                        <div class="col">
                            <div>No. of Adult: <span id="prvno_of_adult"></span></div>
                        </div>
                        <div class="col">
                            <div>No. of Child: <span id="prvno_of_child"></span></div>
                        </div>
                        <div class="col">
                            <div>Catering Service: <span id="prvCatering_Service"></span></div>
                        </div>
                    </div>

                    <div id="prvguestdetails">
                        
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <div>Per Room / Per Night: <span id="prvper_room_per_night"></span></div>
                        </div>
                        <div class="col">
                            <div>Total no of Rooms: <span id="prvtot_no_of_room"></span></div>
                        </div>
                        <div class="col">
                            <div>Total no of Nights: <span id="prvtot_no_of_night"></span></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div>Amount: <span id="prvamount"></span></div>
                        </div>
                        <div class="col">
                            <div>CGST : <span id="prvcgst_rate"></span></div>
                        </div>
                        <div class="col">
                            <div>SGST: <span id="prvsgst_rate"></span></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div>Net Amount: <span id="prvnet_amount"></span></div>
                        </div>
                        <div class="col">
                            <div>Discount : <span id="prvdiscount_price"></span></div>
                        </div>
                        <div class="col">
                            <div>Total Amount: <span id="prvtotal_amount"></span></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div>Remark: <span id="prvremark"></span></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="mdlsubmit" name="mdlsubmit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end model -->
</div>


@endsection

@section('script')


<script src="{{ asset('public/js/modal-demo.js') }}"></script>

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
        labels: {
            finish: "Preview",
        },
        // onStepChanged: function(event, currentIndex, newIndex) {
        //     alert("Next !!!!"+currentIndex);
        // },
        onStepChanging: function(event, currentIndex, newIndex) {
            // alert("Next !!!!" + newIndex);
            // window.history.back();
            var location_id = $('#location_id').val();
            var room_type_id = $('#room_type_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (newIndex == 0) {
                return true;
            } else if (newIndex == 1) {
                // alert("step 1")
                var maxbooking_date = '<?php echo $advance_book_date;?>';
                // alert(maxbooking_date)
                var dateAr = maxbooking_date.split('-');
                var dateAr1 = from_date.split('-');
                var maxbooking_date_format = dateAr[2] + '/' + dateAr[1] + '/' + dateAr[0];
                var from_date_format = dateAr1[1] + '/' + dateAr1[0] + '/' + dateAr1[2];
                // alert("maximum : " + maxbooking_date_format)
                // alert("select : " + from_date_format)
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
                } else if (new Date(from_date_format) >= new Date(maxbooking_date_format)) {
                    // alert(maxbooking_date )
                    alert('Select booking date below ' + new Date(maxbooking_date_format))
                    return false;
                }
                // alert(room_type_id);
                var setp1 = $("#setp1").val();
                if (setp1 == 'Y') {
                    $("#setp1").val();
                    $("#setp1").val('N');
                    Available_Room(location_id, room_type_id, from_date, to_date);
                }
                // Available_Room(location_id, room_type_id, from_date, to_date);
                return true;
            } else if (newIndex == 2) {
                var totalnoroom = $(".roomNoChecked:checked").length;
                var max_person_number = $('#max_person_number').val();
                var max_child_number = $('#max_child_number').val();

                // alert(x)
                if (totalnoroom == 0) {
                    alert('Please select any room No');
                    return false;
                }

                for (let index = 1; index <= totalnoroom; index++) {
                    var adult_no = $("#adult_no_" + index).val();
                    var child_no = $("#child_no_" + index).val();
                    if (adult_no == 0) {
                        alert('Enter adult No room ' + index);
                        return false;
                    } else if (adult_no > max_person_number) {
                        alert('Enter maximum adult No ' + max_person_number + ' for room ' + index);
                        return false;
                    } else if (child_no > max_child_number) {
                        alert('Enter maximum child No ' + max_person_number + ' for room ' + index);
                        return false;
                    }

                    $('#adult_no_' + index).on('change', function() {
                        // alert('hii')
                        // $("#setp1").val();
                        // $("#setp1").val('Y');
                        $("#setp2").val();
                        $("#setp2").val('Y');
                        $("#setp3").val();
                        $("#setp3").val('Y');
                    });

                }
                var total_room_no = $('#total_room_no').val();
                var adult_no = $('#adult_no').val();
                var child_no = $('#child_no').val();

                var setp2 = $("#setp2").val();
                if (setp2 == 'Y') {
                    $("#setp2").val();
                    $("#setp2").val('N');
                    PassengerDetails(total_room_no, adult_no, child_no);
                }
                return true;
                // return 0;
            } else if (newIndex == 3) {
                // alert(currentIndex+"hii")
                // alert('hello')
                var catering_service = $("#catering_service:checked").val();
                // alert(catering_service)
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

                    var child_first_name = $('#child_first_name' + i).val();
                    var child_last_name = $('#child_last_name' + i).val();
                    if (first_name == '') {
                        alert("Adult " + (i + 1) + " first name can not be blank");
                        return false;
                    } else if (last_name == '') {
                        alert("Adult " + (i + 1) + " last name can not be blank");
                        return false;
                    } else if (child_first_name == '') {
                        alert("Child " + (i + 1) + " last name can not be blank");
                        return false;
                    } else if (child_last_name == '') {
                        alert("Child " + (i + 1) + " last name can not be blank");
                        return false;
                    }
                }
                var post_code = $('#post_code').val();
                var address = $('#address').val();
                var state = $('#state').val();
                var country = $('#country').val();
                var email = $('#email').val();
                var contact = $('#contact').val();
                var post_code_regex = /^(\d{4}|\d{6})$/;
                var phone_regex = /^(\+\d{1,3}[- ]?)?\d{10}$/;
                var email_regex =
                    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (post_code == '') {
                    alert('Enter post code')
                    return false;
                } else if (!post_code_regex.test(post_code)) {
                    alert('Enter valid post code')
                    return false;
                } else if (address == '') {
                    alert('Enter address')
                    return false;
                } else if (state == '') {
                    alert('Enter state')
                    return false;
                } else if (email == '') {
                    alert('Enter email')
                    return false;
                } else if (!email_regex.test(email)) {
                    alert('Enter valid email')
                    return false;
                } else if (contact == '') {
                    alert('Enter mobile no')
                    return false;
                } else if (!phone_regex.test(contact)) {
                    alert('Enter valid mobile no')
                    return false;
                }

                var setp3 = $("#setp3").val();
                if (setp3 == 'Y') {
                    $("#setp3").val();
                    $("#setp3").val('N');
                    PriceDetails(location_id, room_type_id, totalnoroom, from_date, to_date,
                        catering_service);
                }
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
            var location_id = $('#location_id').val();
            var room_type_id = $('#room_type_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            // var totalnoroom = $(".roomNoChecked:checked").val();
            var rooms_no = [];
            $('.roomNoChecked:checked').each(function(i) {
                rooms_no[i] = $(this).val();
            });
            var total_room_no = $('#total_room_no').val();
            var catering_service = $("#catering_service:checked").val();
            // alert(rooms_no)
            PreviewDetails(location_id, room_type_id, from_date, to_date, rooms_no, total_room_no,
                catering_service);
            // $("#exampleModal").show();
            $('#exampleModal').modal('show');

            // $("#Booking_form").submit();
        }
    });

    $('#mdlsubmit').on('click', function() {
        // alert('hii')
        $("#Booking_form").submit();
    });

    $('#location_id').on('change', function() {
        // alert('hii');
        $("#setp1").val();
        $("#setp1").val('Y');
        $("#setp2").val();
        $("#setp2").val('Y');
        $("#setp3").val();
        $("#setp3").val('Y');

        var location_id = $('#location_id').val();
        // alert(location_id);
        RoomTypeAjax(location_id);

    })
    $('#room_type_id').on('change', function() {
        $("#setp1").val();
        $("#setp1").val('Y');
        $("#setp2").val();
        $("#setp2").val('Y');
        $("#setp3").val();
        $("#setp3").val('Y');
    });
    // discount
    // $('#discount_price').on('change', function() {
    //     // alert('hii');
    //     var discount = $('#discount_price').val();
    //     alert(discount);

    // })
});

function PreviewDetails(location_id, room_type_id, from_date, to_date, rooms_no, total_room_no, catering_service) {
    // alert(rooms_no);
    var adult_no_count = 0;
    var child_no_count = 0;
    for (let index = 1; index <= total_room_no; index++) {
        adult_no_count = Number(adult_no_count) + Number($('#adult_no_' + index).val());
        child_no_count = Number(child_no_count) + Number($('#child_no_' + index).val());
    }
    $.ajax({
        url: "{{route('admin.previewDetailsAjax')}}",
        method: "POST",
        data: {
            location_id: location_id,
            room_type_id: room_type_id,
            from_date: from_date,
            to_date: to_date,
        },
        success: function(data) {
            alert(data);
            var obj = JSON.parse(data);
            var location = obj.location;
            var room_type = obj.room_type;

            var adultchilddata='';
            var adultdata='';
            for (let i = 0; i < adult_no_count; i++) {
                var first_name = $('#adt_first_name' + i).val();
                var middle_name = $('#adt_middle_name' + i).val();
                var last_name = $('#adt_last_name' + i).val();
                adultdata +='<div class="form-group row"><div class="col-sm-12"><div>Adult '+ (i + 1) +'</div></div></div><div class="form-group row">'
                            +'<div class="col"><div>First Name: '+first_name+'</div></div>'
                            +'<div class="col"><div>Middle Name: '+middle_name+'</div></div>'
                            +'<div class="col"><div>Last Name: '+last_name+'</div></div></div>';
            }

            var childdata='';
            for (let j = 0; j < child_no_count; j++) {
                var child_first_name = $('#child_first_name' + j).val();
                var child_middle_name = $('#child_middle_name' + j).val();
                var child_last_name = $('#child_last_name' + j).val();
                var age = $('#age' + j).val();
                adultdata +='<div class="form-group row"><div class="col-sm-12"><div>Child '+ (j + 1) +'</div></div></div><div class="form-group row">'
                            +'<div class="col"><div>First Name: '+child_first_name+'</div></div>'
                            +'<div class="col"><div>Middle Name: '+child_middle_name+'</div></div>'
                            +'<div class="col"><div>Last Name: '+child_last_name+'</div></div></div>'
                            +'<div class="col"><div>Age: '+age+'</div></div></div>';
            }
            adultchilddata= adultdata + childdata
            // $('#availableRoomNo').empty();
            // $("#availableRoomNo").html(data);
            // <div class="form-group row">
            //         </div>
            // prvguestdetails
            $("#prvguestdetails").empty();
            $("#prvguestdetails").append(adultchilddata);

            $("#prvlocation").empty();
            $("#prvlocation").append(location);

            $("#prvroom_type").empty();
            $("#prvroom_type").append(room_type);

            $("#prvcheckin_date").empty();
            $("#prvcheckin_date").append(from_date);

            $("#prvcheckout_date").empty();
            $("#prvcheckout_date").append(to_date);

            $("#prvroom_nos ").empty();
            $("#prvroom_nos").append(rooms_no);
            $("#prvno_of_room").empty();
            $("#prvno_of_room").append($('#total_room_no').val());
            $("#prvno_of_adult").empty();
            $("#prvno_of_adult").append(adult_no_count);
            $("#prvno_of_child").empty();
            $("#prvno_of_child").append(child_no_count);
            $("#prvCatering_Service").empty();
            $("#prvCatering_Service").append(catering_service);
            $("#prvper_room_per_night").empty();
            $("#prvper_room_per_night").append($('#per_room_per_night').val());
            $("#prvtot_no_of_room").empty();
            $("#prvtot_no_of_room").append($('#tot_no_of_room').val());

            $("#prvtot_no_of_night").empty();
            $("#prvtot_no_of_night").append($('#tot_no_of_night').val());

            $("#prvamount").empty();
            $("#prvamount").append($('#amount').val());
            $("#prvcgst_rate").empty();
            $("#prvcgst_rate").append($('#cgst_rate').val());
            $("#prvsgst_rate").empty();
            $("#prvsgst_rate").append($('#sgst_rate').val());
            $("#prvnet_amount").empty();
            $("#prvnet_amount").append($('#net_amount').val());
            $("#prvdiscount_price").empty();
            $("#prvdiscount_price").append($('#discount_price').val());
            $("#prvtotal_amount").empty();
            $("#prvtotal_amount").append($('#total_amount').val());
            $("#prvremark").empty();
            $("#prvremark").append($('#remark').val());
        }
    });
}




function youFunction() {
    // alert('hii');
    var discount = $('#discount_price').val();
    var cal_total_amount = $('#cal_total_amount').val();

    var total_amount = cal_total_amount - discount;
    $("#total_amount").val()
    $("#total_amount").val(total_amount)
}
// $('.roomNoChecked').change(function() {
//     alert('hii')
//     // $('#textbox1').val($(this).is(':checked'));
//     var x = $(".roomNoChecked:checked").length;
//     $("#room_no").val()
//     $("#room_no").val(x)
// });


function Available_Room(location_id, room_type_id, from_date, to_date) {
    // alert(room_type_id);
    $("#roomPerson").empty();
    $("#total_room_no").val();
    $("#total_room_no").val(0);

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

function PriceDetails(location_id, room_type_id, totalnoroom, from_date, to_date, catering_service) {
    $.ajax({
        url: "{{route('admin.priceDetailsAjax')}}",
        method: "POST",
        data: {
            location_id: location_id,
            room_type_id: room_type_id,
            totalnoroom: totalnoroom,
            from_date: from_date,
            to_date: to_date,
            catering_service: catering_service,
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

            $("#setp1").val();
            $("#setp1").val('Y');
            $("#setp2").val();
            $("#setp2").val('Y');
            $("#setp3").val();
            $("#setp3").val('Y');
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

    var maxbooking_date = '<?php echo $advance_book_date;?>';
    var dateAr = maxbooking_date.split('-');
    var maxbooking_date_format = dateAr[1] + '/' + dateAr[2] + '/' + dateAr[0];
    // alert(maxbooking_date_format)
    var someDate = new Date();
    var numberOfDaysToAdd = 1;
    var result = someDate.setDate(someDate.getDate() + numberOfDaysToAdd);
    // alert(result);
    $("#from_date").datepicker({
        format: 'dd-mm-yyyy',
        // todayHighlight: true,
        orientation: 'top',
        autoclose: true,
        startDate: new Date(result),
        endDate: new Date(maxbooking_date_format)
    });
    $('#from_date').on('change', function() {
        $("#setp1").val();
        $("#setp1").val('Y');
        $("#setp2").val();
        $("#setp2").val('Y');
        $("#setp3").val();
        $("#setp3").val('Y');

        var from_date = $('#from_date').val();
        var dateAr1 = from_date.split('-');
        var from_date_format = dateAr1[1] + '/' + dateAr1[0] + '/' + dateAr1[2];
        var someDate1 = new Date(from_date_format);
        var result1 = someDate1.setDate(someDate1.getDate() + 1);
        $("#to_date").datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'top',
            // todayHighlight: true,
            autoclose: true,
            startDate: new Date(result1),
            endDate: new Date(maxbooking_date_format)
        });
    });

    // $("#to_date").datepicker({
    //     format: 'dd-mm-yyyy',
    //     orientation: 'top',
    //     todayHighlight: true,
    //     autoclose: true,
    //     startDate: new Date()
    // });

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
        $("#setp1").val();
        $("#setp1").val('Y');
        $("#setp2").val();
        $("#setp2").val('Y');
        $("#setp3").val();
        $("#setp3").val('Y');
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
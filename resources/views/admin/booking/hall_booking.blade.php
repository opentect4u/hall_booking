@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Hall Booking </h4>
                    <form id="Booking_form" name="Booking_form" action="{{route('admin.hallBookingConfirm')}}"
                        method="post" autocomplete="off">
                        @csrf
                        <div>
                            <h3>Search</h3>
                            <section>
                                <h3>Search</h3>
                                <input type="text" hidden name="setp1" id="setp1" value="Y">
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
                                        <label>Hall Type </label>
                                        <select name="room_type_id" id="room_type_id" required class="form-control">
                                            <option value=""> -- Select -- </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col date datepicker">
                                        <label>How many days</label>
                                        <input type="text" name="days" id="days" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div id="hallBookingDateDetails">

                                </div>

                            </section>
                            <h3>Rooms</h3>
                            <section>
                                <h3>Rooms</h3>
                                <input type="text" hidden name="setp2" id="setp2" value="Y">
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
                                    <div class="col">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="laptop_prajector"
                                                    id="laptop_prajector" value="Y">
                                                Laptop & Projector
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="sound_system"
                                                    id="sound_system" value="Y">
                                                Sound System
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="catering_service"
                                                    id="catering_service" value="Y">
                                                Catering Service
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <!-- <div class="col">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="food_charge"
                                                    id="food_charge" value="Y">
                                                Food Charge
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div> -->
                                </div>
                            </section>
                            <h3>Guest</h3>
                            <section>
                                <h3>Guest Details</h3>
                                <input type="text" hidden name="setp3" id="setp3" value="Y">
                                <div class="form-check" id="passengerDetailsDiv">
                                    <!-- <p class="card-description">Billing details</p> -->
                                    <!-- <div class="form-group row">
                                        <div class="col">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check" type="radio" id="individual"
                                                        name="customer_type_flag" value="I" checked required
                                                        class="form-control">
                                                    Individual
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check" type="radio" id="organisation"
                                                        name="customer_type_flag" value="O" required
                                                        class="form-control">Organisation
                                                    <i class="input-helper"></i></label>
                                            </div>

                                        </div>

                                    </div> -->
                                    <div class="form-group row">
                                        <div class="col">
                                            <label>First Name</label>
                                            <input type="text" name="adt_first_name" id="adt_first_name" required
                                                value="" placeholder="" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label>Middle Name</label>
                                            <input type="text" name="adt_middle_name" id="adt_middle_name" value=""
                                                placeholder="" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label>Last Name</label>
                                            <input type="text" name="adt_last_name" id="adt_last_name" required value=""
                                                placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <!-- <div id="organisationDiv"> -->
                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>GSTIN</label>
                                                <input type="text" name="GSTIN" class="form-control"
                                                    placeholder="Enter GSTIN">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>PAN</label>
                                                <input type="text" name="PAN" class="form-control"
                                                    placeholder="Enter PAN">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col">
                                            <div class="form-group">
                                                <label>TAN</label>
                                                <input type="text" name="TAN" class="form-control"
                                                    placeholder="Enter TAN">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Registration No.</label>
                                                <input type="text" name="RegistrationNo" class="form-control"
                                                    placeholder="Enter Registration No.">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                    <!-- <p class="card-description">Billing details</p> -->
                                    <div class="form-group row">
                                        <div class="col">
                                            <label>Pin code</label>
                                            <input type="text" name="post_code" id="post_code" placeholder="" required
                                                class="form-control">
                                        </div>
                                        <div class="col">
                                            <label>State</label>
                                            <select name="state" id="state" required class="form-control">
                                                <option value=""> -- Select State -- </option>
                                                @foreach($states as $state)
                                                <option value="{{$state->name}}">{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <label>Address</label>
                                            <textarea name="address" id="address" cols="30" rows="5" required
                                                class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <label>Email</label>
                                            <input type="email" name="email" id="email" placeholder="" required
                                                class="form-control">
                                        </div>
                                        <div class="col">
                                            <label>Contact</label>
                                            <input type="text" name="contact" id="contact" placeholder="" required
                                                class="form-control">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                    </div>
                                </div>
                            </section>
                            <h3>Price</h3>
                            <section>
                                <h3>Price Details</h3>
                                <input type="text" hidden name="setp4" id="setp4" value="Y">
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
    <!-- <div class="text-center">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Click for
            demo<i class="mdi mdi-play-circle ml-1"></i></button>
    </div> -->
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
                            <div>Hall Type: <span id="prvroom_type"></span></div>
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
                            <div>Hall No: <span id="prvroom_nos"></span></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <!-- <div class="col">
                            <div>No. of Room: <span id="prvno_of_room"></span></div>
                        </div>
                        <div class="col">
                            <div>No. of Adult: <span id="prvno_of_adult"></span></div>
                        </div>
                        <div class="col">
                            <div>No. of Child: <span id="prvno_of_child"></span></div>
                        </div> -->
                        <div class="col">
                            <div>Catering Service: <span id="prvCatering_Service"></span></div>
                        </div>
                        <div class="col">
                            <div>Laptop Projector: <span id="prvLaptop_Projector"></span></div>
                        </div>
                        <div class="col">
                            <div>Sound System: <span id="prvSound_System"></span></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <div>First Name: <span id="prvFirestName"></span></div>
                        </div>
                        <div class="col">
                            <div>Middle Name: <span id="prvMiddleName"></span></div>
                        </div>
                        <div class="col">
                            <div>Last Name: <span id="prvLastName"></span></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div>Pin code: <span id="prvpost_code"></span></div>
                        </div>
                        <div class="col">
                            <div>state: <span id="prvstate"></span></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div>Address: <span id="prvAddress"></span></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div>email: <span id="prvemail"></span></div>
                        </div>
                        <div class="col">
                            <div>contact: <span id="prvcontact"></span></div>
                        </div>
                    </div>
                    <div id="prvHallDetails">

                    </div>
                    <div class="form-group row">
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

<!-- Plugin js for this page -->
<script src="{{ asset('public/vendors/jquery-steps/jquery.steps.min.js') }}"></script>
<!-- <script src="{{ asset('public/vendors/jquery-validation/jquery.validate.min.js') }}"></script> -->
<!-- End plugin js for this page -->



<script>
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
            // alert("Next !!!!"+newIndex);
            var location_id = $('#location_id').val();
            var room_type_id = $('#room_type_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var days = $('#days').val();

            if (newIndex == 0) {
                return true;
            } else if (newIndex == 1) {

                // var maxbooking_date = '<?php echo $advance_book_date;?>';
                // var dateAr = maxbooking_date.split('-');
                // var dateAr1 = from_date.split('-');
                // var maxbooking_date_format = dateAr[2] + '/' + dateAr[1] + '/' + dateAr[0];
                // var from_date_format = dateAr1[1] + '/' + dateAr1[0] + '/' + dateAr1[2];
                // alert(days);
                var all_dates = $('#all_dates').val();

                if (location_id == '') {
                    alert('Select Location')
                    return false;
                } else if (room_type_id == '') {
                    alert('Select room type')
                    return false;
                }
                for (let k = 0; k < days; k++) {
                    var all_dates_ = $("#all_dates_" + k).val();
                    if (all_dates_ == '') {
                        alert('Select date')
                        return false;
                    }
                }
                // else if (from_date == '') {
                //     alert('Select from date')
                //     return false;
                // } else if (to_date == '') {
                //     alert('Select to date')
                //     return false;
                // } else if (new Date(from_date_format) >= new Date(maxbooking_date_format)) {
                //     // alert(maxbooking_date )
                //     alert('Select booking date below ' + new Date(maxbooking_date_format))
                //     return false;
                // }
                // alert(room_type_id);
                // alert(all_dates);
                var setp1 = $("#setp1").val();
                if (setp1 == 'Y') {
                    $("#setp1").val();
                    $("#setp1").val('N');
                    Available_Room(location_id, room_type_id, from_date, to_date);
                }
                // alert(room_type_id);
                // Available_Room(location_id, room_type_id, from_date, to_date);
                return true;
            } else if (newIndex == 2) {
                var adult_no = $('#adult_no').val();
                // var child_no = $('#child_no').val();
                var totalnoroom = $(".roomNoChecked:checked").length;
                var hall_ids = $(".roomNoChecked:checked").val();
                // alert(hall_ids)
                if (totalnoroom == 0) {
                    alert('Please select any Hall');
                    return false;
                } else if (totalnoroom > 1) {
                    alert('Please select any one Hall')
                    return false;
                }
                // else if (adult_no == '') {
                //     alert('Enter adult No')
                //     return false;
                // }
                // var setp2 = $("#setp2").val();
                // if (setp2 == 'Y') {
                //     $("#setp2").val();
                //     $("#setp2").val('N');
                //     PassengerDetails(total_room_no, adult_no, child_no);
                // }
                // PriceDetails(location_id, room_type_id, totalnoroom);
                return true;
                // return 0;
            } else if (newIndex == 3) {
                // alert(currentIndex+"hii")
                // alert('hello')
                var total_room_no = $('#total_room_no').val();
                var adult_no = $('#adult_no').val();
                var child_no = $('#child_no').val();

                var adt_first_name = $('#adt_first_name').val();
                var adt_last_name = $('#adt_last_name').val();
                var post_code = $('#post_code').val();
                var address = $('#address').val();
                var city = $('#city').val();
                var country = $('#country').val();
                var email = $('#email').val();
                var contact = $('#contact').val();
                var post_code_regex = /^(\d{4}|\d{6})$/;
                var phone_regex = /^(\+\d{1,3}[- ]?)?\d{10}$/;
                var email_regex =
                    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                if (adt_first_name == '') {
                    alert('Enter first name')
                    return false;
                } else if (adt_last_name == '') {
                    alert('Enter last name')
                    return false;
                } else if (post_code == '') {
                    alert('Enter address')
                    return false;
                } else if (!post_code_regex.test(post_code)) {
                    alert('Enter valid post code')
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

                var all_rooms_array = [];
                $('.roomNoChecked:checked').each(function(i) {
                    all_rooms_array[i] = $(this).val();
                });
                // var setp3 = $("#setp3").val();
                // if (setp3 == 'Y') {
                //     $("#setp1").val();
                //     $("#setp1").val('N');
                //     PriceDetails(location_id, room_type_id, all_rooms_array);
                // }
                // var all_dates = $('#all_dates').val();
                // alert(all_dates);
                var all_dates_array = [];
                for (let m = 0; m < days; m++) {
                    var date__ = $('#all_dates_' + m).val();
                    all_dates_array[m] = date__;
                }
                // alert(all_dates_array);

                var catering_service = $('#catering_service').val();
                var laptop_prajector = $('#laptop_prajector').val();
                var sound_system = $('#sound_system').val();
                PriceDetails(location_id, room_type_id, all_rooms_array, from_date, to_date,
                    catering_service, laptop_prajector, sound_system, all_dates_array);
                return true;
                // return 0;
            }
            // else if (newIndex == 4) {
            //     // alert(currentIndex)
            //     return true;
            //     // return 0;
            // }
            // var setp=$('#setp').val();
            // alert(setp)
            // return false;
        },
        onFinished: function(event, currentIndex) {
            // alert("Submitted !!!!" + currentIndex);
            var total_room_no = $('#total_room_no').val();
            var location_id = $('#location_id').val();
            var room_type_id = $('#room_type_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            // var totalnoroom = $(".roomNoChecked:checked").val();
            var rooms_no = [];
            $('.roomNoChecked:checked').each(function(i) {
                rooms_no[i] = $(this).val();
            });
            var catering_service = $("#catering_service:checked").val();
            var sound_system = $("#sound_system:checked").val();
            var laptop_prajector = $("#laptop_prajector:checked").val();
            // alert(rooms_no)

            PreviewDetails(location_id, room_type_id, from_date, to_date, rooms_no, total_room_no,
                catering_service, sound_system, laptop_prajector);
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
        $("#setp1").val();
        $("#setp1").val('Y');
        $("#setp2").val();
        $("#setp2").val('Y');
        $("#setp3").val();
        $("#setp3").val('Y');
        // alert('hii');
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


    $('#days').keypress(function(event) {
        if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
            event.preventDefault(); //stop character from entering input
        }
    });
    $("#days").on('change', function() {
        var days = $("#days").val();
        var advance_book_date = '<?php echo $advance_book_date;?>';
        // alert(days)
        // for (let o = 0; o < days; o++) {
        // }
        $.ajax({
            url: "{{route('admin.hallBookingDateAjax')}}",
            method: "POST",
            data: {
                days: days,
                advance_book_date: advance_book_date,
            },
            success: function(data) {
                // alert(data)
                $("#hallBookingDateDetails").empty();
                $("#hallBookingDateDetails").append(data);
            }
        });
    })


    $('#organisationDiv').hide();
    $('input:radio[name="customer_type_flag"]').change(function() {
        // alert($(this).val())
        if ($(this).val() == 'I') {
            $('#organisationDiv').hide();
        } else {
            $('#organisationDiv').show();
        }
    });
});



function PreviewDetails(location_id, room_type_id, from_date, to_date, rooms_no, total_room_no, catering_service,
    sound_system, laptop_prajector) {
    // alert(total_room_no);

    $.ajax({
        url: "{{route('admin.hallpreviewDetailsAjax')}}",
        method: "POST",
        data: {
            location_id: location_id,
            room_type_id: room_type_id,
            from_date: from_date,
            to_date: to_date,
            rooms_no: rooms_no,
        },
        success: function(data) {
            // alert(data);
            var obj = JSON.parse(data);
            var location = obj.location;
            var room_type = obj.room_type;
            var rooms = obj.rooms;

            if (catering_service == 'Y') {
                var catering_service_data = "Yes";
            } else {
                var catering_service_data = "No";
            }
            if (sound_system == 'Y') {
                var sound_system_data = "Yes";
            } else {
                var sound_system_data = "No";
            }
            if (laptop_prajector == 'Y') {
                var laptop_prajector_data = "Yes";
            } else {
                var laptop_prajector_data = "No";
            }

            var adultchilddata = '';
            for (let index = 0; index < total_room_no; index++) {
                // const element = array[index];
                // alert(index)
                var book_flag = $("#book_flag_" + index).val();
                if (book_flag == 'H') {
                    var book_flag_data = "Hourly";
                }
                var per_room_per_night = $("#per_room_per_night_" + index).val();
                var tot_no_of_night = $("#tot_no_of_night_" + index).val();
                var amount = $("#amount_" + index).val();
                var cgst_rate = $("#cgst_rate_" + index).val();
                var sgst_rate = $("#sgst_rate_" + index).val();
                var net_amount = $("#net_amount_" + index).val();
                adultchilddata +=
                    // '<div class="form-group row"><div>Hall : '+ ( index + 1) +' </div></div>'+
                    '<div class="form-group row"><div class="col"><div>Per Room / Per ' + book_flag_data +
                    ' : ' + per_room_per_night + '</div></div>' +
                    '<div class="col"><div>Total no of ' + book_flag_data + ' : ' + tot_no_of_night +
                    '</div></div>' +
                    '<div class="col"><div>Amount : ' + amount + '</div></div></div>' +
                    '<div class="form-group row"><div class="col"><div>CGST : ' + cgst_rate +
                    '</div></div>' +
                    '<div class="col"><div>SGST : ' + sgst_rate + '</div></div>' +
                    '<div class="col"><div>Net Amount : ' + net_amount + '</div></div></div>'
            }

            $("#prvHallDetails").empty();
            $("#prvHallDetails").append(adultchilddata);

            $("#prvlocation").empty();
            $("#prvlocation").append(location);
            $("#prvroom_type").empty();
            $("#prvroom_type").append(room_type);
            $("#prvcheckin_date").empty();
            $("#prvcheckin_date").append(from_date);
            $("#prvcheckout_date").empty();
            $("#prvcheckout_date").append(to_date);
            $("#prvroom_nos ").empty();
            $("#prvroom_nos").append(rooms);
            $("#prvno_of_room").empty();
            // $("#prvno_of_room").append(total_room_no);
            // $("#prvno_of_adult").empty();

            $("#prvCatering_Service").empty();
            $("#prvCatering_Service").append(catering_service_data);
            $("#prvLaptop_Projector").empty();
            $("#prvLaptop_Projector").append(laptop_prajector_data);
            $("#prvSound_System").empty();
            $("#prvSound_System").append(sound_system_data);

            $("#prvFirestName").empty();
            $("#prvFirestName").append($('#adt_first_name').val());
            $("#prvMiddleName").empty();
            $("#prvMiddleName").append($('#adt_middle_name').val());
            $("#prvLastName").empty();
            $("#prvLastName").append($('#adt_last_name').val());
            $("#prvpost_code").empty();
            $("#prvpost_code").append($('#post_code').val());
            $("#prvstate").empty();
            $("#prvstate").append($('#state').val());
            $("#prvAddress").empty();
            $("#prvAddress").append($('#address').val());
            $("#prvemail").empty();
            $("#prvemail").append($('#email').val());
            $("#prvcontact").empty();
            $("#prvcontact").append($('#contact').val());

            $("#prvdiscount_price").empty();
            $("#prvdiscount_price").append($('#discount_price').val());
            $("#prvtotal_amount").empty();
            $("#prvtotal_amount").append($('#total_amount').val());
            $("#prvremark").empty();
            $("#prvremark").append($('#remark').val());
        }
    });
}

// $('.roomNoChecked').change(function() {
//     alert('hii')
//     // $('#textbox1').val($(this).is(':checked'));
//     var x = $(".roomNoChecked:checked").length;
//     $("#room_no").val()
//     $("#room_no").val(x)
// });

function youFunction(advance_payment) {
    // alert('hii');
    var discount = $('#discount_price').val();
    var cal_total_amount = $('#cal_tot_total_amount').val();

    var total_amount = cal_total_amount - discount;
    $("#total_amount").val()
    $("#total_amount").val(total_amount)

    var ccc = (total_amount * advance_payment) / 100;
    var divdata = '<div class="col-sm-6"><div class="form-check"><label class="form-check-label">' +
        '<input type="radio" class="form-check-input" name="payment" id="payment_advance"value="' + ccc +
        '" checked="">Advance Payment (' + ccc + ')<i class="input-helper"></i></label></div></div>' +
        '<div class="col-sm-6"><div class="form-check"><label class="form-check-label">' +
        '<input type="radio" class="form-check-input" name="payment" id="payment_full" value="' + total_amount +
        '">Full Payment (' + total_amount + ')<i class="input-helper"></i></label></div>' +
        '</div><div class="col-sm-6"></div>'

    $("#paymentDiv").empty()
    $("#paymentDiv").append(divdata)

    // $("#payment_advance").val();
    // $("#payment_advance").val(ccc);
    // $("#payment_full").val();
    // $("#payment_full").val(total_amount);

    // // $("#payment_fullSpan").empty()
    // // $("#payment_fullSpan").append(ccc)
    // // $("#payment_advanceSpan").empty()
    // // $("#payment_advanceSpan").append(total_amount)
}


function Available_Room(location_id, room_type_id, from_date, to_date) {
    // alert(room_type_id);
    $("#roomPerson").empty();
    $("#total_room_no").val();
    $("#total_room_no").val(0);
    $.ajax({
        url: "{{route('admin.searchhallAjax')}}",
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

function PriceDetails(location_id, room_type_id, all_rooms_array, from_date, to_date, catering_service,
    laptop_prajector, sound_system, all_dates_array) {
    var days = $('#days').val();
    // alert(days)
    $.ajax({
        url: "{{route('admin.hallpriceDetailsAjax')}}",
        method: "POST",
        data: {
            location_id: location_id,
            room_type_id: room_type_id,
            all_rooms_array: all_rooms_array,
            from_date: from_date,
            to_date: to_date,
            catering_service: catering_service,
            laptop_prajector: laptop_prajector,
            sound_system: sound_system,
            all_dates_array: all_dates_array,
            days: days
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
@extends('common.master')
@section('content')


<section class="bannerSlickSlider">
    <section class="bannerHottel">
        <div class="bannerHottelmain">
            <section class="wrapper bannerForm">
                <section class="col-sm-6">
                    <div class="bannerFormBox">
                        <div class="tab-slider--nav">
                            <ul class="tab-slider--tabs">
                                <li class="tab-slider--trigger"><a href="#" rel="tab1" class="active">Accommodation</a>
                                </li>
                                <li class="tab-slider--trigger"><a href="#" rel="tab2">Hall Booking</a></li>
                            </ul>
                        </div>
                        <div class="tab-slider--container">
                            <div id="tab1" class="tab-slider--body">
                                <div class="bannerFormBoxForm">
                                    <form name="Accommodation" method="get" action="{{route('searchRoom')}}"
                                        autocomplete="off">
                                        <!-- <div class="col-sm-12 fieldCus">
                                            <label>Search</label>
                                            <input name="" type="search">
                                        </div> -->

                                        <div class="col-sm-6 fieldCus float-left">
                                            <label>Location</label>
                                            <select name="location_id" id="location_id" required>
                                                <option value=""> -- Select -- </option>
                                                @foreach($locations as $location)
                                                <option value="{{$location->id}}">{{$location->location}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-6 fieldCus float-left">
                                            <label>Room Type</label>
                                            <select name="room_type_id" id="room_type_id" required>
                                                <option value=""> -- Select -- </option>
                                            </select>
                                        </div>

                                        <div class="col-sm-6 fieldCus float-left">
                                            <label>Check In Date</label>
                                            <input type="text" name="checkInDate" class="form-control" id="checkInDate"
                                                placeholder="dd-mm-yyyy" required />
                                        </div>

                                        <div class="col-sm-6 fieldCus float-left">
                                            <label>Check Out Date</label>
                                            <input type="text" name="checkOutDate" class="form-control"
                                                id="checkOutDate" placeholder="dd-mm-yyyy" required />
                                        </div>
                                        <!-- <div class="col-sm-12 fieldCus float-left">
                                            <label>Room No</label>
                                            <select name="rooms" id="rooms">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div> -->

                                        <input type="text" hidden name="max_person_number" id="max_person_number"
                                            value="">
                                        <input type="text" hidden name="max_child_number" id=" max_child_number"
                                            value="">

                                        <div class="col-sm-12 fieldCus">
                                            <label>Room & Guests</label>
                                            <div class="roomGuestField">
                                                <input name="" type="text" id="roomAdultSelect"
                                                    placeholder="1 Room, 1 Adult" readonly value="1 Room, 1 Adult">
                                                <div id="hotel_traveller_selection" style="display: none;">
                                                    <div class="row m-0">
                                                        <div class="col-12 px-2">
                                                            <div class="form-group">
                                                                <label>Room</label>
                                                                <select name="rooms" id="rooms" class="custom-select">
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <!-- <option value="3">3</option> -->
                                                                    <!-- <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-0 showRoomOnclick" id="roomAndGuestDiv">
                                                    </div>
                                                    <div class="row m-0">
                                                        <!-- <br> -->
                                                        <div class="col-12 px-2">
                                                            <div class="form-group">
                                                                <input type="button" name="" id="hotel_buttonApply"
                                                                    class="btn btn-primary" value="Apply">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="col-sm-12 fieldCusBtn searchBtn">
                                            <input type="submit" id="accoSearch" value="Search">
                                            <!-- <input name="" type="button" value="Search Hotels"> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="tab2" class="tab-slider--body">
                                <div class="bannerFormBoxForm">

                                    <!-- <form action="{{route('hallSearch')}}" autocomplete="off">
                                        <div class="col-sm-6 fieldCus float-left">
                                            <label>Location</label>
                                            <select name="hall_location_id" id="hall_location_id" required>
                                                <option value=""> -- Select -- </option>
                                                @foreach($locations as $location)
                                                <option value="{{$location->id}}">{{$location->location}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-6 fieldCus float-left">
                                            <label>Hall Type</label>
                                            <select name="hall_room_type_id" id="hall_room_type_id" required>
                                                <option value=""> -- Select -- </option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 fieldCus float-left">
                                            <label>Hall No</label>
                                            <select name="hall_no" id="hall_no" required>
                                                <option value=""> -- Select -- </option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-sm-6 fieldCus float-left">
                                            <label>How many days</label>
                                            <select name="days" id="days">
                                                <option value="">--Select--</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                
                                            </select>
                                        </div>
                                        <div id="hallBookingalldates">

                                        </div>
                                       
                                        <div class="col-sm-12 fieldCusBtn searchBtn">
                                            <input type="submit" id="hallSearch" value="Search">
                                        </div>
                                    </form> -->
                                    <div class="contentCusNew">
            <ul>
                <li><span class="title">Conference Hall (301)</span> <span class="normal">6000/-</span> 	<span class="holiday">Holiday -7000/-</span></li>

                <li><span class="title">Conference Hall (305)</span> <span class="normal">7000/- </span> 	<span class="holiday">Holiday -8000/-</span></li>
                <li><span class="title">Conference Hall (201) 	</span> <span class="normal">6500/-</span> 	<span class="holiday">Holiday -7000/-</span></li>
                <li><span class="title">Auditorium (306) 	</span> <span class="normal">9000/-</span> 	<span class="holiday">Holiday -10000/-</span></li>

            </ul>
                                    
	<p>For Booking Helpline Number: 6292311219</p>
    </div>
	
	

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>
        <!-- <img src="{{ asset('public/user/images/bannerInner.jpg') }}" alt=""> -->
    </section>
</section>



<div class="innerContentSec">
    <div class="wrapper">
        <div class="col-sm-12 float-left innerContentTxt">
            <h1>The Organization</h1>
            <p>Cooperative Credit Institution has its glorious presence in the heart of Indian farmers for more than a
                century.&nbsp; In fact, very few of them can think beyond cooperative when there are any financial
                problems.&nbsp; It is an organization for the farmers, by the farmers and of the farmers.&nbsp; Amongst
                cooperative credit institutions short term cooperative credit institutions provide short term crop loan
                to the
                farmers, while the long term cooperative credit institutions meet the long term cooperative credit need
                to
                carry forward agriculture and allied activities.&nbsp; But the long term cooperative credit sector was
                necessitated as cooperative societies formed to provide short term credit were not in a position to
                extend
                loans to farmers so that they may liquidate their past debts, redeem their land and other assets from
                Unscrupulous Money Lenders.&nbsp; Loans provided by the short-term credit sector were not enough to
                enable
                farmers to improve upon their land and augment their income.&nbsp; It was felt that the long-term loans
                that
                farmers needed for the purposes would have to be made by a separate set of credit institutions.&nbsp;
                This
                realization led to formation of long-term cooperative credit sector.&nbsp; The first long term
                cooperative
                credit institution in the name of ‘Land Mortgage Bank’ was established in Punjab in 1920.&nbsp; In
                Bengal 5
                Land Mortgage Banks were established in 1934-35, of which Birbhum Land Mortgage Bank was one of them and
                the
                other four Banks were situated in the erstwhile east Pakistan.&nbsp; At the time of independence i.e. on
                15<sup>th</sup> August 1947 there were two Land Mortgage Banks in West Bengal, viz. Birbhum Land
                Mortgage Bank
                and Burdwan Land Mortgage Bank. With these two Long Term Cooperative Credit Institutions, West Bengal
                started
                its journey in the long-term cooperative credit sector.</p>
        </div>
    </div>
</div>

@endsection

@section('script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
    rel="stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
</script>
<script type="text/javascript">
var maxbooking_date = '<?php echo $advance_book_date;?>';
var dateAr = maxbooking_date.split('-');
var maxbooking_date_format = dateAr[1] + '/' + dateAr[2] + '/' + dateAr[0];
// alert(maxbooking_date_format)
var someDate = new Date();
var numberOfDaysToAdd = 1;
var result = someDate.setDate(someDate.getDate() + numberOfDaysToAdd);
$('#checkInDate').datepicker({
    // weekStart: 1,
    // daysOfWeekHighlighted: "6,0",
    autoclose: true,
    todayHighlight: false,
    format: 'dd-mm-yyyy',
    startDate: new Date(result),
    endDate: new Date(maxbooking_date_format)
});
// $('#checkInDate').datepicker("setDate", new Date());
$('#checkInDate').on('change', function() {

    var from_date = $('#checkInDate').val();
    var dateAr1 = from_date.split('-');
    var from_date_format = dateAr1[1] + '/' + dateAr1[0] + '/' + dateAr1[2];
    var someDate1 = new Date(from_date_format);
    var result1 = someDate1.setDate(someDate1.getDate() + 1);
    $("#checkOutDate").datepicker({
        format: 'dd-mm-yyyy',
        // orientation: 'top',
        // todayHighlight: true,
        todayHighlight: false,
        autoclose: true,
        startDate: new Date(result1),
        endDate: new Date(maxbooking_date_format)
    });

});
</script>

<script>
$(document).ready(function() {
    $('#location_id').on('change', function() {
        var location_id = $('#location_id').val();
        var code = 'R';
        RoomTypeAjax(location_id, code);
    });

    // room_type_id
    $('#room_type_id').on('change', function() {
        var location_id = $('#location_id').val();
        var room_type_id = $('#room_type_id').val();
        var code = 'R';
        MaxGuestDetails(location_id, room_type_id, code);
    });

    // hall_location_id
    $('#hall_location_id').on('change', function() {
        var location_id = $('#hall_location_id').val();
        var code = 'H';
        RoomTypeAjax(location_id, code);
    });
    

    // days
    $('#days').on('change', function() {
        var days = $('#days').val();
        HallBookingalldates(days);
    });

    // hotel_buttonApply
    $('#hotel_buttonApply').on('click', function() {
        var hotel_traveller_selection = document.getElementById("hotel_traveller_selection");
        if (hotel_traveller_selection.style.display === "none") {
            hotel_traveller_selection.style.display = 'block';
        } else {
            hotel_traveller_selection.style.display = 'none';
        }
    });

    // rooms
    var rooms = $('#rooms').val();
   // GuestDetailsFields(rooms)          Commented Date 26/12/2023
    $('#rooms').on('change', function() {
        var rooms = $('#rooms').val();
        var room_type_id = $('#room_type_id').val();
        // alert('hi')
        if(room_type_id == ''){
            alert('Please Select Room Type')
            $("select#rooms").val('1'); 
        }else{
        GuestDetailsFields(rooms,room_type_id);

        var roomAdultSelect = rooms + " Rooms, " + rooms + " Adult"
        $("#roomAdultSelect").val();
        $("#roomAdultSelect").val(roomAdultSelect);
        }
    });
    $('#room_type_id').on('change', function() {
        var rooms = $('#rooms').val();

        var room_type_id = $('#room_type_id').val();
        if(room_type_id != 1){
            $('#rooms').append($("<option></option>")
                    .attr("value", '3')
                    .text('3'));
        }else{
            $("#rooms option[value='3']").remove();
          
        }
        GuestDetailsFields(rooms,room_type_id);

        // var roomAdultSelect = rooms + " Rooms, " + rooms + " Adult"
        // $("#roomAdultSelect").val();
        // $("#roomAdultSelect").val(roomAdultSelect);
    });


    // hall_room_type_id
    $('#hall_room_type_id').on('change', function() {
        var hall_location_id = $('#hall_location_id').val();
        var hall_room_type_id = $('#hall_room_type_id').val();
        // alert('hii')
        // hall_no
        HallNoDetails(hall_location_id, hall_room_type_id);

    });

});


function RoomTypeAjax(location_id, code) {
    $.ajax({
        url: "{{route('bookingroomTypeAjax')}}",
        method: "POST",
        data: {
            location_id: location_id,
            code: code,
        },
        success: function(data) {
            // alert(data);
            // var obj=JSON.parse(data);
            if (code == 'R') {
                $('#room_type_id').empty();
                $("#room_type_id").html(data);
            } else if (code == 'H') {
                $('#hall_room_type_id').empty();
                $("#hall_room_type_id").html(data);
            }
        }
    });
}

function MaxGuestDetails(location_id, room_type_id, code) {
    $.ajax({
        url: "{{route('maxGuestDetailsAjax')}}",
        method: "POST",
        data: {
            location_id: location_id,
            room_type_id: room_type_id,
            code: code,
        },
        success: function(data) {
            // alert(data);
            var obj = JSON.parse(data);
            var max_person_number = obj.max_person_number;
            var max_child_number = obj.max_child_number;
            // $('#room_type_id').empty();
            // $("#room_type_id").html(data);

            $('#max_person_number').val();
            $('#max_person_number').val(max_person_number);
            $('#max_child_number').val();
            $('#max_child_number').val(max_child_number);
        }
    });
}

function HallBookingalldates(days) {
    // hallBookingalldates
    $.ajax({
        url: "{{route('hallbookingdatesAjax')}}",
        method: "POST",
        data: {
            days: days,
        },
        success: function(data) {
            // alert(data);
            // var obj=JSON.parse(data);

            $('#hallBookingalldates').empty();
            $("#hallBookingalldates").html(data);

        }
    });
}

function GuestDetailsFields(rooms,room_type_id) {
    // hallBookingalldates
   //  alert('tet')
    $.ajax({
        url: "{{route('guestDetailsFieldsAjax')}}",
        method: "POST",
        data: {
            rooms: rooms,room_type_id: room_type_id
        },
        success: function(data) {
            // alert(data);
            // var obj=JSON.parse(data);

            $('#roomAndGuestDiv').empty();
            $("#roomAndGuestDiv").html(data);

        }
    });
}

function HallNoDetails(hall_location_id, hall_room_type_id) {
    $.ajax({
        url: "{{route('hallNoDetailsAjax')}}",
        method: "POST",
        data: {
            hall_location_id: hall_location_id,
            hall_room_type_id: hall_room_type_id,
            code: 'H'
        },
        success: function(data) {
            // alert(data);
            // var obj=JSON.parse(data);
            $('#hall_no').empty();
            $("#hall_no").html(data);

        }
    });
}
</script>
@endsection
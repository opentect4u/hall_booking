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
                                                    placeholder="1 Room, 1 Adult">
                                                <div id="hotel_traveller_selection" style="display: none;">
                                                    <div class="row m-0">
                                                        <div class="col-12 px-2">
                                                            <div class="form-group">
                                                                <label>Room</label>
                                                                <select name="rooms" id="rooms" class="custom-select">
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 px-2" id="room1HeadingDiv">
                                                            <div class="form-group">
                                                                Room 1 Details
                                                            </div>
                                                        </div>
                                                        <div class="col-4 px-2">
                                                            <div class="form-group">
                                                                <label>Adults <small>(12+ yrs)</small></label>
                                                                <select name="room1_adults" id="room1_adults"
                                                                    class="custom-select">
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 px-2">
                                                            <div class="form-group">
                                                                <label>Child Age 1<small></small></label>
                                                                <select name="room1_child1" id="room1_child1"
                                                                    class="custom-select">
                                                                    <option>0</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 px-2">
                                                            <div class="form-group">
                                                                <label>Child Age 2 <small></small></label>
                                                                <select name="room1_child2" id="room1_child2"
                                                                    class="custom-select">
                                                                    <option>0</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <hr> -->
                                                        <div class="col-12 px-2" id="room2HeadingDiv">
                                                            <div class="form-group">
                                                                Room 2 Details
                                                            </div>
                                                        </div>
                                                        <div class="col-6 px-2" id="room2AdultDiv" data-room2-div="0">
                                                            <div class="form-group">
                                                                <label>Adults <small>(12+ yrs)</small></label>
                                                                <select name="room2_adults" id="room2_adults"
                                                                    class="custom-select">
                                                                    <option value="0">Adults</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 px-2" id="room2ChildDiv">
                                                            <div class="form-group">
                                                                <label>Child Age 1<small></small></label>
                                                                <select name="room2_child1" id="room2_child1"
                                                                    class="custom-select">
                                                                    <option>0</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 px-2" id="room2InfantDiv">
                                                            <div class="form-group">
                                                                <label>Child Age 2 <small></small></label>
                                                                <select name="room2_child2" id="room2_child2"
                                                                    class="custom-select">
                                                                    <option>0</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <br> -->
                                                        <div class="col-12 px-2" id="room3HeadingDiv">
                                                            <div class="form-group">
                                                                Room 3 Details
                                                            </div>
                                                        </div>
                                                        <div class="col-6 px-2" id="room3AdultDiv" data-room3-div="0">
                                                            <div class="form-group">
                                                                <label>Adults <small>(12+ yrs)</small></label>
                                                                <select name="room3_adults" id="room3_adults"
                                                                    class="custom-select">
                                                                    <option value="0">Adults</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 px-2" id="room3ChildDiv">
                                                            <div class="form-group">
                                                                <label>Child Age 1<small></small></label>
                                                                <select name="room3_child1" id="room3_child1"
                                                                    class="custom-select">
                                                                    <option>0</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                    <option value="13">13</option>
                                                                    <option value="14">14</option>
                                                                    <option value="15">15</option>
                                                                    <option value="16">16</option>
                                                                    <option value="16">17</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 px-2" id="room3InfantDiv">
                                                            <div class="form-group">
                                                                <label>Child Age 2 <small></small></label>
                                                                <select name="room3_child2"
                                                                    id="room3_child2" class="custom-select">
                                                                    <option>0</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                    <option value="13">13</option>
                                                                    <option value="14">14</option>
                                                                    <option value="15">15</option>
                                                                    <option value="16">16</option>
                                                                    <option value="16">17</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <br> -->
                                                        <div class="col-12 px-2" id="room4HeadingDiv">
                                                            <div class="form-group">
                                                                Room 4 Details
                                                            </div>
                                                        </div>
                                                        <div class="col-6 px-2" id="room4AdultDiv" data-room4-div="0">
                                                            <div class="form-group">
                                                                <label>Adults <small>(12+ yrs)</small></label>
                                                                <select name="room4_adults"
                                                                    id="room4_adults" class="custom-select">
                                                                    <option value="0">Adults</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 px-2" id="room4ChildDiv">
                                                            <div class="form-group">
                                                                <label>Child Age 1<small></small></label>
                                                                <select name="room4_child1" id="room4_child1"
                                                                    class="custom-select">
                                                                    <option>0</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                    <option value="13">13</option>
                                                                    <option value="14">14</option>
                                                                    <option value="15">15</option>
                                                                    <option value="16">16</option>
                                                                    <option value="16">17</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 px-2" id="room4InfantDiv">
                                                            <div class="form-group">
                                                                <label>Child Age 2 <small></small></label>
                                                                <select name="room4_child2"
                                                                    id="room4_child2" class="custom-select">
                                                                    <option>0</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                    <option value="13">13</option>
                                                                    <option value="14">14</option>
                                                                    <option value="15">15</option>
                                                                    <option value="16">16</option>
                                                                    <option value="16">17</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <br> -->
                                                        <div class="col-12 px-2">
                                                            <div class="form-group">
                                                                <input type="button" name="" id="hotel_buttonApply"
                                                                    class="btn btn-primary"
                                                                    onclick="hotel_traveller_selection();"
                                                                    value="Apply">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="col-sm-12 fieldCusBtn">
                                            <input type="submit" id="accoSearch" value="Search">
                                            <!-- <input name="" type="button" value="Search Hotels"> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="tab2" class="tab-slider--body">
                                <div class="bannerFormBoxForm">
                                    <form action="{{route('hallSearch')}}" autocomplete="off">
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
                                        <!-- <div class="col-sm-6 fieldCus float-left">
                                            <label>Hall No</label>
                                            <select name="hall_no" id="hall_no">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div> -->
                                        <div class="col-sm-6 fieldCus float-left">
                                            <label>How many days</label>
                                            <select name="days" id="days">
                                                <option value="">--Select--</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div id="hallBookingalldates">

                                        </div>


                                        <!-- <div class="col-sm-6 fieldCus float-left">
                                            <label>Check Out Date</label>
                                            <input type="date" name="checkOutDate">
                                        </div> -->

                                        <div class="col-sm-12 fieldCusBtn">
                                            <!-- <input name="" type="button" value="Search Hotels"> -->
                                            <input type="submit" id="hallSearch" value="Search">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>
        <img src="{{ asset('public/user/images/bannerInner.jpg') }}" alt="">
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
    
    $("#room2HeadingDiv").hide();
    $("#room2AdultDiv").hide();
    $("#room2ChildDiv").hide();
    $("#room2InfantDiv").hide();
    $("#room3HeadingDiv").hide();
    $("#room3AdultDiv").hide();
    $("#room3ChildDiv").hide();
    $("#room3InfantDiv").hide();
    $("#room4HeadingDiv").hide();
    $("#room4AdultDiv").hide();
    $("#room4ChildDiv").hide();
    $("#room4InfantDiv").hide();

    $('#location_id').on('change', function() {
        var location_id = $('#location_id').val();
        var code = 'R';
        RoomTypeAjax(location_id, code);
    })

    // room_type_id
    $('#room_type_id').on('change', function() {
        var location_id = $('#location_id').val();
        var room_type_id = $('#room_type_id').val();
        var code = 'R';
        MaxGuestDetails(location_id, room_type_id, code);
    })

    // hall_location_id
    $('#hall_location_id').on('change', function() {
        var location_id = $('#hall_location_id').val();
        var code = 'H';
        RoomTypeAjax(location_id, code);
    })

    // days
    $('#days').on('change', function() {
        var days = $('#days').val();
        HallBookingalldates(days);
    })
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

// function hotel_traveller_selection() {
//     var x = document.getElementById("hotel_traveller_selection");
//     if (x.style.display == "none") {
//         x.style.display = "block";
//     } else {
//         x.style.display = "none";
//     }
// }
</script>
@endsection
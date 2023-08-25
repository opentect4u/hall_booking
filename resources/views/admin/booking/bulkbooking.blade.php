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
                    <form id="Booking_form" name="Booking_form" action="{{route('admin.bulkBookingConfirm')}}" method="post"
                        autocomplete="off">
                        @csrf
                        <div>
                            <section>
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
                                        <label>Check In Date</label>
                                        <input type="date" name="from_date" id="fr_date" placeholder="DD-MM-YYYY" required
                                            class="form-control" min="<?=date('Y-m-d')?>">
                                    </div>
                                    <div class="col">
                                        <label>Check Out Date</label>
                                        <input type="date" name="to_date" id="to_date" placeholder="DD-MM-YYYY" required
                                            class="form-control" min="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day'));?>">
                                    </div>
                                </div>
                <div class="form-group row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Room/Hall Type</th>
                                <th style="width:50%;text-align:center">Room No.</th>
                                <th>
                                <button type="button" class="btn btn-success addAnotherrow"><i class="fa fa-plus">Start(+)</i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="intro2" class="tables">
                        </tbody>
					</table> 
                </div>
                                <h3>Guest Details</h3>
                                
        <div class="form-check" id="passengerDetailsDiv">                       
        <div class="form-group row">
            <div class="col">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check" type="radio" id="individual" name="customer_type_flag" value="I" checked="" required="">
                        Individual
                        <i class="input-helper"></i></label>
                </div>
            </div>
            <div class="col">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check" type="radio" id="organisation" name="customer_type_flag" value="O" required="">Organisation
                        <i class="input-helper"></i></label>
                </div>
            </div>
        </div>                    
        <div class="form-group row">
            <div class="col">
                <label>First Name</label>
                <input type="text" name="adt_first_name" id="adt_first_name0" required="" value="" placeholder="" class="form-control">
            </div>
            <div class="col">
                <label>Middle Name</label>
                <input type="text" name="adt_middle_name" id="adt_middle_name0" value="" placeholder="" class="form-control">
            </div>
            <div class="col">
                <label>Last Name</label>
                <input type="text" name="adt_last_name" id="adt_last_name0"  value="" placeholder="" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label>Total Adult <span style="color:red">*</span></label>
                <input type="text" name="adult_no" id="adult_no" required="" value="" placeholder="" class="form-control" required>
            </div>
            <div class="col">
                <label>Total Child</label>
                <input type="text" name="child_no" id="child_no" value="0" placeholder="" class="form-control">
            </div>
        
        </div>
            <div id="organisationDiv">
                <div class="form-group row">
                    <div class="col">
                        <div class="form-group">
                            <label>GSTIN</label>
                            <input type="text" name="GSTIN" class="form-control" placeholder="Enter GSTIN">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>PAN</label>
                            <input type="text" name="PAN" class="form-control" placeholder="Enter PAN">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <div class="form-group">
                            <label>TAN</label>
                            <input type="text" name="TAN" class="form-control" placeholder="Enter TAN">
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
            </div>


            <div class="form-group row">
            <div class="col">
                <label>Pin Code 
                    <span style="color:red">*</span>
            </label>
                <input type="text" name="post_code" id="post_code" placeholder=""  required class="form-control">
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
                    <label>Address
                        <span style="color:red">*</span>
                    </label>
                    <textarea name="address" id="address" cols="30" rows="3" required  class="form-control"></textarea>
                    <!-- <input type="text" name="address" id="address" placeholder="" required class="form-control"> -->
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label>Email<span style="color:red">*</span></label>
                    <input type="email" name="email" id="email" placeholder="" required class="form-control">
                </div>
                <div class="col">
                    <label>Contact
                        <span style="color:red">*</span>
                    </label>
                    <input type="number" name="contact" id="contact" placeholder="" required class="form-control">
                </div>
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
                                <div>
                                <button type="submit" id="submit" name="submit" class="btn btn-success">Submit</button>
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
                } 
                var setp1 = $("#setp1").val();
                if (setp1 == 'Y') {
                    $("#setp1").val();
                    $("#setp1").val('N');
                    Available_Room(location_id, room_type_id, from_date, to_date);
                }
                
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
                    } 
                    // else if (last_name == '') {
                    //     alert("Adult " + (i + 1) + " last name can not be blank");
                    //     return false;
                    // } 
                    else if (child_first_name == '') {
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
                    alert('Enter pin code')
                    return false;
                } else
                if (!post_code_regex.test(post_code)) {
                    alert('Enter valid pin code')
                    return false;
                } else if (address == '') {
                    alert('Enter address')
                    return false;
                } else if (state == '') {
                    alert('Enter state')
                    return false;
                } 
                else if (email == '') {
                    alert('Enter email')
                    return false;
                } else if (!email_regex.test(email)) {
                    alert('Enter valid email')
                    return false;
                } 
                else if (contact == '') {
                    alert('Enter mobile no')
                    return false;
                } 
                // else if (!phone_regex.test(contact)) {
                //     alert('Enter valid mobile no')
                //     return false;
                // }
                else if(contact.length < 10){
                   alert('Enter valid mobile no, range from 10 to 12 digit')
                   return false;
                }
                else if(contact.length > 12){
                    alert('Enter valid mobile no, range from 10 to 12 digit')
                   return false;
                }
                var setp3 = $("#setp3").val();
                if (setp3 == 'Y') {
                    $("#setp3").val();
                    $("#setp3").val('N');
                    PriceDetails(location_id, room_type_id, totalnoroom, from_date, to_date,
                        catering_service);
                }
                console.log(contact.length);
                return true;
            } else if (newIndex == 4) {
                // alert(currentIndex)
                return true;
                // return 0;
            }
           
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

           
        }
    });

    $('#mdlsubmit').on('click', function() {
     
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
            // alert(data);
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
    
    var discount = $('#discount_price').val();
    var amount   = $('#amount').val();
    var cal_total_amount = $('#net_amount').val();
    var newamt = amount-(parseFloat((amount*discount)/100));
    var cgst   =   parseFloat((newamt*$('#crate').val())/100);
    $("#total_amount").val();
    $("#taxable").val(newamt);
    $("#cgst").val(cgst);
    $("#sgst").val(cgst);
    $("#total_amount").val(newamt+cgst+cgst);
}



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
    $.ajax({
        url: "{{route('admin.passengerDetailsAjax')}}",
        method: "POST",
        data: {
            total_room_no: total_room_no,
            adult_no: adult_no_count,
            child_no: child_no_count,
        },
        success: function(data) {
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

});

$( document ).ready(function() {
    $("#intro2").on('change','.accommodation',function(){ 

        var row = $(this).closest('tr');
        var location_id =$('#location_id').val()
        var from_date =$('#fr_date').val()
        var to_date =$('#to_date').val()
  
    $.ajax({
        url: "{{route('admin.bulkSearchaccomodation')}}",
        method: "POST",
        data: {
            location_id: location_id,
            room_type_id: $(this).val(),
            from_date: from_date,
            to_date: to_date,
        },
        success: function(data) {
        
            //row.find(".room_no").html(data);
            row.find('td:eq(1)').html(data);
           // row.eq(1).html(data);

        }
    });
})
})
  var count = 1 ;
  


$('.addAnotherrow').click(function(){
	
    var location_id = $('#location_id').val();
    var fr_date = $('#fr_date').val();
    var to_date = $('#to_date').val();
        if(location_id > 0 && fr_date != '' &&  to_date != ''){
            $("#fr_date").attr('readonly', 'readonly');
            $("#to_date").attr('readonly', 'readonly');
            $.ajax({
                url: "{{route('admin.getroomtypebylocation')}}",
                method: "POST",
                    data: {
                        location_id: location_id
                    },
                success: function(data) {

                    var string = '<option value="">Select Room Type</option>';
				    $.each(JSON.parse(data), function( index, value ){
					string += '<option value="' + value.id + '">' + value.type +'</option>';
				    })

                let row = '<tr>' +
			    '<td>'+ 
				'<select name="accommodation[]" id="accommodation'+count+'" class="form-control accommodation" required=""  tabindex="-1" aria-hidden="true">'
                +  string
			    +'</select>'
                +'</td>'
                +'<td></td>'
                +'<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove">-</i></button></td>'
                +'</tr>';

                $('#intro2').append(row);
                   
                }
            });

        }else{
            alert('Please select a Location,From date and To date');
            return false;
        }   

});

$("#intro2").on("click",".removeRow", function(){
        
		$(this).parents('tr').remove();
		
	});

</script>
@endsection
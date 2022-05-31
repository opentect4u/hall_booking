@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Booking steps</h4>
                    <form id="Booking_form" name="Booking_form" action="{{route('admin.bookingConfirm')}}"
                        method="post">
                        @csrf
                        <div>
                            <h3>Account</h3>
                            <section>
                                <h3>Account</h3>
                                <!-- <input type="text" name="setp" id="setp" value="1" hidden> -->
                                <div class="form-group">
                                    <label>Room Type</label>
                                    <select name="room_type_id" id="room_type_id" required class="form-control">
                                        <option value=""> -- Select -- </option>
                                        @foreach($room_types as $room_type)
                                        <option value="{{$room_type->id}}"
                                            <?php if(isset($customer) && $customer->room_type_id==$room_type->id){echo "selected";}?>>
                                            {{$room_type->type}}</option>
                                        @endforeach
                                    </select>
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
                            </section>
                            <h3>Profile</h3>
                            <section>
                                <h3>Profile</h3>
                                <div class="form-group" id="availableRoomNo">
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>Room No</label>
                                        <input type="number" name="total_room_no" id="total_room_no" readonly
                                            class="form-control" placeholder="">
                                    </div>
                                    <div class="col">
                                        <label>Adult No</label>
                                        <input type="number" name="adult_no" id="adult_no" value="1"
                                            class="form-control" placeholder="">
                                    </div>
                                    <div class="col">
                                        <label>Child No</label>
                                        <input type="number" name="child_no" id="child_no" value="0"
                                            class="form-control" placeholder="">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Profession</label>
                                    <input type="password" class="form-control" placeholder="Profession">
                                </div> -->
                            </section>
                            <h3>Comments</h3>
                            <section>
                                <h3>Comments</h3>
                                <div class="form-group">
                                    <label>Comments</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </section>
                            <h3>Finish</h3>
                            <section>
                                <h3>Finish</h3>
                                <div class="form-check" id="passengerDetailsDiv">
                                    <!-- <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        I agree with the Terms and Conditions.
                                    </label> -->
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
<!-- <script src="{{ asset('public/vendors/jquery-validation/jquery.validate.min.js') }}"></script> -->
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<!-- <script src="{{ asset('public/js/wizard.js') }}"></script> -->
<!-- End custom js for this page-->

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

$(document).ready(function() {

    // console.log("ready!");
    var form = $("#Booking_form");
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        // onStepChanged: function(event, currentIndex, newIndex) {
        //     alert("Next !!!!"+currentIndex);
        // },
        onStepChanging: function(event, currentIndex, newIndex) {
            // alert("Next !!!!"+newIndex);
            if (newIndex == 1) {
                var room_type_id = $('#room_type_id').val();
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (room_type_id == '') {
                    alert('Select room type')
                    return false;
                } else if (from_date == '') {
                    alert('Select from date')
                    return false;
                } else if (to_date == '') {
                    alert('Select to date')
                    return false;
                }
                // alert(room_type_id);
                Available_Room(room_type_id, from_date, to_date);
                return true;
            } else if (newIndex == 2) {
                var adult_no = $('#adult_no').val();
                // var child_no = $('#child_no').val();
                var x = $(".roomNoChecked:checked").length;
                // alert(x)
                if (x == 0) {
                    alert('Please select any room No');
                    return false;
                } else if (adult_no == '') {
                    alert('Enter adult No')
                    return false;
                }
                PriceDetails();
                return true;
                // return 0;
            } else if (newIndex == 3) {
                // alert(currentIndex+"hii")
                // alert('hello')
                var adult_no = $('#adult_no').val();
                var child_no = $('#child_no').val();
                PassengerDetails(adult_no, child_no);
                return true;
                // return 0;
            }
             else if (newIndex == 4) {
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
});

// $('.roomNoChecked').change(function() {
//     alert('hii')
//     // $('#textbox1').val($(this).is(':checked'));
//     var x = $(".roomNoChecked:checked").length;
//     $("#room_no").val()
//     $("#room_no").val(x)
// });


function Available_Room(room_type_id, from_date, to_date) {
    // alert(room_type_id);
    $.ajax({
        url: "{{route('admin.searchroomAjax')}}",
        method: "POST",
        data: {
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

function PriceDetails() {

}

function PassengerDetails(adult_no, child_no) {
    $.ajax({
        url: "{{route('admin.passengerDetailsAjax')}}",
        method: "POST",
        data: {
            adult_no: adult_no,
            child_no: child_no,
        },
        success: function(data) {
            // alert(data);
            // var obj=JSON.parse(data);
            $('#passengerDetailsDiv').empty();
            $("#passengerDetailsDiv").html(data);

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
@endsection
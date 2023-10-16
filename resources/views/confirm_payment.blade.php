@extends('common.master')
@section('content')

<div class="wrapper">
    <div class="col-md-12">
        <ul class="confirmation-step">
            <li><a href="#" class="active"><span>1</span> Hotel Details</a></li>
            <li><a href="#" class="active"><span>2</span> Guest Details</a></li>
            <li><a href="#" class="active"><span>3</span> Payment</a></li>
            <li><a href="#" class="active"><span>4</span> Confirm</a></li>
        </ul>
    </div>
</div>

<div class="bookingInnerPage">
    <div class="wrapper">
        <div class="col-sm-12 float-left innerContentTxt confirmPage">

            @if($searched->booking_id!='' && $searched->success=='Success')
            <div class="card align-items-center">
                <img src="{{ asset('public/user/images/done.gif') }}" alt="done" style="width:120px;"
                    class="img-fluid m-auto">
                <h1 class="font-weight-600 mt-4">Thank You</h1>
                <h4>You successfully created your booking</h4>
                <section class="content" id="sectionDiv">
                    <div class="outer-div">
                        <div class="container outer-div-inner">
                            <div class="row"
                                style="border-bottom:2px solid #797777;padding-bottom:10px;margin-bottom:10px;">
                                <div class="col-md-12">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <th scope="col"><img src="{{ asset('public/user/images/logo.png') }}"
                                                        alt="logo" class="img-fluid img-responsive"></th>
                                                <th scope="col"><img src="{{ asset('public/user/images/logo.png') }}"
                                                        alt="logo" class="img-fluid img-responsive" align="right">
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 responsive-center">

                                </div>
                                <div class="col-md-4 text-center responsive-center">
                                    <h1>Invoice</h1>
                                </div>
                                <div class="col-md-4 text-right responsive-center">
                                    <table class="m-0" align="right">
                                        <tbody>
                                            <tr>
                                                <td><b>Invoice Date :</b> </td>
                                                <td class="text-left">
                                                    &nbsp;{{ date('d-M-Y',strtotime($hall_book[0]->booking_time))}}
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td><b>Booking Reference &nbsp;&nbsp;&nbsp;: </b></td>
                                                <td class="text-left"> &nbsp;TL20450480</td>
                                            </tr> -->
                                            <!-- <tr>
                                                <td><b>Invoice No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> </td>
                                                <td class="text-left">&nbsp;CLDI0003010</td>
                                            </tr>
                                            <tr>
                                                <td><b>Client ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> </td>
                                                <td class="text-left">&nbsp;CLDC000203</td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-8 col-6">
                                    <h3>To</h3>
                                    <p>{{$hall_book_details[0]['first_name']." ".$hall_book_details[0]['last_name']}}<br>
                                        {{$hall_book_details[0]['address']}}
                                        <!-- <br>ghfgh<br>Bangladesh<br> -->
                                        <!-- 33132132<br><b>TEL:</b>1234567891 -->
                                    </p>
                                </div>
                                <div class="col-md-4 col-6">
                                    <h3>Issued By</h3>
                                    <p>ICMARD Building,<br> 6TH Floor,Block-14/2, <br>C.I.T. Scheme-VIII (M),
                                        Ultadanga,<br> Kolkata-700 067<br>
                                        <b>TEL:</b> (033) 2356-0018<br>
                                        <b>E-MAIL</b> wbscardb@gmail.com
                                    </p>
                                </div>
                            </div>
                            <!-- drztgfr fghfgh -->
                            <div class="row hide_div1">
                                <!-- <div class="col-md-12">
                                    <h2 class="p-3 bg-light-blue d-inline-block">Hotel</h2>
                                </div> -->
                                <div class="col-md-12">
                                    <h4 class="mt-3"><b> Guest Details</b></h4>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="table-primary">
                                                <tr class="invoice-table">
                                                    <th>S#</th>
                                                    <th>Pax Type</th>
                                                    <!-- <th>Room No</th> -->
                                                    <th>First Name / Title</th>
                                                    <th>Last Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1?>
                                                @foreach($hall_book_details as $hall_book_detail)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td><?php if($hall_book_detail->child_flag=='Y'){
                                                            echo "CHILD";
                                                        }else{
                                                            echo "ADULT";
                                                        }
                                                        ?> 
                                                    </td>
                                                    <!-- <td>Room 1</td> -->
                                                    <td>{{$hall_book_detail->first_name}}</td>
                                                    <td>{{$hall_book_detail->last_name}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <p>Note - * denotes the lead passenger</p><br>
                                </div>
                                <div class="col-md-12">
                                    <h4 class="mt-3"><b>HOTEL DETAILS </b></h4>
                                    <p>
                                        Booking Id: {{$hall_book[0]->booking_id}}
                                        <!-- <span class="noprint">
                                                | &nbsp;
                                            </span>
                                            <span id="printOnly">
                                                | &nbsp;
                                            </span>

                                            | PNR : 6C4ZKY | &nbsp;&nbsp;UN PNR :IBE10363947 &nbsp;&nbsp;  -->
                                        | &nbsp;&nbsp;
                                        BOOKING DATE : {{date('d-M-Y H:i:s',strtotime($hall_book[0]->booking_time))}}
                                        &nbsp;&nbsp;
                                        | &nbsp;&nbsp; Booking Status : {{$hall_book[0]->booking_status}}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table ">
                                            <thead class="table-primary">
                                                <tr class="invoice-table">
                                                    <th>Location</th>
                                                    <th>Room Name</th>
                                                    <th>Check In</th>
                                                    <th>Check Out </th>
                                                    <th>No of Rooms</th>
                                                    <th>No of Adult</th>
                                                    <th>No of Child</th>
                                                    <!-- <th>Number Adults</th> -->
                                                    <!-- <th>Number Children</th> -->

                                                    <!-- <th>Class</th>
                                                        <th>Baggage</th>
                                                        <th>Duration</th>
                                                        <th>Stops</th> -->

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>{{$hall_book[0]->location_name}}
                                                        <!-- <br>
                                                        City :- New Delhi, India
                                                        <br>
                                                        HOTEL ID :- 1012190 -->
                                                    </td>
                                                    <td>{{$hall_book[0]->type}}</td>
                                                    <td>{{date('d-m-Y',strtotime($hall_book[0]->from_date))}}</td>
                                                    <td>{{date('d-m-Y',strtotime($hall_book[0]->to_date))}}</td>
                                                    <td>{{$hall_book[0]->no_room}}</td>
                                                    <td>{{$hall_book[0]->no_adult}}</td>
                                                    <td>{{$hall_book[0]->no_child}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php 
                            $total_room_charage =  $hall_book[0]->amount;                               
                            $cgst_rate_percent =$hall_book[0]->total_cgst_amount;
                            $cgst_rate= ($total_room_charage * $cgst_rate_percent)/100 ;
                         
                            $tot_amt= ($total_room_charage + $cgst_rate + $cgst_rate) ;
                            ?>
                                <div class="col-md-12">
                                    <h4 class="mt-3">
                                        <b class="float-right">
                                            <b>Room Charges (GST Extra): </b>
                                            <span class="text-light-blue">₹ {{$hall_book[0]->amount}}</span>
                                        </b>
                                    </h4>
                                </div>
                                <div class="col-md-12">
                                    <h4 class="mt-3">
                                        <b class="float-right">
                                            <b>CGST on Room Charges: </b>
                                            <span class="text-light-blue">₹ {{$cgst_rate}}</span>
                                        </b>
                                    </h4>
                                </div>
                                <div class="col-md-12">
                                    <h4 class="mt-3">
                                        <b class="float-right">
                                            <b>SGST on Room Charges: </b>
                                            <span class="text-light-blue">₹ {{$cgst_rate}}</span>
                                        </b>
                                    </h4>
                                </div>
                                <!-- <div class="col-md-12">
                                    <h4 class="mt-3">
                                        <b class="float-right">
                                            <b>Convenience Fees: </b>
                                            <span class="text-light-blue">£ 0.00</span>
                                        </b>
                                    </h4>
                                </div>
                                <div class="col-md-12">
                                    <h4 class="mt-3">
                                        <b class="float-right">
                                            <b>Taxes &amp; Fees: </b>
                                            <span class="text-light-blue">£ 0.00</span>
                                        </b>
                                    </h4>
                                </div> -->
                            </div>

                            <br><br>
                            <div class="row">
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-8 text-right">
                                    <hr>
                                    <div class="w-100">
                                        <div class="" style="display:inline-block;margin-right:30px;">
                                            <p class="mb-1"><b>Total Amount:</b></p>
                                        </div>
                                        <div class="" style="display:inline-block;">
                                            <p class="mb-1"> INR
                                                {{$tot_amt}}
                                            </p>
                                        </div>

                                    </div>
                                    <!-- <div class="w-100">
                                            <div class="" style="display:inline-block;margin-right:30px;">
                                                <p class="mb-1"><b>Balance Due:</b></p>
                                            </div>
                                            <div class="" style="display:inline-block;">
                                            £  878.28 </div>
                                        </div> -->


                                </div>

                            </div>
                            <hr><br>
                            <div class="row">
                                <div class="col-md-12">


                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-12 pagebreak">
                                        <p>Terms and Conditions<br>
                                            <span class="style1"><strong>Notes:</strong></span>
                                        </p>
                                        <ul type="disc">
                                            <!-- <li class="style1"><strong>Cancellation Deadline: 2022-07-01</strong>&nbsp;&nbsp; </li> -->
                                            <li class="style1">35 Sqm Standard Room</li>
                                            <li class="style1">IWY55</li>
                                            <li class="style1">ExclusiveTaxPercent: 12.0%</li>
                                            <li class="style1">RatePlanCode: IWY55</li>
                                            <li class="style1">Tourist City taxes to be paid on the spot, if any /
                                                Tasse di soggiorno da pagarsi in loco, se previste.</li>
                                            <li class="style1">Note that some hotels may require cash or credit card
                                                deposit as guarantee. This will be returned on departure minus any
                                                deduction incurred during the stay.</li>
                                            <li class="style1">In the event of a no show or early checkout then a
                                                charge of up to 100% of the entire cost of the booking may be
                                                applied</li>
                                        </ul>

                                        <p>

                                            <br> <br> <br>
                                            <span class="style1"><strong>Note/Disclaimer: It is the sole
                                                    responsibility of the passenger to ensure his/her eligibility to
                                                    enter the destination country. Cloud Travel accepts no liability
                                                    in this regard. </strong><br>
                                                <strong>
                                                    In case of Visa, Flight suspensions, cancellation or not
                                                    operating in that case we will apply for a full refund from
                                                    airline and we will only Deduct our Service charge and all other
                                                    ATOL/IATA protections, cash handling fee, administration charges
                                                    will be applied</strong></span>
                                        </p>
                                        <p align="right"><br>
                                            <br>
                                            <span class="style2">Yours Sincerely</span>
                                        </p>


                                        <p></p>


                                        <hr>
                                        <div align="center">
                                            <span class="font-weight-bold text-primary">Book with Confidence</span>
                                            <img src="https://opentech4u.co.in/cloud_travels/public/images/cards.png"
                                                alt="" class="img-fluid"><br>
                                            <span><span class="text-primary">Registered in England No.</span>
                                                09677123</span>
                                        </div><br>
                                        <p align="center">
                                            <!-- <a href="javascript:void(0);"
                                                    class="btn btn-success noprint" onclick="window.print()">Print
                                                    Invoice</a>  -->
                                            <a href="javascript:void(0);" class="btn btn-success noprint"
                                                onclick="printContent('sectionDiv');">Print Invoice</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </section>
                <!-- <small class="text-muted">Booking Ref id: 0CPNd09876fff</small><br>
                    <a href="index.php" class="btn btn-primary mt-4">Home</a> -->
            </div>
            @else
            <div class="card align-items-center">
                <img src="{{ asset('public/user/images/fail.png') }}" alt="done" style="width:120px;"
                    class="img-fluid m-auto">
                <!-- <h1 class="font-weight-600 mt-4">Thank You</h1> -->
                <h4>Booking Failed with no {{$searched->failed_id}}! </h4>
            </div>
            @endif
        </div>

    </div>
</div>


@endsection

@section('script')

<script>
    function printContent(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
@endsection
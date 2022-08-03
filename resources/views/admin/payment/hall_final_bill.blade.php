@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <!-- <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="mt-1 mb-1">Bill Details for Booking Id #{{$booking_id}}</h4>
            </div> -->
            @if(count($datas)>0)
            <div id="sectionDiv">
                <div class="row invoice-info">
                    <div class="col-sm-12 invoice-col">
                        <address class="text-center">PH: 033-2356-5522(Principal) / 2356-6522 (EPBX)</address>
                        <address class="text-center">FAX: 033-2356-3633, Email : icmard.kol@gmail.com</address>
                        <address class="text-center">GSTIN: 19AAAJT0468K1Z0, PAN : AAAJT0468K</address>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-6 invoice-col">
                        Memo No: 304/ICMARD/355
                    </div>
                    <div class="col-sm-6 invoice-col text-center">
                        Date : {{date('d-m-Y')}}
                    </div>
                </div>
                <br />
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (555) 539-1037<br>
                            Email: john.doe@example.com
                        </address>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-8 invoice-col text-center">
                        Ref : Your letter Under Booking Id : {{$booking_id}}
                    </div>
                    <div class="col-sm-4 invoice-col">
                        Date : {{date('d-m-Y')}}
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-12 invoice-col">
                        Dear Sir,
                        <address>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            We are sending here with a bill for the hall, Food provided to your room hold on {{$datas[0]['from_date']}} 
                            to  {{$datas[0]['to_date']}} at this institute. Details of the bill are given below :-
                        </address>
                    </div>

                </div>
                <section class="content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> A) Service Charges :</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <!-- <th style="width: 1%" class="text-center">Date</th> -->
                                        <th>Date</th>
                                        <th>To</th>
                                        <th>Particulars</th>
                                        <th>Rate per day</th>
                                        <th>No of days</th>
                                        <th>Amount</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $hall_total_amount=0;$hall_cal_total_amount=0;?>
                                    @foreach($datas as $data)
                                    <?php 
                                    // $interval_hall = \Carbon\Carbon::parse($data->from_date)->diff(\Carbon\Carbon::parse($data->to_date))->days;
                                    $interval_hall = count(json_decode($data->all_dates));
                                    $hall_total_amount +=$data->amount*$interval_hall;
                                    $cgst_hall=($hall_total_amount*$data->total_cgst_amount)/100;
                                    $sgst_hall=($hall_total_amount*$data->total_sgst_amount)/100;
                                    $hall_cal_total_amount=$hall_total_amount+$cgst_hall+$sgst_hall;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php 
                                            $dates=json_decode($data->all_dates);
                                            for ($x=0; $x < count($dates); $x++) { 
                                                echo  $dates[$x];
                                                if (count($dates)!=$x && count($dates)!=1) {
                                                    echo ", ";
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$data->amount}}</td>
                                        <td>{{$interval_hall}}</td>
                                        <td></td>
                                        <td>{{$hall_total_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>CGST</td>
                                        <td>({{$data->total_cgst_amount}}%)</td>
                                        <td>{{$cgst_hall}}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>SGST</td>
                                        <td>({{$data->total_sgst_amount}}%)</td>
                                        <td>{{$sgst_hall}}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td></td>
                                        <td>{{$hall_cal_total_amount}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <br />
                <section class="content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">B) Guest Room Charges :</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>AC Room</th>
                                        <th>D/B Room</th>
                                        <th>Bed</th>
                                        <th>Rate per Day</th>
                                        <th>No of days</th>
                                        <th>Amount</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total_amount=0;$cal_total_amount=0;?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <br />
                <section class="content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">C) Food Charges :</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Item</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>No of Head</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $food_total_amount=0;$food_cal_total_amount=0;
                                    $i=1;
                                    foreach ($room_menu as $key => $menu) {
                                        $food_total_amount +=$menu->amount;
                                    ?>
                                    <tr>
                                        <td><?php 
                                            $dates=json_decode($data->all_dates);
                                            for ($x=0; $x < count($dates); $x++) { 
                                                echo $dates[$x];
                                                if (count($dates)!=$i && count($dates)!=1) {
                                                    echo ", ";
                                                }
                                            }
                                            ?></td>
                                        <td>{{$menu->menu_id}}</td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td>{{$menu->no_of_head}}</td>
                                        <td>{{$menu->rate}}</td>
                                        <td>{{$menu->amount}}</td>
                                        <td>
                                            @if(count($room_menu)==$i)
                                            {{$food_total_amount}}
                                            @endif
                                        </td>
                                    </tr>
                                    <?php  $i++; } 
                                    $food_cgst =($food_total_amount*2.5)/100;
                                    $food_sgst =($food_total_amount*2.5)/100;
                                    $food_cal_total_amount=$food_cgst +$food_sgst + $food_total_amount;
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>CGST</td>
                                        <td>(2.5 %)</td>
                                        <td>{{$food_cgst}}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>SGST</td>
                                        <td>(2.5%)</td>
                                        <td>{{$food_sgst}}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td></td>
                                        <td>{{$food_cal_total_amount}}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <br />
                <section class="content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">D) Projecter :</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Item</th>
                                        <th></th>
                                        <th></th>
                                        <th>Pieces</th>
                                        <th>Days</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $projecter_total_amount=0;$projecter_cal_total_amount=0;?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <div class="row">
                    <div class="col-6">
                        <!-- <p class="lead">Payment Methods:</p>
                        <img src="../../dist/img/credit/visa.png" alt="Visa">
                        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                        <img src="../../dist/img/credit/american-express.png" alt="American Express">
                        <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango
                            imeem
                            plugg
                            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                        </p> -->
                    </div>
                    <div class="col-6">
                        <!-- <p class="lead"></p> -->

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>A+B+C+D Total Bill Payable Amt:</th>
                                        <td><?php echo $total_bill_pay_amt=$hall_cal_total_amount+$cal_total_amount+$food_cal_total_amount+$projecter_cal_total_amount; ?>
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                        <th></th>
                                        <td></td>
                                    </tr> -->
                                    <tr>
                                        <th>ADVANCE</th>
                                        <td><?php
                                        $advance_amt=0;
                                        if (count($payment_details)>0) {
                                           foreach ($payment_details as $key => $paymentDetail) {
                                            $advance_amt=$advance_amt+$paymentDetail->amount;
                                           }
                                        }
                                        echo $advance_amt;
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <th>Net Payment</th>
                                        <td><?php echo $net_payment=$total_bill_pay_amt - $advance_amt; ?></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row invoice-info">
                    <div class="col-sm-12 invoice-col">
                        <address>
                            Please pay the net amount of
                            <strong>Rs. {{$net_payment}} [Rupees:
                                {{ ucfirst(app('App\Http\Controllers\UtilityController')->convert_number_to_words($net_payment))}}]
                            </strong>
                            only by an account payee cheque in favour of 'ICMARD' or through RTGS/NEFT payment on Punjab
                            National, VIP Road (Ultadanga) Branch, Kolkata to Account No:0 8200 5000 2951 and IFSC Code:
                            PUNB0082020 at your earliest.
                        </address>
                    </div>
                </div>
            </div>
            <div class="row no-print">
                <div class="col-12">
                    <!-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                class="fas fa-print"></i> Print</a> -->

                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;"
                        onclick="printContent('sectionDiv');">
                        <i class="mdi mdi-printer"></i> Generate PDF
                    </button>
                </div>
            </div>

            @else
            <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="mt-1 mb-1">This Booking Id #{{$booking_id}} not found!</h4>
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
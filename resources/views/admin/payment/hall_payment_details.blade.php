@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="mt-1 mb-1">Bill Details for Booking Id #{{$booking_id}}</h4>
            </div>
            @if(count($datas)>0)
            <form action="{{route('admin.hallFinalPayent')}}" method="post">
                @csrf
                <input type="text" name="booking_id" id="booking_id" value="{{$booking_id}}" hidden>
                <input type="text" name="id" id="id" value="{{$datas[0]['id']}}" hidden>
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
                                        <td>{{$total_bill_pay_amt - $advance_amt}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <input type="text" name="pay_amt" id="pay_amt" value="{{$total_bill_pay_amt - $advance_amt}}" hidden>
                <div class="row no-print">
                    <div class="col-12">
                        <!-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                class="fas fa-print"></i> Print</a> -->
                        @if($datas[0]['final_bill_flag']=='Y')
                        <a href="{{route('admin.viewBill',['booking_id'=>$booking_id])}}"
                            class="btn btn-success float-right">Print Bill</a>
                        @else
                        <button type="submit" class="btn btn-success float-right">Submit Payment</button>
                        @endif
                        <!-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generate PDF
                        </button> -->
                    </div>
                </div>
            </form>
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


@endsection
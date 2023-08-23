@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="mt-1 mb-1">Payment Details for Booking Id #{{$booking_id}}</h4>
            </div>
         
            <form action="{{route('admin.roomFinalPayent')}}" method="post">
                @csrf
                <input type="text" name="booking_id" id="booking_id" value="" hidden>
                <input type="text" name="id" id="id" value="" hidden>
                <?php $hall_total_amount=0;$hall_cal_total_amount=0;?>
               
                <section class="content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> Accomadation Charges :</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">ROOM/HALL TYPE</th>
                                        <th class="text-center">Room No</th>
                                        <th class="text-center">Taxable</th>
                                        <th class="text-center">CGST</th>
                                        <th class="text-center">SGST</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total_amount=0;$cal_total_amount=0;?>
                                    <?php    $taxable =  0 ;$cgst =0; $sgst = 0; ?>
                                    @foreach($datas as $data)
                                    <?php 
                                  //  $interval = \Carbon\Carbon::parse($data->from_date)->diff(\Carbon\Carbon::parse($data->to_date))->days;
                                    // $interval = 2;
                                  //  $total_amount +=$data->final_amount*$interval;
                                     $taxable = $data->normal_rate;
                                    $cgst=($taxable*$data->cgst_rate)/100;
                                    $sgst=($taxable*$data->cgst_rate)/100;
                                //    $cal_total_amount=$total_amount+$cgst+$sgst;
                                //{{date('d-m-Y',strtotime($data->to_date))}}
                                    ?>
                                    <tr class="text-center">
                                        <td></td>
                                        <td></td>
                                        <td>{{$data->room_name}}</td>
                                        <td>{{$data->room_no}}</td>
                                        <td>{{$data->normal_rate}}</td>
                                        <td>{{$cgst}}</td>
                                        <td>{{$sgst}}</td>
                                        <td>{{$taxable+$cgst+$sgst}}</td>
                                    </tr>
                                   <?php    $taxable =  0 ;$cgst =0; $sgst = 0; ?>
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
                            <h3 class="card-title"></h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Item</th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center">Pieces</th>
                                        <th class="text-center">Days</th>
                                        <th class="text-center">Rate</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //$projecter_total_amount=0;$projecter_cal_total_amount=0;?>
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
                                        <td><?php //echo $total_bill_pay_amt=$hall_cal_total_amount+$cal_total_amount+$food_cal_total_amount+$projecter_cal_total_amount; ?>
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
                                        echo $advance_amt;
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <th>Net Payment</th>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                                    <div class="col-3">
                                        <label>Pay Mode</label>
                                        <select name="payment_made_by" id="location_id" required class="form-control">
                                            <option value=""> -- Select -- </option>
                                            <option value="Cash">Cash</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="NEFT">NEFT</option>
                                            <option value="RTGS">RTGS</option>
                                            <option value="UPI">UPI</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label>Cheque No</label>
                                        <input type="text" name="cheque_no" id="cheque_no" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label>Cheque Date</label>
                                        <input type="date" name="cheque_dt" id="cheque_dt" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label>Payment Receive Date</label>
                                        <input type="date" name="payment_date" id="payment_date" required class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label>Transaction ID</label>
                                        <input type="text" name="payment_id" id="payment_id" placeholder="" class="form-control">
                                    </div>
                        </div>
                    </div>

                </div>
                <input type="text" name="pay_amt" id="pay_amt" value="" hidden>
                <div class="row no-print">
                    <div class="col-12">
                       
                       
                        <button type="submit" class="btn btn-success float-right">Submit Payment</button>
                     
                    </div>
                </div>
            </form>
         
            <!-- <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="mt-1 mb-1">This Booking Id #{{$booking_id}} not found!</h4>
            </div> -->
           
        </div>
    </div>
</div>


@endsection

@section('script')


@endsection
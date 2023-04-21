@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="card-body d-flex align-items-center justify-content-between">
            <h4 class="mt-1 mb-1">Room Booking Cancel From</h4>
                <h4 class="mt-1 mb-1">Bill Details for Booking Id #{{$booking_id}}</h4>
            </div>
            @if(count($datas)>0)
            <form action="{{route('admin.roombookingcancel')}}" method="post">
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
                                        <!-- <th style="width: 1%">Date</th> -->
                                        <th class="text-center">Date</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Particulars</th>
                                        <th class="text-center">Rate per day</th>
                                        <th class="text-center">No of days</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $hall_total_amount=0;$hall_cal_total_amount=0;?>
                                    <tr>
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
                            <h3 class="card-title">B) Guest Room Charges :</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">AC Room</th>
                                        <th class="text-center">D/B Room</th>
                                        <th class="text-center">Bed</th>
                                        <th class="text-center">Rate per Day</th>
                                        <th class="text-center">No of days</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total_amount=0;$cal_total_amount=0;?>
                                    @foreach($datas as $data)
                                    <?php 
                                    $interval = \Carbon\Carbon::parse($data->from_date)->diff(\Carbon\Carbon::parse($data->to_date))->days;
                                    // $interval = 2;
                                    $total_amount +=$data->amount*$interval;
                                    $cgst=($total_amount*$data->total_cgst_amount)/100;
                                    $sgst=($total_amount*$data->total_sgst_amount)/100;
                                    $cal_total_amount=$total_amount+$cgst+$sgst;
                                    ?>
                                    <tr>
                                        <td>{{$data->from_date}}</td>
                                        <td>{{$data->to_date}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$data->amount}}</td>
                                        <td>{{$interval}}</td>
                                        <td></td>
                                        <td>{{$total_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>CGST</td>
                                        <td>({{$data->total_cgst_amount}}%)</td>
                                        <td>{{$cgst}}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>SGST</td>
                                        <td>({{$data->total_sgst_amount}}%)</td>
                                        <td>{{$sgst}}</td>
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
                                        <td>{{$cal_total_amount}}</td>
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
                            <h3 class="card-title">C) Food Charges :</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Item</th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center">No of Head</th>
                                        <th class="text-center">Rate</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Amount</th>
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
                                        <td>{{$data->from_date}}</td>
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
                    <div class="col-12">
                    <div class="form-group row">
                                    <div class="col-3">
                                        <label>Refund Mode</label>
                                        <select name="refund_mode" id="refund_mode" required class="form-control">
                                            <option value=""> -- Select -- </option>
                                            <option value="Cash">Cash</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="NEFT">NEFT</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label>Refund Amount</label>
                                        <input type="text" name="refund_amt" id="refund_amt" required placeholder="" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label>Refund Date</label>
                                        <input type="date" name="refund_dt" id="refund_dt" required placeholder="" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label>Refund Cheque no</label>
                                        <input type="text" name="refund_cheque_no" id="refund_cheque_no" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label>Refund Cheque Date</label>
                                        <input type="date" name="refund_cheque_dt" id="refund_cheque_dt" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label>Transaction ID</label>
                                        <input type="text" name="refund_payment_id" id="refund_payment_id" placeholder="" class="form-control">
                                    </div>
                                </div>
                    </div>

                </div>
                <input type="text" name="pay_amt" id="pay_amt" value="{{$total_bill_pay_amt - $advance_amt}}" hidden>
                <div class="row no-print">
                    <div class="col-12">
                 
                        @if($datas[0]['final_bill_flag']=='Y')
                        <!-- <a href="{{route('admin.viewBill',['booking_id'=>$booking_id])}}"
                            class="btn btn-success float-right">Print Bill</a> -->

                        @else
                        <!-- <button type="submit" class="btn btn-success float-right">Submit Payment</button> -->
                        @endif
                        <button type="submit" class="btn btn-success float-right">Cancel Booking</button>
                       
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
@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="mt-1 mb-1">Bulk Booking Payment Details for Booking Id #{{$booking_id}}</h4>
            </div>
         
            <form action="{{route('admin.bulkpaymentsubmit')}}" method="post">
                @csrf
                <input type="text" name="booking_id" id="booking_id" value="{{$booking_id}}" hidden>
                <input type="text" name="id" id="id" value="{{$room_book->id}}" hidden>
                <?php $hall_total_amount=0;$hall_cal_total_amount=0;?>
               
                <section class="content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> Accomadation Charges : From {{$room_book->from_date}} To {{$room_book->to_date}}</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                       
                                        <th class="text-center">ROOM/HALL TYPE</th>
                                        <th class="text-center">Room No</th>
                                        <th class="text-center">Taxable</th>
                                        <th class="text-center">CGST</th>
                                        <th class="text-center">SGST</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total_amount=0;$cal_total_amount=0;$tot_taxable=0;?>
                                    <?php    $taxable =  0 ;$cgst =0; $sgst = 0;   $tot_cgst = 0 ; $cgst_rate = 0;?>
                                    @foreach($datas as $data)
                                    <?php 
                                  $interval = \Carbon\Carbon::parse($room_book->from_date)->diff(\Carbon\Carbon::parse($room_book->to_date))->days;
                                    // $interval = 2;
                                  //  $total_amount +=$data->final_amount*$interval;
                                 // print_r($acco_rent);die();
                                  foreach($acco_rent as $rent){
                                       if($data->room_type_id == $rent->room_type_id ){
                                        $taxable = $rent->normal_rate;
                                        $cgst_rate = $rent->cgst_rate;
                                       }
                                  }
                                    // $taxable = $data->normal_rate;
                                    $cgst=($taxable*$cgst_rate)/100;
                                    $sgst=($taxable*$cgst_rate)/100;
                                    $tot_cgst +=($taxable*$cgst_rate)/100;
                                //    $cal_total_amount=$total_amount+$cgst+$sgst;
                                //{{date('d-m-Y',strtotime($data->to_date))}}
                                    ?>
                                    <tr class="text-center">
                                        <td>{{$data->room_name}}</td>
                                        <td>{{$data->room_no}}</td>
                                        <td>{{$taxable}}</td>
                                        <td>{{$cgst_rate}}</td>
                                        <td>{{$cgst_rate}}</td>
                                        
                                        <td>{{round(($taxable+$cgst+$sgst)*$interval)}}</td>
                                        <?php $total_amount +=round(($taxable+$cgst+$sgst)*$interval);
                                        $tot_taxable +=round(($taxable)*$interval); ?>
                                    </tr>
                                   <?php    $taxable =  0 ;$cgst =0; $sgst = 0; ?>
                                    @endforeach
                                    <tr>
                                        
                                        <td></td>
                                        <td></td>
                                        <td><input type="text" id="amount" required="" class="form-control" value="{{$tot_taxable}}" readonly=""></td>
                                        <td><input type="text" id="cgst_rate" name="cgst_rate" required="" class="form-control" value="{{$tot_cgst}}" readonly="">
                                        <input type="hidden" id="crate" name="crate" class="form-control" value="5" readonly="">
                                        </td>
                                        <td><input type="text" id="cgst_rate" name="cgst_rate" required="" class="form-control" value="{{$tot_cgst}}" readonly=""></td>
                                    
                                        <td><input type="text" id="net_amount" name="net_amount" required="" class="form-control" value="{{$total_amount}}" readonly=""></td>
                                    </tr>    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                
                <br />
                <div class="form-group row">
    <div class="col-sm-4"><label>Taxable Value</label>
    <input type="text" id="taxable" name="taxable" class="form-control" value="" readonly="">
    
</div>
    <div class="col-sm-4"><label>Cgst Value</label>
    <input type="text" id="cgst" name="cgst" class="form-control" value="" readonly="">
</div>
    <div class="col-sm-4"><label>Sgst Value</label>
    <input type="text" id="sgst" name="sgst" class="form-control" value="" readonly="">
</div>

</div>
<div class="form-group row">
    <div class="col-sm-6">
        <label>Discount (%): </label>
        <input type="text" name="discount_price" id="discount_price" required="" class="form-control" value="0" onchange="youFunction();">
    </div>

    <div class="col-sm-6">
        <label>Total Amount : </label>
        <input type="text" name="total_amount" id="total_amount" required="" class="form-control" value="{{$total_amount}}" readonly="">
    </div>
</div>
                <div class="row">
                    
                    
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
<script>
function youFunction() {
    
    var discount = $('#discount_price').val();
    var newgst   = 0;
    var amount   = $('#amount').val();
    var cal_total_amount = $('#net_amount').val();
    var newamt = (amount-(parseFloat((amount*discount)/100))).toFixed();
    var cgsts = $('#cgst_rate').val();
    var cgst   =   parseFloat(cgsts*(discount/100));
    // alert('cal_total_amount-'+cal_total_amount+'  --discount-'+discount)
    //var total_amount = cal_total_amount - discount;
    newgst  = parseFloat((cgsts-cgst).toFixed());
    $("#total_amount").val();
    $("#taxable").val(newamt);
    $("#cgst").val((cgsts-cgst).toFixed());
    $("#sgst").val((cgsts-cgst).toFixed());
    $("#total_amount").val(parseFloat(newamt)+parseFloat(newgst)+parseFloat(newgst));
}
</script>

@endsection
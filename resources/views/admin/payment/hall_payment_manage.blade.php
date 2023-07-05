@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <!-- <h4 class="card-title">Liquor Type</h4> -->
            <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
            <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="mt-1 mb-1">Payment Status</h4>
                <!-- <h4 class="mt-1 mb-1">Hi, Welcomeback!</h4> -->
                <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
                <!-- <a href="{{route('admin.cautionMoneyadd')}}" class="btn btn-info d-none d-md-block">Add</a> -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th>Booking Id</th>
                                    <th>Booking Time</th>
                                    <th>Booking dates</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                @foreach($datas as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$data->booking_id}}</td>
                                    <td>{{date('d-m-Y H:i:s',strtotime($data->booking_time))}}</td>
                                    <td><?php 
                                    $ddd=json_decode($data->all_dates,true);
                                    $i=1;
                                    foreach ($ddd as $key => $value) {
                                        echo $value;
                                        if (count($ddd)!=$i) {
                                            echo ", ";
                                        }
                                        $i++;
                                    }
                                    ?></td>
                                    <td>
                                        @if($data->final_bill_flag =='Y')
                                        <a href="{{route('admin.hallpaymentStatusDetails',['booking_id'=>$data->booking_id])}}"
                                            title="Bill Details"><i class="mdi mdi-table-edit"
                                                style="font-size: 25px;"></i></a>
                                        <a href="javascript:void(0)" onClick="MenuFun();" title="Add Menu"><i
                                                class="mdi mdi-book-plus" style="font-size: 25px;"></i></a>
                                        <a href="{{route('admin.viewBillHall',['booking_id'=>$data->booking_id])}}"
                                            title="View Bill"><i class="mdi mdi-eye" style="font-size: 25px;"></i></a>
                                        <a href="{{route('admin.hallbookingcanceldtls',['booking_id'=>$data->booking_id])}}"
                                        title="Bill Details"><i class="mdi mdi-cancel"
                                            style="font-size: 25px;"></i></a>   
                                            @if($data->booking_status =='C')
                                                <span style="color:red">Canceled</span>       
                                            @endif
                                        @else
                                        <a href="{{route('admin.hallpaymentStatusDetails',['booking_id'=>$data->booking_id])}}"
                                            title="Bill Details"><i class="mdi mdi-table-edit"
                                                style="font-size: 25px;"></i></a>
                                        <a href="{{route('admin.addMenuHall',['booking_id'=>$data->booking_id])}}"
                                            title="Add Menu"><i class="mdi mdi-book-plus"
                                                style="font-size: 25px;"></i></a>
                                        <a href="javascript:void(0)" onClick="ViewBillFun();" title="View Bill"><i
                                                class="mdi mdi-eye" style="font-size: 25px;"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')

<script>
function MenuFun() {
    alert('Your bill already generate you cam`t add new menu!')
}

function ViewBillFun() {
    alert('Your final payment can not be done. You complete payment first')
}
</script>
@endsection
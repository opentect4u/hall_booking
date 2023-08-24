@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <!-- <h4 class="card-title">Liquor Type</h4> -->
            <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
            <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="mt-1 mb-1">Bookings</h4>
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
                                    <th>Booking from date</th>
                                    <th>Booking to date</th>
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
                                    <td>{{date('d-m-Y',strtotime($data->from_date))}}</td>
                                    <td>{{date('d-m-Y',strtotime($data->to_date))}}</td>
                                    <td>
                                    @if($data->final_bill_flag =='Y')
                                        
                                        <a href="{{route('admin.bulkViewBill',['booking_id'=>$data->booking_id])}}"
                                            title="View Bill"><i class="mdi mdi-eye" style="font-size: 25px;"></i></a>
                                       
                                                @if($data->booking_status =='C')
                                                 <span style="color:red">Canceled</span>
                                                 @else   
                                                 <a href="{{route('admin.roombookingcanceldtls',['booking_id'=>$data->booking_id])}}"
                                            title="Bill Details"><button>Cancel</button></a>     
                                                @endif

                                                @else
                                                <a href="{{route('admin.bulkpaymentDetails',['booking_id'=>$data->booking_id])}}" title="Details"><i class="mdi mdi-eye" style="font-size: 25px;">Payment</i></a>
                                        @endif
                                        <a href="{{route('admin.additem',['booking_id'=>$data->booking_id])}}"
                                            title="Add Menu"><i class="mdi mdi-book-plus"
                                                style="font-size: 25px;"></i></a>
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


@endsection
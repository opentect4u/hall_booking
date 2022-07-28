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
                                        <a href="{{route('admin.hallbookingDetails',['booking_id'=>$data->booking_id])}}" title="Details"><i class="mdi mdi-eye" style="font-size: 25px;"></i></a>
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
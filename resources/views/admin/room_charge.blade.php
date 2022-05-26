@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <!-- <h4 class="card-title">Liquor Type</h4> -->
            <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
            <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="mt-1 mb-1">Room Charge</h4>
                <!-- <h4 class="mt-1 mb-1">Hi, Welcomeback!</h4> -->
                <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
                <a href="{{route('admin.roomChargeadd')}}" class="btn btn-info d-none d-md-block">Add</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th>Room Type</th>
                                    <th>effective date</th>
                                    <th>hour Flag</th>
                                    <th>Per Bed Flag</th>
                                    <th>amount</th>
                                    <th>discount(%)</th>
                                    <th>holiday amount</th>
                                    <th>cgst rate(%)</th>
                                    <th>sgst rate(%)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                @foreach($datas as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$data->room_type}}</td>
                                    <td>{{$data->effective_date}}</td>
                                    <td>@if($data->hour_flag=='Y'){{'Yes'}}@else{{'No'}}@endif</td>
                                    <td>@if($data->per_bed_flag=='Y'){{'Yes'}}@else{{'No'}}@endif</td>
                                    <td>{{$data->amount}}</td>
                                    <td>{{$data->discount_percentage}}</td>
                                    <td>{{$data->holiday_amount}}</td>
                                    <td>{{$data->cgst_rate}}</td>
                                    <td>{{$data->sgst_rate}}</td>
                                    <td>
                                        <a href="{{route('admin.roomChargeedit',['id'=>$data->id])}}" title="Edit"><i class="mdi mdi-table-edit" style="font-size: 25px;"></i></a>
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
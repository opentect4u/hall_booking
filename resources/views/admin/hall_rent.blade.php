@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <!-- <h4 class="card-title">Liquor Type</h4> -->
            <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
            <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="mt-1 mb-1">Hall Rent</h4>
                <!-- <h4 class="mt-1 mb-1">Hi, Welcomeback!</h4> -->
                <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
                <a href="{{route('admin.hallRentadd')}}" class="btn btn-info d-none d-md-block">Add</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th>effective date</th>
                                    <th>Hall Type</th>
                                    <th>Location</th>
                                    <th>hall no</th>
                                    <th>Book Type</th>
                                    <th>amount</th>
                                    <th>Holiday Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                @foreach($datas as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{date('d-m-Y',strtotime($data->effective_date))}}</td>
                                    <td>{{$data->room_type}}</td>
                                    <td>{{$data->location}}</td>
                                    <td>{{$data->hall_no}}</td>
                                    <td>@if($data->book_flag=='H'){{'Hourly'}}@elseif($data->book_flag=='B'){{'Per Bed'}}@elseif($data->book_flag=='W'){{'Whole Room'}}@endif</td>
                                    <td>{{$data->normal_rate}}</td>
                                    <td>{{$data->holiday_rate}}</td>
                                    <td>
                                        <a href="{{route('admin.hallRentedit',['id'=>$data->id])}}" title="Edit"><i class="mdi mdi-table-edit" style="font-size: 25px;"></i></a>
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
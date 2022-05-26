@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <!-- <h4 class="card-title">Liquor Type</h4> -->
            <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
            <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="mt-1 mb-1">Rooms</h4>
                <!-- <h4 class="mt-1 mb-1">Hi, Welcomeback!</h4> -->
                <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
                <a href="{{route('admin.roomsadd')}}" class="btn btn-info d-none d-md-block">Add</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th>location</th>
                                    <th>Room No</th>
                                    <th>Room Type</th>
                                    <th>Room Name</th>
                                    <th>No of Person</th>
                                    <th>Floor</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                @foreach($datas as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$data->location}}</td>
                                    <td>{{$data->room_no}}</td>
                                    <td>{{$data->room_type}}</td>
                                    <td>{{$data->room_name}}</td>
                                    <td>{{$data->no_person}}</td>
                                    <td>{{$data->floor}}</td>
                                    <td>
                                        <a href="{{route('admin.roomsedit',['id'=>$data->id])}}" title="Edit"><i class="mdi mdi-table-edit" style="font-size: 25px;"></i></a>
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
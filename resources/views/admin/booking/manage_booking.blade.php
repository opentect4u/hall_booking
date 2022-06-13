@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <!-- <h4 class="card-title">Liquor Type</h4> -->
            <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
            <div class="card-body">
                <form action="{{route('admin.manageBooking')}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <input type="text" name="booking_id" id="booking_id"
                                    value="{{isset($booking_id)?$booking_id:''}}" class="form-control" required placeholder="Enter booking Id">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <input type="submit" class="btn btn-primary" value="Search" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="mt-1 mb-1">Rooms</h4>
                <a href="{{route('admin.roomsadd')}}" class="btn btn-info d-none d-md-block">Add</a>
            </div> -->
            @if(isset($booking_id))
            @if(count($datas) > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card px-2">
                        <div class="card-body">
                            <div class="container-fluid">
                                <h3 class="text-right my-5">Booking Id&nbsp;&nbsp;#&nbsp; {{$booking_id}}</h3>
                                <hr>
                            </div>
                            <div class="container-fluid d-flex justify-content-between">
                                <div class="col-lg-3 pl-0">
                                    <p class="mt-5 mb-2"><b>{{$guest_details[0]->first_name." ".$guest_details[0]->middle_name." ".$guest_details[0]->last_name}}</b></p>
                                    <p>{{$guest_details[0]->address}}
                                        <!-- <br>Minare SK,<br>Canada, K1A 0G9. -->
                                    </p>
                                </div>
                                <div class="col-lg-3 pr-0">
                                    <p class="mt-5 mb-2 text-right"><b>Invoice to</b></p>
                                    <p class="text-right">Gaala &amp; Sons,<br> C-201, Beykoz-34800,<br> Canada, K1A
                                        0G9.</p>
                                </div>
                            </div>
                            <div class="container-fluid d-flex justify-content-between">
                                <div class="col-lg-5 pl-0">
                                    <p class="mb-0 mt-5">Booking Date : {{ date('d-m-Y H:i:s',strtotime($datas[0]->booking_time))}}</p>
                                    <!-- <p>Due Date : 25th Jan 2017</p> -->
                                </div>
                            </div>
                            <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                                <div class="table-responsive w-100">
                                    <h4>Booking Details</h4>
                                    <table class="table mt-3">
                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th>#</th>
                                                <th>Location</th>
                                                <th>Room Type</th>
                                                <th class="text-right">From Date</th>
                                                <th class="text-right">To Date</th>
                                                <th class="text-right">no of room</th>
                                                <th class="text-right">no of adult</th>
                                                <th class="text-right">no of child</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-right">
                                                <td class="text-left">1</td>
                                                <td class="text-left">{{$datas[0]->location_name}}</td>
                                                <td class="text-left">{{$datas[0]->room_type}}</td>
                                                <td>{{ date('d-m-Y',strtotime($datas[0]->from_date))}}</td>
                                                <td>{{ date('d-m-Y',strtotime($datas[0]->to_date))}}</td>
                                                <td>{{$datas[0]->no_room}}</td>
                                                <td>{{$datas[0]->no_adult}}</td>
                                                <td>{{$datas[0]->no_child}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h4 class="mt-5">Guest Details</h4>
                                    <table class="table mt-3">
                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th>#</th>
                                                <th>Pax Type</th>
                                                <th>First Name</th>
                                                <th >Middle Name</th>
                                                <th>Last Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            @foreach($guest_details as $guest_detail)
                                            <tr class="text-right">
                                                <td class="text-left">{{$i++}}</td>
                                                <td class="text-left"><?php if($guest_detail->child_flag=='Y'){echo "Child";}else{echo "Adult";} ?></td>
                                                <td class="text-left">{{$guest_detail->first_name}}</td>
                                                <td class="text-left">{{$guest_detail->middle_name}}</td>
                                                <td class="text-left">{{$guest_detail->last_name}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- <div class="container-fluid mt-5 w-100">
                                <p class="text-right mb-2">Sub - Total amount: $12,348</p>
                                <p class="text-right">vat (10%) : $138</p>
                                <h4 class="text-right mb-5">Total : $13,986</h4>
                                <hr>
                            </div> -->
                            <!-- <div class="container-fluid w-100">
                                <a href="#" class="btn btn-primary float-right mt-4 ml-2"><i
                                        class="mdi mdi-printer mr-1"></i>Print</a>
                                <a href="#" class="btn btn-success float-right mt-4"><i
                                        class="mdi mdi-telegram mr-1"></i>Send Invoice</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            @else
            <h2>No invoice found!!</h2>
            @endif
            @endif
        </div>
    </div>
</div>


@endsection

@section('script')


@endsection
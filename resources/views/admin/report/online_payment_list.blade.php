@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <!-- <h4 class="card-title">Liquor Type</h4> -->
            <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
            <div class="card-body d-flex align-items-center justify-content-between">
                <h4 class="mt-1 mb-1">Booking Summary</h4>
                <!-- <h4 class="mt-1 mb-1">Hi, Welcomeback!</h4> -->
                <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
                <!-- <a href="{{route('admin.cautionMoneyadd')}}" class="btn btn-info d-none d-md-block">Add</a> -->
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Search</h4>
                            <form action="{{route('admin.onlinepayment')}}" autocomplete="off">
                                <div class="form-group row">
                                    <div class="col-md-5">
                                        <!-- <label>Basic</label> -->
                                        <input class="form-control" name="from_date" id="from_date" type="date"
                                            placeholder="DD-MM-YYYY"
                                            value="<?php if($from_date!=''){echo $from_date;}?>">
                                    </div>
                                    <div class="col-md-5">
                                        <!-- <label>Bloodhound</label> -->
                                        <input class="form-control" name="to_date" id="to_date" type="date"
                                            placeholder="DD-MM-YYYY" value="<?php if($to_date!=''){echo $to_date;}?>">
                                    </div>
                                    <div class="col-md-2">
                                        <!-- <label>Bloodhound</label> -->
                                        <!-- <input class="form-control" type="text" placeholder="States of USA" > -->
                                        <!-- <input type="submit" class="btn btn-primary mr-2" value="Search"> -->
                                        <button class="btn btn-primary btn-rounded btn-fw"
                                            id="searchBtn">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            @if(count($datas)>0)
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <table id="example" class="table">
                                <thead>
                                   <tr>
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Date</th>
                                       
                                        <th class="text-center">Booking ID</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Contact</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Pg charge</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;?>
                                    @foreach($datas as $data)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{date('d-m-Y',strtotime($data->trans_date))}}</td>
                                        <td>{{$data->booking_id}}</td>
                                        <td>{{$data->email}}</td>
                                        <td>{{$data->contact}}</td>
                                        <td>{{($data->amount )}}</td>
                                        <td>{{($data->pg_charge )}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>


@endsection

@section('script')


<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

<script>

</script>

<script>
$(document).ready(function() {
    var table = $('#example').DataTable({
        lengthChange: false,
        // dom: 'Bfrtip',
        // responsive: true,
        pageLength: 25,
        // lengthMenu: [ 10, 25, 50, 100, 200, 500],
        buttons: ['csv'],
        // buttons: [ 'copy', 'excel', 'csv', 'pdf' ]
        // buttons: [ 'copy', 'excel', 'csv', 'pdf', 'colvis' ]
        //   "scrollX": true
    });

    table.buttons().container()
        .appendTo('#example_wrapper .row .col-md-6:eq(0)');
    // .appendTo('#example_wrapper .col-md-6:eq(0)');
});
</script>
@endsection
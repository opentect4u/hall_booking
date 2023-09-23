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
                                        <th class="text-center">Room Name</th>
                                        <th class="text-center">Total number of Room</th>
                                        <th class="text-center">Booked Room</th>
                                        <th class="text-center">Available Room</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;?>
                                    @foreach($datas as $data)
                                    <tr class="text-center">
                                        <td>{{$i++}}</td>
                                        <td>{{date('d-m-Y',strtotime($data->date))}}</td>
                                        <td>{{$data->room_name}}</td>
                                        <td>{{$data->total_room}}</td>
                                        <td>{{$data->booked_room}}</td>
                                        <td>{{$data->total_room -$data->booked_room}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4> No record Found</h4>
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
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css"> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css"> -->

<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script> -->
<script>
$("#from_date").datepicker({
    format: 'dd-mm-yyyy',
    // todayHighlight: true,
    orientation: 'down',
    autoclose: true,
    // startDate: new Date(result),
    // endDate: new Date(maxbooking_date_format)
    endDate: new Date()
});

$("#to_date").datepicker({
    format: 'dd-mm-yyyy',
    // todayHighlight: true,
    orientation: 'down',
    autoclose: true,
    // startDate: new Date(result),
    // endDate: new Date(maxbooking_date_format)
    endDate: new Date()
});
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
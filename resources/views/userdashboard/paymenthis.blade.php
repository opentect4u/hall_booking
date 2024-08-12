@extends('userdashboard.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title card_title_cus">Payment Detail</h3>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th>Booking Id</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Booking Time</th>
                                    <th>Booking from/To</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                @foreach($datas as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$data->booking_id}}</td>
                                    <?php if($data->customer_type_flag == 'I') { ?>
                                    <td style="width: 20%;text-wrap: balance;">
                                    {{$data->first_name}} {{$data->middle_name}} {{$data->last_name}} 
                                   </td>
                                    <?php }else {?>
                                    <td> {{$data->organisation_name}}</td>
                                    <?php } ?>
                                    <td>{{$data->amount}}</td>
                                    <td>{{date('d-m-Y H:i:s',strtotime($data->booking_time))}}</td>
                                    <td>{{date('d-m-Y',strtotime($data->from_date))}} / {{date('d-m-Y',strtotime($data->to_date))}}</td>
                                   
                                    
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
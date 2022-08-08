@extends('common.master')
@section('content')
<!-- <div class="bannerSecInner">
    <div class="wrapper">
        <div class="col-sm-12">
            <h2>Notices</h2>
        </div>
    </div>
</div> -->
<div class="innerContentSec">
    <div class="wrapper">
        <div class="innerContentTxt">
            <div class="col-sm-12">
                <h1>Room Booking Details</h1>
                <div class="downloadList">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <td class="sl_Not">SL.</td>
                                <td class="date_Not">Booking Id</td>
                                <td class="date_Not">From Date</td>
                                <td class="date_Not">To Date</td>
                                <td class="status_Not">Status</td>
                                <td class="status_Not">Action</td>
                            </tr>
                        </thead>
                        @if(count($datas)>0)
                        <tbody>

                            @foreach($datas as $key => $data)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$data->booking_id}}</td>
                                <td>{{$data->from_date}}</td>
                                <td>{{$data->to_date}}</td>
                                <td>@if($data->booking_status=='A'){{"Confirm"}}@else{{'Cancel'}}@endif</td>
                                <td>
                                    <a href="{{route('bookinDetails',['booking_id'=>$data->booking_id])}}"><i
                                            class="fa fa-eye" aria-hidden="true"></i> View</a>
                                    <a href="javascript:void(0)"
                                        onclick="Cancel('{{$data->booking_id}}',{{$data->id}})"><i
                                            class="fa fa-close"></i> Cancel</a>
                                    <!-- <a href="" class="redBtnRound" target="_blank"><i class="fa fa-file-pdf-o"
                                            aria-hidden="true"></i> Download</a> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <div class="innerContentTxt">
            <div class="col-sm-12">
                <h1>Hall Booking Details</h1>
                <div class="downloadList">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <td class="sl_Not">SL.</td>
                                <td class="date_Not">Booking Id</td>
                                <td class="date_Not">Form Date</td>
                                <td class="date_Not">To Date</td>
                                <td class="name_Not"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Notice</td>
                                <td class="status_Not">Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>3, Aug <span>2022</span></td>
                                <td> Self-Sanction Power Financial Year 22-23<br>
                                </td>
                                <td>
                                    <a href="https://www.wbscardb.com/wp-content/uploads/2022/08/Self-Sanction-Power_FY-22-23.pdf"
                                        class="redBtnRound" target="_blank"><i class="fa fa-file-pdf-o"
                                            aria-hidden="true"></i> Download</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection


@section('script')


<script>
function Cancel(booking_id, id) {
    // alert(id)
    let text;
    if (confirm("Are you sure you want cancel booking?") == true) {
        text = "Your Booking cancel Successfully!";
        alert(text)
    } 
    // else {
    //     // text = "You canceled!";
    //     // alert(text)
    // }
}
</script>
@endsection
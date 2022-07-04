@extends('common.master')
@section('content')

<div class="wrapper">
    <div class="col-md-12">
        <ul class="confirmation-step">
            <li><a href="#" class="active"><span>1</span> Hotel Details</a></li>
            <li><a href="#"><span>2</span> Guest Details</a></li>
            <li><a href="#"><span>3</span> Payment</a></li>
            <li><a href="#"><span>4</span> Confirm</a></li>
        </ul>
    </div>
</div>



<div class="bookingInnerPage">
    <div class="wrapper">
        <div class="col-sm-8 float-left innerContentTxt">
            <div class="card">
                @if($searched->success=="F")
                <h4 class="title222">Payment Failed</h4>
                <hr>
                <h4 class="title222">Failed Id : {{$searched->failed_id}}</h4>
                @elseif($searched->success=="S")
                <h4 class="title222">Payment Success</h4>
                <hr>

                <h4 class="title222">Booking Id : {{$searched->booking_id}}</h4>
                <hr>
                @else
                <h4 class="title222">Something Wrong</h4>
                <hr>
                @endif

              

            </div>
        </div>

      



    </div>
</div>


@endsection

@section('script')

@endsection
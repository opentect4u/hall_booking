@extends('common.master')
@section('content')

<div class="wrapper">
    <div class="col-md-12">
        <!-- <ul class="confirmation-step">
            <li><a href="#" class="active"><span>1</span> Hotel Details</a></li>
            <li><a href="#" class="active"><span>2</span> Guest Details</a></li>
            <li><a href="#" class="active"><span>3</span> Payment</a></li>
            <li><a href="#" class="active"><span>4</span> Confirm</a></li>
        </ul> -->
    </div>
</div>
<div class="bookingInnerPage">
    <div class="wrapper">
        <div class="col-sm-12 float-left innerContentTxt confirmPage">
            <div class="card align-items-center">
                <img src="{{ asset('public/user/images/done.png') }}" alt="done" style="width:120px;"
                    class="img-fluid m-auto">
                <!-- <h1 class="font-weight-600 mt-4">Thank You</h1> -->
                <h4>Booking Failed </h4>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection
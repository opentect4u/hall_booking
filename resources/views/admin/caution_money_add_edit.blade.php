@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cancel Plan {{ isset($customer)?'Edit':'Add'}}</h4>
                    @if(Session::has('update'))
                    <div class="alert alert-success" role="alert">Location updated successfully.</div>
                    @endif
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" method="post" action="{{ isset($customer)?route('admin.cautionMoneyeditconfirm'):route('admin.cautionMoneyadd')}}"> 
                        @csrf
                        <input type="text" hidden name="id" id="id" value="{{isset($customer)?$customer->id:''}}">
                        <div class="form-group">
                            <label for="exampleInputName1">Effective Date </label>
                            <input type="text" class="form-control" required name="effective_date"  id="effective_date" value="{{isset($customer)?date('d-m-Y',strtotime($customer->effective_date)):''}}" placeholder="DD-MM-YYYY">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Room Type </label>
                            <select name="room_type_id" id="room_type_id" required class="form-control">
                                <option value=""> -- Select -- </option>
                                @foreach($room_types as $room_type)
                                <option value="{{$room_type->id}}" <?php if(isset($customer) && $customer->room_type_id==$room_type->id){echo "selected";}?>>{{$room_type->type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">percentage </label>
                            <input type="text" class="form-control" required name="percentage"  id="percentage" value="{{isset($customer)?$customer->percentage:''}}" placeholder="percentage">
                        </div>
                        <!-- <button type="submit" class="btn btn-primary mr-2">Submit</button> -->
                        <input type="submit" class="btn btn-primary mr-2" value="{{ isset($customer)?'Submit':'Add'}}">
                        <!-- <button class="btn btn-light">Cancel</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')


@endsection
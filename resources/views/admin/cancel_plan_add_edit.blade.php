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
                    <form class="forms-sample" method="post" action="{{ isset($customer)?route('admin.cancelPlaneditconfirm'):route('admin.cancelPlanadd')}}"> 
                        @csrf
                        <input type="text" hidden name="id" id="id" value="{{isset($customer)?$customer->id:''}}">
                        <div class="form-group">
                            <label for="exampleInputName1">From day </label>
                            <input type="text" class="form-control" required name="from_day"  id="from_day" value="{{isset($customer)?$customer->from_day:''}}" placeholder="From day">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">To day </label>
                            <input type="text" class="form-control" required name="to_day"  id="to_day" value="{{isset($customer)?$customer->to_day:''}}" placeholder="To day">
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
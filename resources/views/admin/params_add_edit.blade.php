@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Param {{ isset($customer)?'Edit':'Add'}}</h4>
                    @if(Session::has('update'))
                    <div class="alert alert-success" role="alert">Param updated successfully.</div>
                    @endif
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" method="post" action="{{ isset($customer)?route('admin.paramseditconfirm'):route('admin.paramsadd')}}"> 
                        @csrf
                        <input type="text" hidden name="id" id="id" value="{{isset($customer)?$customer->id:''}}">
                        <div class="form-group">
                            <label for="exampleInputName1">Description </label>
                            <input type="text" class="form-control" required name="description"  id="description" value="{{isset($customer)?$customer->description:''}}" placeholder="Description">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Value </label>
                            <input type="text" class="form-control" required name="value"  id="value" value="{{isset($customer)?$customer->value:''}}" placeholder="Value">
                        </div>
                        <!-- <button type="submit" class="btn btn-primary mr-2">Submit</button> -->
                        <input type="submit" class="btn btn-primary mr-2" value="{{ isset($customer)?'Edit':'Add'}}">
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
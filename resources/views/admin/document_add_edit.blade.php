@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Documents {{ isset($customer)?'Edit':'Add'}}</h4>
                    @if(Session::has('update'))
                    <div class="alert alert-success" role="alert">Documents updated successfully.</div>
                    @endif
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" method="post" action="{{ isset($customer)?route('admin.documenteditconfirm'):route('admin.documentadd')}}"> 
                        @csrf
                        <input type="text" hidden name="id" id="id" value="{{isset($customer)?$customer->id:''}}">
                        <div class="form-group">
                            <label for="exampleInputName1">Document </label>
                            <input type="text" class="form-control" required name="document"  id="document" value="{{isset($customer)?$customer->document:''}}" placeholder="Document">
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
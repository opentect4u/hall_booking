@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Room Type {{ isset($customer)?'Edit':'Add'}}</h4>
                    @if(Session::has('update'))
                    <div class="alert alert-success" role="alert">Location updated successfully.</div>
                    @endif
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" method="post" action="{{ isset($customer)?route('admin.roomTypeeditconfirm'):route('admin.roomTypeadd')}}"> 
                        @csrf
                        <input type="text" hidden name="id" id="id" value="{{isset($customer)?$customer->id:''}}">
                        <div class="form-group">
                            <label for="exampleInputName1">Name </label>
                            <input type="text" class="form-control" required name="type"  id="type" value="{{isset($customer)?$customer->type:''}}" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Location </label>
                            <select name="location_id" id="location_id" required class="form-control">
                                <option value=""> -- Select -- </option>
                                @foreach($locations as $location)
                                <option value="{{$location->id}}" <?php if(isset($customer) && $customer->location_id==$location->id){echo "selected";}?>>{{$location->location}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Maximum Accomodation / Number in Adult</label>
                            <input type="number" class="form-control" required name="max_accomodation_number"  id="max_accomodation_number" value="{{isset($customer)?$customer->max_accomodation_number:''}}" placeholder="Number">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Maximum Accomodation / Number in Child</label>
                            <input type="number" class="form-control" required name="max_child_number" id="max_child_number" value="{{isset($customer)?$customer->max_child_number:''}}" placeholder="Number">
                        </div>
                        <!-- <button type="submit" class="btn btn-primary mr-2">Submit</button> -->
                        <input type="submit" class="btn btn-primary mr-2" value="{{ isset($customer)?'Edit':'Save'}}">
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
@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Room {{ isset($customer)?'Edit':'Add'}}</h4>
                    @if(Session::has('update'))
                    <div class="alert alert-success" role="alert">Location updated successfully.</div>
                    @endif
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" method="post" action="{{ isset($customer)?route('admin.roomseditconfirm'):route('admin.roomsadd')}}"> 
                        @csrf
                        <input type="text" hidden name="id" id="id" value="{{isset($customer)?$customer->id:''}}">
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
                            <label for="exampleInputName1">Room No </label>
                            <input type="text" class="form-control" required name="room_no"  id="room_no" value="{{isset($customer)?$customer->room_no:''}}" placeholder="Room No">
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
                            <label for="exampleInputName1">Room Name </label>
                            <input type="text" class="form-control" required name="room_name"  id="room_name" value="{{isset($customer)?$customer->room_name:''}}" placeholder="Room Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">No of Person </label>
                            <input type="text" class="form-control" required name="no_person"  id="no_person" value="{{isset($customer)?$customer->no_person:''}}" placeholder="No of Person">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Floor</label>
                            <input type="text" class="form-control" required name="floor"  id="floor" value="{{isset($customer)?$customer->floor:''}}" placeholder="Floor">
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
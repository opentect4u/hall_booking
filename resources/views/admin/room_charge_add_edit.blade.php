@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Room Charge {{ isset($customer)?'Edit':'Add'}}</h4>
                    @if(Session::has('update'))
                    <div class="alert alert-success" role="alert">Location updated successfully.</div>
                    @endif
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" method="post"
                        action="{{ isset($customer)?route('admin.roomChargeeditconfirm'):route('admin.roomChargeadd')}}">
                        @csrf
                        <input type="text" hidden name="id" id="id" value="{{isset($customer)?$customer->id:''}}">

                        <div class="form-group">
                            <label for="exampleInputName1">Room Type </label>
                            <select name="room_type_id" id="room_type_id" required class="form-control">
                                <option value=""> -- Select -- </option>
                                @foreach($room_types as $room_type)
                                <option value="{{$room_type->id}}"
                                    <?php if(isset($customer) && $customer->room_type_id==$room_type->id){echo "selected";}?>>
                                    {{$room_type->type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Effective Date</label>
                            <input type="text" class="form-control" required name="effective_date" id="effective_date"
                                value="{{isset($customer)?date('d-m-Y',strtotime($customer->effective_date)):''}}"
                                placeholder="DD-MM-YYYY">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName1">Hour Flag </label>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="hour_flag" required
                                                    id="hour_flag1" value="Y" <?php if(isset($customer) && $customer->hour_flag=='Y'){echo "checked";}?> onClick="HourFlag()">
                                                Yes
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="hour_flag"
                                                    id="hour_flag2" value="N" <?php if(isset($customer) && $customer->hour_flag=='N'){echo "checked";}?> onClick="HourFlag()">
                                                No
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <input type="text" class="form-control" required name="room_name" id="room_name"
                                value="{{isset($customer)?$customer->room_name:''}}" placeholder="Room Name"> -->
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Per Bed Flag</label>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="per_bed_flag" required
                                                    id="per_bed_flag1" value="Y" <?php if(isset($customer) && $customer->per_bed_flag=='Y'){echo "checked";}?> onClick="PerBedFlag()">Yes<i class="input-helper"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="per_bed_flag"
                                                    id="per_bed_flag2" value="N" <?php if(isset($customer) && $customer->per_bed_flag=='N'){echo "checked";}?> onClick="PerBedFlag()">No<i
                                                    class="input-helper"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Amount</label>
                            <input type="text" class="form-control" required name="amount" id="amount"
                                value="{{isset($customer)?$customer->amount:''}}" placeholder="Amount">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Discount (%)</label>
                            <input type="text" class="form-control" required name="discount_percentage"
                                id="discount_percentage" value="{{isset($customer)?$customer->discount_percentage:''}}"
                                placeholder="Discount">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Holiday Amount</label>
                            <input type="text" class="form-control" required name="holiday_amount" id="holiday_amount"
                                value="{{isset($customer)?$customer->holiday_amount:''}}" placeholder="Holiday Amount">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">CGST Rate (%)</label>
                            <input type="text" class="form-control" required name="cgst_rate" id="cgst_rate"
                                value="{{isset($customer)?$customer->cgst_rate:''}}" placeholder="CGST Rate">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">SGST Rate (%)</label>
                            <input type="text" class="form-control" required name="sgst_rate" id="sgst_rate"
                                value="{{isset($customer)?$customer->sgst_rate:''}}" placeholder="SGST Rate">
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

<script>
$(document).ready(function() {
    // console.log("ready!");
    // alert('hii');
    // HourFlag
    // PerBedFlag

});

function HourFlag() {
    var hour_flag=$('input[name=hour_flag]:checked').val();
    // var per_bed_flag=$('input[type="radio"][name=per_bed_flag]').val();
    // alert("hour_flag : " + hour_flag);
    if (hour_flag=='Y') {
        $('#per_bed_flag1').prop('checked',false); 
        $('#per_bed_flag2').prop('checked',true); 
    } else  {
        // alert('hii')
        $('#per_bed_flag2').prop('checked',false); 
        $('#per_bed_flag1').prop('checked', true); 
    }

}
function PerBedFlag() {
    var per_bed_flag=$('input[name=per_bed_flag]:checked').val();
    // alert("per_bed_flag : "+per_bed_flag);
    if (per_bed_flag=='Y') {
        $('#hour_flag1').prop('checked',false); 
        $('#hour_flag2').prop('checked', true); 
    } else {
        // alert('hii')
        // $('#hour_flag2').prop('checked', false); 
        $('#hour_flag2').prop('checked', false); 
        $('#hour_flag1').prop('checked',true); 
    }

}
</script>
@endsection
@extends('userdashboard.common.master')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Profile Update</h3>
            <form name="" method="POST" action="{{route('profileupdate')}}" autocomplete="off">
            @csrf
            <div class="row">
            
                <div class="col-12">
                    <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Contact No <span>*</span></label>
                                                    <input type="number"  class="form-control" value="{{$datas->mobile_no}}" readonly/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email id <span>*</span></label>
                                                    <input type="email" required="" name="email" class="form-control" value="{{$datas->email}}">
                                                </div>
                                            </div>
                    </div>
                    <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Name <span>*</span></label>
                                                        <input type="text" required="" name="name" class="form-control" value="{{$datas->name}}">
                                                    </div>
                                                </div>
                    </div>
                        <!-- <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Post code <span>*</span></label>
                                                    <input type="text" required="" name="post_code" class="form-control"  value="{{$datas->pin}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>State <span>*</span></label>
                                                    <select name="state" id="state" class="form-control" required="">
                                                        <option value=""> -- Select State -- </option>
                                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                        <option value="Assam">Assam</option>
                                                        <option value="Bihar">Bihar</option>
                                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                                        <option value="Goa">Goa</option>
                                                        <option value="Gujarat">Gujarat</option>
                                                        <option value="Haryana">Haryana</option>
                                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                        <option value="Jharkhand">Jharkhand</option>
                                                        <option value="Karnataka">Karnataka</option>
                                                        <option value="Kerala">Kerala</option>
                                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                        <option value="Maharashtra">Maharashtra</option>
                                                        <option value="Manipur">Manipur</option>
                                                        <option value="Meghalaya">Meghalaya</option>
                                                        <option value="Mizoram">Mizoram</option>
                                                        <option value="Nagaland">Nagaland</option>
                                                        <option value="Odisha">Odisha</option>
                                                        <option value="Punjab">Punjab</option>
                                                        <option value="Rajasthan">Rajasthan</option>
                                                        <option value="Sikkim">Sikkim</option>
                                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                                        <option value="Telangana">Telangana</option>
                                                        <option value="Tripura">Tripura</option>
                                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                        <option value="Uttarakhand">Uttarakhand</option>
                                                        <option value="West Bengal">West Bengal</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address<span>*</span></label>
                                                    <textarea name="address" id="address" cols="" rows="2" required="" class="form-control" placeholder="Enter Address"></textarea>
                                                </div>
                                            </div>
                       </div> -->
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" >
                                <input type ="submit" name="submit" value="submit" class="btn btn-success">
                                </div>
                            </div>    
                       </div>
                </div>
               


            </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('script')


@endsection
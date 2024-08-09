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
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Name / Organisation <span>*</span></label>
                                                        <input type="text" required="" name="name" class="form-control" value="{{$datas->name}}">
                                                    </div>
                                                </div>
                    </div>
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
                                                        <option value="Andhra Pradesh" <?php if($datas->state == "Andhra Pradesh") echo 'selected'; ?> >Andhra Pradesh</option>
                                                        <option value="Arunachal Pradesh" <?php if($datas->state == "Arunachal Pradesh") echo 'selected'; ?>>Arunachal Pradesh</option>
                                                        <option value="Assam" <?php if($datas->state == "Assam") echo 'selected'; ?> >Assam</option>
                                                        <option value="Bihar" <?php if($datas->state == "Bihar") echo 'selected'; ?> >Bihar</option>
                                                        <option value="Chhattisgarh" <?php if($datas->state == "Chhattisgarh") echo 'selected'; ?> >Chhattisgarh</option>
                                                        <option value="Goa" <?php if($datas->state == "Goa") echo 'selected'; ?> >Goa</option>
                                                        <option value="Gujarat" <?php if($datas->state == "Gujarat") echo 'selected'; ?> >Gujarat</option>
                                                        <option value="Haryana" <?php if($datas->state == "Haryana") echo 'selected'; ?> >Haryana</option>
                                                        <option value="Himachal Pradesh" <?php if($datas->state == "Himachal Pradesh") echo 'selected'; ?> >Himachal Pradesh</option>
                                                        <option value="Jharkhand" <?php if($datas->state == "Jharkhand") echo 'selected'; ?> >Jharkhand</option>
                                                        <option value="Karnataka" <?php if($datas->state == "Karnataka") echo 'selected'; ?> >Karnataka</option>
                                                        <option value="Kerala" <?php if($datas->state == "Kerala") echo 'selected'; ?> >Kerala</option>
                                                        <option value="Madhya Pradesh" <?php if($datas->state == "Madhya Pradesh") echo 'selected'; ?>>Madhya Pradesh</option>
                                                        <option value="Maharashtra" <?php if($datas->state == "Maharashtra") echo 'selected'; ?> >Maharashtra</option>
                                                        <option value="Manipur" <?php if($datas->state == "Manipur") echo 'selected'; ?>>Manipur</option>
                                                        <option value="Meghalaya" <?php if($datas->state == "Meghalaya") echo 'selected'; ?> >Meghalaya</option>
                                                        <option value="Mizoram" <?php if($datas->state == "Mizoram") echo 'selected'; ?> >Mizoram</option>
                                                        <option value="Nagaland" <?php if($datas->state == "Nagaland") echo 'selected'; ?>>Nagaland</option>
                                                        <option value="Odisha" <?php if($datas->state == "Odisha") echo 'selected'; ?>>Odisha</option>
                                                        <option value="Punjab" <?php if($datas->state == "Punjab") echo 'selected'; ?> >Punjab</option>
                                                        <option value="Rajasthan" <?php if($datas->state == "Rajasthan") echo 'selected'; ?> >Rajasthan</option>
                                                        <option value="Sikkim" <?php if($datas->state == "Sikkim") echo 'selected'; ?> >Sikkim</option>
                                                        <option value="Tamil Nadu" <?php if($datas->state == "Tamil Nadu") echo 'selected'; ?> >Tamil Nadu</option>
                                                        <option value="Telangana" <?php if($datas->state == "Telangana") echo 'selected'; ?> >Telangana</option>
                                                        <option value="Tripura" <?php if($datas->state == "Tripura") echo 'selected'; ?> >Tripura</option>
                                                        <option value="Uttar Pradesh" <?php if($datas->state == "Uttar Pradesh") echo 'selected'; ?> >Uttar Pradesh</option>
                                                        <option value="Uttarakhand" <?php if($datas->state == "Uttarakhand") echo 'selected'; ?> >Uttarakhand</option>
                                                        <option value="West Bengal" <?php if($datas->state == "West Bengal") echo 'selected'; ?> >West Bengal</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address<span>*</span></label>
                                                    <textarea name="address" id="address" cols="" rows="2" required="" class="form-control" placeholder="Enter Address">{{$datas->address}}</textarea>
                                                </div>
                                            </div>
                       </div>
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
@extends('common.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<div class="userloginContentSec">
    <div class="wrapper">
        <div class="col-sm-12" style="text-align:center;margin-bottom:20px">
            <h1>Login</h1>
        </div>
        <div class="col-sm-12 float-left">
        <form name="" method="POST" action="{{route('userloginprocess')}}"
        autocomplete="off">
        @csrf
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                        <div class="form-group">
                        <label>Please Enter Your Booking Mobile Number</label>
                        <input type="number" name="mobile_num" id="mobile_num" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="generateBtn" onclick="getotp()">
                                    Generate OTP
                                    </button>
                                </div>
                                <div class="col-md-4" style="display:none" id="Enterotp">
                                    <div id="inputs" class="inputs">
                                        <input type="text" class="input form-control" name="otp" inputmode="numeric" maxlength="6" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="submitdic" style="display:none">
                        <input type ="submit" name="submit" value="submit" class="btn btn-success">
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
function getotp() {
    
    var mobile_num = $('#mobile_num').val();
    if(mobile_num.length == 10){
        $.ajax({
        url: "{{route('generateotp')}}",
        method: "POST",
        data: {
            mobile_num: mobile_num
        },
        success: function(data) {
             if(data == 0 ){
                alert('Phone Number Not Registered With US')
             }else{
                $('#mobile_num').attr('readonly','true');
                $('#Enterotp').show();
                $('#submitdic').show();
               
             }
          
        }
       });
    }else{
        alert('Please Give Valid Ph number');
    }
    
}

</script>
<script>
    
    @if (session('success'))
    toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
@endsection
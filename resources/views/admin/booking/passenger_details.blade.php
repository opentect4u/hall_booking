<div class="form-group row">
    <div class="col">
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check" type="radio" id="individual" name="customer_type_flag" value="I" checked
                    required class="form-control">
                Individual
                <i class="input-helper"></i></label>
        </div>
    </div>
    <div class="col">
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check" type="radio" id="organisation" name="customer_type_flag" value="O" required
                    class="form-control">Organisation
                <i class="input-helper"></i></label>
        </div>

    </div>

</div>

@for ($i=0; $i < $adult_no ; $i++) <p class="card-description">Adult {{($i+1)}}</p>
    <div class="form-group row">
        <div class="col">
            <label>First Name</label>
            <input type="text" name="adt_first_name{{$i}}" id="adt_first_name{{$i}}" required value="" placeholder=""
                class="form-control">
        </div>
        <div class="col">
            <label>Middle Name</label>
            <input type="text" name="adt_middle_name{{$i}}" id="adt_middle_name{{$i}}" value="" placeholder=""
                class="form-control">
        </div>
        <div class="col">
            <label>Last Name</label>
            <input type="text" name="adt_last_name{{$i}}" id="adt_last_name{{$i}}" required value="" placeholder=""
                class="form-control">
        </div>
    </div>
    @endfor
    @for ($j=0; $j < $child_no ; $j++) <p class="card-description">Child {{($j+1)}}</p>
        <div class="form-group row">
            <div class="col">
                <label>First Name</label>
                <input type="text" name="child_first_name{{$j}}" id="child_first_name{{$j}}" required value=""
                    placeholder="" class="form-control">
            </div>
            <div class="col">
                <label>Middle Name</label>
                <input type="text" name="child_middle_name{{$j}}" id="child_middle_name{{$j}}" value="" placeholder=""
                    class="form-control">
            </div>
            <div class="col">
                <label>Last Name</label>
                <input type="text" name="child_last_name{{$j}}" id="child_last_name{{$j}}" required value=""
                    placeholder="" class="form-control">
            </div>
            <div class="col">
                <label>Age</label>
                <input type="text" name="age{{$j}}" id="age{{$j}}" required value="" placeholder=""
                    class="form-control child_age">
            </div>

        </div>
        @endfor
        <p class="card-description">Billing details</p>
        <div id="organisationDiv">
            <div class="form-group row">
                <div class="col">
                    <div class="form-group">
                        <label>GSTIN</label>
                        <input type="text" name="GSTIN" class="form-control" placeholder="Enter GSTIN">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>PAN</label>
                        <input type="text" name="PAN" class="form-control" placeholder="Enter PAN">
                    </div>
                </div>
            </div>
            <div class="form-group row">

                <div class="col">
                    <div class="form-group">
                        <label>TAN</label>
                        <input type="text" name="TAN" class="form-control" placeholder="Enter TAN">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Registration No.</label>
                        <input type="text" name="RegistrationNo" class="form-control"
                            placeholder="Enter Registration No.">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label>Pin Code</label>
                <input type="text" name="post_code" id="post_code" placeholder=""  class="form-control">
            </div>
            <div class="col">
                <label>State</label>
                <select name="state" id="state" required class="form-control">
                    <option value=""> -- Select State -- </option>
                    @foreach($states as $state)
                    <option value="{{$state->name}}">{{$state->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">

            <div class="col">
                <label>Address</label>
                <textarea name="address" id="address" cols="30" rows="3"  class="form-control"></textarea>
                <!-- <input type="text" name="address" id="address" placeholder="" required class="form-control"> -->
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label>Email</label>
                <input type="email" name="email" id="email" placeholder=""  class="form-control">
            </div>
            <div class="col">
                <label>Contact</label>
                <input type="text" name="contact" id="contact" placeholder="" required class="form-control">
            </div>

        </div>
        <div class="form-group row">
        </div>

        <script>
        $('#organisationDiv').hide();
        $('input:radio[name="customer_type_flag"]').change(function() {
            // alert($(this).val())
            if ($(this).val() == 'I') {
                $('#organisationDiv').hide();
            } else {
                $('#organisationDiv').show();
            }
        });
        $('.child_age').change(function() {

            var age= $(this).val();
            var id = $(this).attr("id");
            if(age > 17){
                alert('Child age must below 17');
                $('#'+id).val('');
            }

        })
        </script>
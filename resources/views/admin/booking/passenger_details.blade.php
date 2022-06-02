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
                <label>First</label>
                <input type="text" name="child_first_name{{$j}}" id="child_first_name{{$j}}" required value=""
                    placeholder="" class="form-control">
            </div>
            <div class="col">
                <label>No of Child</label>
                <input type="text" name="child_middle_name{{$j}}" id="child_middle_name{{$j}}" value="" placeholder=""
                    class="form-control">
            </div>
            <div class="col">
                <label>No of Adult</label>
                <input type="text" name="child_last_name{{$j}}" id="child_last_name{{$j}}" required value=""
                    placeholder="" class="form-control">
            </div>

        </div>
        @endfor
        <p class="card-description">Billing details</p>
        <div class="form-group row">
            <div class="col">
                <label>post code</label>
                <input type="text" name="post_code" id="post_code" placeholder="" required class="form-control">
            </div>
            <div class="col">
                <label>Address</label>
                <input type="text" name="address" id="address" placeholder="" required class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label>City</label>
                <input type="text" name="city" id="city" placeholder="" required class="form-control">
            </div>
            <div class="col">
                <label>Country</label>
                <input type="text" name="country" id="country" placeholder="" required class="form-control">
            </div>

        </div>
        <div class="form-group row">
            <div class="col">
                <label>Email</label>
                <input type="email" name="email" id="email" placeholder="" required class="form-control">
            </div>
            <div class="col">
                <label>Contact</label>
                <input type="text" name="contact" id="contact" placeholder="" required class="form-control">
            </div>

        </div>
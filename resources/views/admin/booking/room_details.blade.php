<div class="form-group row">
    <label class="col-sm-6">Select {{$room_type}} Rooms</label>
    <label class="col-sm-6"><b>Total Amount : <span id="totalAmount">0 </span></b></label>
    <?php 
    // print_r($lock_room_array);
    // if(in_array(2 ,$lock_room_array)){echo "checked";}
    ?>
    <input type="text" hidden name="max_person_number" id="max_person_number" value="{{$max_person_number}}">
    <input type="text" hidden id="normal_rate" name="normal_rate" value="{{$room_rent[0]['normal_rate']}}">
    <input type="text" hidden id="interval" name="interval" value="{{$interval}}">
    @foreach($datas as $data)
    @if(in_array( $data->id ,$lock_room_array))
    <div class="col-sm-2">
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" name="" id="" value="{{$data->id}}"
                    class="form-check-input" disabled checked>
                {{$data->room_no." No"}}
                <i class="input-helper"></i></label>
        </div>
    </div>
    @else
    <div class="col-sm-2">
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" name="room_no[]" id="room_no_{{$data->id}}" value="{{$data->id}}"
                    class="form-check-input roomNoChecked">
                {{$data->room_no." No"}}
                <i class="input-helper"></i></label>
        </div>
    </div>
    @endif
    <script>
    $('#room_no_' + <?php echo $data->id;?>).change(function() {
        // alert('hii')
        // $('#textbox1').val($(this).is(':checked'));
        var x = $(".roomNoChecked:checked").length;
        $("#total_room_no").val()
        $("#total_room_no").val(x)

        // $("#room_no").removeAttr("readonly");
        // $("#room_no").attr('readonly');
        // $('#someid').attr("readonly", "readonly");
        var totalperson='';
        for (let index = 1; index <= x; index++) {
            // const element = array[index];
            totalperson +='<div class="form-group row"><label class="col-sm-12">Room '+index+'</label><div class="col">'
            +'<label>Adult No</label><input type="number" name="adult_no_'+index+'" id="adult_no_'+index+'" value="1" class="form-control" placeholder=""></div>'
            +'<div class="col"><label>Child No</label><input type="number" name="child_no_'+index+'" id="child_no_'+index+'" value="0" class="form-control" placeholder=""></div></div>'
        }
        // roomPerson
        $("#roomPerson").empty();
        $("#roomPerson").append(totalperson);

        var normal_rate=$('#normal_rate').val()
        var interval=$('#interval').val()
        var totalamount=(Number(normal_rate) * Number(interval)) * Number(x);
        // totalAmount
        $("#totalAmount").empty();
        $("#totalAmount").append(totalamount);
    });
    </script>
    @endforeach
    
</div>

<!-- <div class="form-group row">
    <label class="col-sm-12">Room 1</label>
    <div class="col">
        <label>Adult No</label>
        <input type="number" name="adult_no" id="adult_no" value="1" class="form-control" placeholder="">
    </div>
    <div class="col">
        <label>Child No</label>
        <input type="number" name="child_no" id="child_no" value="0" class="form-control" placeholder="">
    </div>
</div> -->
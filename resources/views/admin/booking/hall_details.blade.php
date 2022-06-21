<div class="form-group row">
    <label class="col-sm-6">Select {{$room_type}} Rooms</label>
    <label class="col-sm-6"><b>Total Amount : <span id="totalAmount">0 </span></b></label>

    <input type="text" hidden name="max_person_number" id="max_person_number" value="{{$max_person_number}}">
    <input type="text" hidden name="max_child_number" id="max_child_number" value="{{$max_child_number}}">
    <input type="text" hidden id="interval" name="interval" value="{{$interval}}">
    @foreach($datas as $data)
    @if(in_array( $data->id ,$lock_room_array))
    <div class="col-sm-2">
        <div class="form-check">
            <label class="form-check-label" style="text-decoration:line-through;">
                <input type="checkbox" name="" id="" value="{{$data->id}}" class="form-check-input" disabled checked>
                {{$data->room_no}}
                <i class="input-helper"></i></label>
        </div>
    </div>
    @else
    <?php 
     $room_rent= DB::table('md_hall_rent')->where('room_id',$data->id)->get(); 
    ?>
    <input type="text" hidden id="normal_rate_{{$data->id}}" name="normal_rate_{{$data->id}}" value="{{$room_rent[0]->normal_rate}}">
    <input type="text" hidden id="cgst_rate_{{$data->id}}" name="cgst_rate_{{$data->id}}" value="{{$room_rent[0]->cgst_rate}}">
    <input type="text" hidden id="sgst_rate_{{$data->id}}" name="sgst_rate_{{$data->id}}" value="{{$room_rent[0]->sgst_rate}}">
    <div class="col-sm-2">
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" name="room_no[]" id="room_no_{{$data->id}}" value="{{$data->id}}"
                    class="form-check-input roomNoChecked">
                {{$data->room_no}}
                <i class="input-helper"></i></label>
        </div>
    </div>
    @endif
    <script>
    $('#room_no_' + <?php echo $data->id;?>).change(function() {
        // alert('hii')
        $("#setp2").val();
        $("#setp2").val('Y');
        $("#setp3").val();
        $("#setp3").val('Y');
        // $('#textbox1').val($(this).is(':checked'));
        var x = $(".roomNoChecked:checked").length;
        $("#total_room_no").val()
        $("#total_room_no").val(x)

        var tot_rooms_no = [];
        $('.roomNoChecked:checked').each(function(i) {
            tot_rooms_no[i] = $(this).val();
        });
        Calculation(tot_rooms_no)
        // alert(net)
        // totalAmount
        // $("#totalAmount").empty();
        // $("#totalAmount").append(ulalal);

    });

    function Calculation(tot_rooms_no) {
        // alert(tot_rooms_no);
        var tot_tot_amt=0;
        var interval = $('#interval').val()
        for (let index = 0; index < tot_rooms_no.length; index++) {
            const element = tot_rooms_no[index];
            // alert(element);
            var normal_rate = $('#normal_rate_'+element).val()
            var cgst_rate = $('#cgst_rate_'+element).val()
            var sgst_rate = $('#sgst_rate_'+element).val()
            var totalamount = (Number(normal_rate) * Number(interval));
            var cgst_rate_amount= (totalamount * cgst_rate) / 100;
            var sgst_rate_amount= (Number(totalamount) * Number(sgst_rate)) / 100;
            var tot_tot_amt = (Number(tot_tot_amt) + (Number(totalamount) + Number(cgst_rate_amount) + Number(sgst_rate_amount)));
        }
        $("#totalAmount").empty();
        $("#totalAmount").append(tot_tot_amt);
    }
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
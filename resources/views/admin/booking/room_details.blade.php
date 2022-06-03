<div class="form-group row">
    <label class="col-sm-12">Select {{$room_type}} Rooms</label>
    @foreach($datas as $data)
    <div class="col-sm-2">
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" name="room_no[]" id="room_no_{{$data->id}}" value="{{$data->id}}"
                    class="form-check-input roomNoChecked">
                {{$data->room_no." No"}}
                <i class="input-helper"></i></label>
        </div>
    </div>
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

    });
    </script>
    @endforeach
    <input type="text" hidden name="max_person_number" id="max_person_number" value="{{$max_person_number}}">
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
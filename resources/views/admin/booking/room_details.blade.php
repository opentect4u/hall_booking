<label>Select {{$room_type}} Rooms</label>
@foreach($datas as $data)
<div class="form-check">
    <label class="form-check-label">
        <input type="checkbox" name="room_no[]" id="room_no_{{$data->id}}" value="{{$data->id}}"
            class="form-check-input roomNoChecked">
        {{$data->room_no." No (".$data->room_name.")"}}
        <i class="input-helper"></i></label>
</div>
<script>
$('#room_no_'+<?php echo $data->id;?>).change(function() {
    // alert('hii')
    // $('#textbox1').val($(this).is(':checked'));
    var x = $(".roomNoChecked:checked").length;
    $("#total_room_no").val()
    $("#total_room_no").val(x)

    // $("#room_no").removeAttr("readonly");
    // $("#room_no").attr('readonly');
    // $('#someid').attr("readonly", "readonly");


});
</script>
@endforeach
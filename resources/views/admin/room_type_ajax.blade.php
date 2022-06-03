<option value=""> -- Select -- </option>
@foreach($room_types as $room_type)
<option value="{{$room_type->id}}"
    <?php if($select_location_id!='' && $select_location_id==$room_type->id){echo "selected";}?>>{{$room_type->type}}
</option>
@endforeach
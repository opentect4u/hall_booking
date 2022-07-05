<option value=""> -- Select -- </option>
@foreach($total_rooms as $room_type)
<option value="{{$room_type->id}}">{{$room_type->room_no}}
</option>
@endforeach
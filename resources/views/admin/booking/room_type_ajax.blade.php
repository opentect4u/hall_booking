<option value=""> -- Select -- </option>
@foreach($room_types as $room_type)
<option value="{{$room_type->id}}">{{$room_type->type}}
</option>
@endforeach
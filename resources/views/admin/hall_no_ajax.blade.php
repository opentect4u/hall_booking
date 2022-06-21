
<option value=""> -- Select -- </option>
@foreach($rooms as $room)
<option value="{{$room->id}}" <?php if($select_room_id!='' && $select_room_id==$room->id){echo "selected";}?>>
    {{$room->room_no}}</option>
@endforeach
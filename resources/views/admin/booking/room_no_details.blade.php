
<option value="">Please select Room</option>
@foreach($datas as $rt)
<option value="{{$rt->room_no}}">{{$rt->room_no}}</option>
@endforeach
@foreach($datas as $data)
    @if(in_array( $data->id ,$lock_room_array))

            <!-- <label class="form-check-label" style="text-decoration:line-through;">
                <input type="checkbox" name="" id="" value="{{$data->id}}" class="form-check-input" disabled checked>
                {{$data->room_no}}
                <i class="input-helper"></i></label> -->
    @else
   
            <label class="form-check-label" style="width: 80px;">
                <input type="checkbox" name="room_no[]" id="room_no_{{$data->id}}" value="{{$data->id}},{{$data->room_type_id}}"
                    class="form-check-input roomNoChecked">
                {{$data->room_no}}
                <i class="input-helper"></i></label>
       
    @endif

@endforeach 
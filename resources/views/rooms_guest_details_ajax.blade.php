@for ($i=1; $i <= $rooms ; $i++) <div class="col-12 px-2" id="">
    <div class="form-group">
        Room {{$i}} Details
    </div>
    </div>
    <div class="col-4 px-2">
        <div class="form-group">
            <label>Adults <small>(12+ yrs)</small></label>
            <select name="adults_room{{$i}}" id="adults_room{{$i}}" class="custom-select adult">
                <option value="1">1</option>
                <option value="2">2</option>
                <?php if($room_type_id == 1) { ?>
                    <option value="3">3</option>
                    <?php } ?>
                <!--<option value="3">3</option>
                 <option value="4">4</option> -->
            </select>
        </div>
    </div>
    <div class="col-4 px-2">
        <div class="form-group">
            <label>Child Age 1<small></small></label>
            <select name="child1_room{{$i}}" id="child1_room{{$i}}" class="custom-select">
                <option>0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div>
    </div>
    <div class="col-4 px-2">
        <div class="form-group">
            <label>Child Age 2 <small></small></label>
            <select name="child2_room{{$i}}" id="child2_room{{$i}}" class="custom-select">
                <option>0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div>
    </div>

    <script>
    $('#adults_room' + <?php echo $i;?>).on('change', function() {
        // alert('hii');
        var tot_adult = 0
        var tot_child1 = 0
        var rooms = $('#rooms').val();
        for (let index = 1; index <= rooms; index++) {
            var adults_room = $("#adults_room" + index).val();
            tot_adult = Number(tot_adult) + Number(adults_room)
        }
        for (let j = 1; j <= rooms; j++) {
            var child1_room = $("#child1_room" + j).val();
            if (child1_room > 0) {
                tot_child1 = Number(tot_child1) + 1
            } 
          
        }
        for (let k = 1; k <= rooms; k++) {
            var child2_room = $("#child2_room" + k).val();
            if (child2_room > 0) {
                tot_child1 = Number(tot_child1) + 1
            }
        }

        if (tot_child1 > 0) {
            var roomAdultSelect = rooms + " Rooms, " + tot_adult + " Adult,"+tot_child1+" Child"
        } else {
            var roomAdultSelect = rooms + " Rooms, " + tot_adult + " Adult"
        }
        $("#roomAdultSelect").val();
        $("#roomAdultSelect").val(roomAdultSelect);
    });
    $('#child1_room' + <?php echo $i;?>).on('change', function() {
        // alert('hii');
        var tot_adult = 0
        var tot_child1 = 0
        var rooms = $('#rooms').val();
        for (let index = 1; index <= rooms; index++) {
            var adults_room = $("#adults_room" + index).val();
            tot_adult = Number(tot_adult) + Number(adults_room)
        }
        for (let k = 1; k <= rooms; k++) {
            var child2_room = $("#child2_room" + k).val();
            if (child2_room > 0) {
                tot_child1 = Number(tot_child1) + 1
            } 
        }
        for (let j = 1; j <= rooms; j++) {
            var child1_room = $("#child1_room" + j).val();
            // alert(child1_room)
            if (child1_room > 0) {
                tot_child1 = Number(tot_child1) + 1
            } 
        }
        
        if (tot_child1 > 0) {
            var roomAdultSelect = rooms + " Rooms, " + tot_adult + " Adult, "+tot_child1+" Child"
        } else {
            var roomAdultSelect = rooms + " Rooms, " + tot_adult + " Adult"
        }
        $("#roomAdultSelect").val();
        $("#roomAdultSelect").val(roomAdultSelect);
    });
    $('#child2_room' + <?php echo $i;?>).on('change', function() {
        // alert('hii');
        var tot_adult = 0
        var tot_child1 = 0
        var rooms = $('#rooms').val();
        for (let index = 1; index <= rooms; index++) {
            var adults_room = $("#adults_room" + index).val();
            tot_adult = Number(tot_adult) + Number(adults_room)
        }
        for (let j = 1; j <= rooms; j++) {
            var child1_room = $("#child1_room" + j).val();
            if (child1_room > 0) {
                tot_child1 = Number(tot_child1) + 1
            } 
        }
        for (let k = 1; k <= rooms; k++) {
            var child2_room = $("#child2_room" + k).val();
            if (child2_room > 0) {
                tot_child1 = Number(tot_child1) + 1
            } 
        }

        if (tot_child1 > 0) {
            var roomAdultSelect = rooms + " Rooms, " + tot_adult + " Adult, "+tot_child1+" Child"
        } else {
            var roomAdultSelect = rooms + " Rooms, " + tot_adult + " Adult"
        }
        $("#roomAdultSelect").val();
        $("#roomAdultSelect").val(roomAdultSelect);
    });




    </script>
    @endfor
@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Menu {{ isset($customer)?'Edit':'Add'}}</h4>
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">Memo Number added successfully.</div>
                    @endif
                    <form class="forms-sample" method="post"
                        action="{{ isset($customer)?route('admin.cautionMoneyeditconfirm'):route('admin.addconbill')}}">
                        @csrf
                        <input type="text" hidden name="id" id="id" value="{{isset($customer)?$customer->id:''}}">
                        <input type="text" hidden name="booking_id" id="booking_id" value="">

                        <div class="table-responsive w-100">

                        <table class="table">
                        <thead>
                            <tr>
                            <th>#</th><th>Booking Detail</th>
                                <th>
                                <button type="button" class="btn btn-success addAnotherrow"><i class="fa fa-plus">+</i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="intro2" class="tables">
                        <tr class="text-right" id="row_1">
                                        <td class="text-left">1</td>
                                        <td class="text-left dropDownCus">
                                            <select class="form-control accommodation" name="booking_id[]" id="item_name_1" required
                                                onChange="ItemName(1);">
                                                <option value=""> --Select-- </option>
                                                @foreach($menus as $menu)
                                                <option value="{{$menu->booking_id}}">{{$menu->booking_id}}-<?php echo $menu->first_name; ?> {{$menu->middle_name}} {{$menu->last_name}} {{$menu->organisation_name}}-<?php echo date('d-m-Y H:i:s',strtotime($menu->booking_time)); ?></option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                        </tbody>
					</table>
                            
                        </div>
                        <div class="form-group row">
                            <span>MEMO NUMBER</span>
                            <div class="col"><input type="text" class="form-control" value="" name="memo_no"></div>
                        </div>
                        <div class="form-group row">
                            <span>Addr Line1</span>
                            <div class="col"><input type="text" class="form-control" value="" name="add_line1"></div>
                        </div>
                        <div class="form-group row">
                            <span>Addr Line2</span>
                            <div class="col"><input type="text" class="form-control" value="" name="add_line2"></div>
                        </div>
                        <div class="form-group row">
                            <span>Addr Line3</span>
                            <div class="col"><input type="text" class="form-control" value="" name="add_line3"></div>
                        </div>
                        <div class="form-group row">
                            <span>Addr Line4</span>
                            <div class="col"><input type="text" class="form-control" value="" name="add_line4"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col"></div>
                            <div class="col"><input type="submit" class="btn btn-primary mr-2" value="{{ isset($customer)?'Edit':'Submit'}}"></div>
                        </div>
                     
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')

<script>
var count = 20;
// var x = $('#table tbody > tr').length;
var x = $('#tableDiv > tbody > tr').length;
// alert(x);
$('#dynamic_add').click(function() {
    // alert('hii')
    // var total = parseInt($('#tot_memb').val());
    if (x < count) {
        if ($('#item_name_' + x).val() != '') {
            x++;

            // $('#tbody').append('<tr id="row_' + x + '">' +
            //     '<td class="text-left">' + x + '</td><td class="text-left dropDownCus">' +
            //     '<select class="form-control" name="item_name[]" id="item_name_' + x +
            //     '" required onChange="ItemName(' + x + ');"><option value=""> --Select-- </option>' +
            //     '<?php 
            // foreach($menus as $menu){
            //    echo "<option value=".$menu->id.">".$menu->item_name."</option>"; 
            // }
            // ?>' +
            //     '</select></td>' +
            //     '<td><input type="text" class="form-control" name="amount[]" id="amount_' + x +
            //     '" placeholder="Amount" readonly></td>' +
            //     '<td><input type="text" class="form-control" name="no_of_head[]" id="no_of_head_' + x +
            //     '" placeholder="no of head" required></td>' +
            //     '<td><button type="button" id="remove_' + x +
            //     '" class="btn btn-danger btn-rounded btn-icon" onclick="_delete(' + x +
            //     ')"><i class="mdi mdi-delete"></i></button></td>' +
            //     '</tr>');
           
            // $("#pack_size_" + x).select2();
            // $("#brand_name_" + x).select2();

        } else {
            alert('Please Fill the brand name');
            // alert('Please Fill All Details');
            return false;
        }
        $('#item_name_' + x).on('change', function() {
            // alert('hii');
            var val = $('#item_name_' + x).val();
            // alert(val)
            Price(val, x);
        })


    }
});

function ItemName(id) {
    var val = $('#item_name_'+id).val();
    Price(val, id)
}

function Price(val, x) {
    $.ajax({
        url: "{{route('admin.priceAjax')}}",
        method: "POST",
        data: {
            id: val
        },
        success: function(data) {
            // alert(val);
            var obj=JSON.parse(data);
            $('#amount_' + x).val();
            $('#amount_' + x).val(obj.price);
        }
    });
   
}

function _delete(id) {
    var r = confirm("Do you want to delete this?");
    if (r == true) {
        $('#row_' + id).remove();
        // $('#rowHr_' + id).remove();
        x--;
        // var count = $('#tableDiv > tbody > tr').length;
        // alert(count);
        // var totamount = 0;
        // for (let index = 1; index <= count; index++) {
        //     totamount = Number(totamount) + Number($('#amount_' + index).val());
        // }
        // // alert(totamount);
        // $('#subtotal').empty();
        // $('#subtotal').append(totamount);
    } else {
        return false;
    }
}

x=1;
$('.addAnotherrow').click(function(){
	x++;
    var location_id = $('#location_id').val();
    var fr_date = $('#fr_date').val();
    var to_date = $('#to_date').val();
    var string = '<option value="">Select Room Type</option>';
            <?php 
            foreach($menus as $menu){   ?>
                string += '<option value="<?=$menu->booking_id?>"><?=$menu->booking_id?>-<?php echo $menu->first_name; ?> {{$menu->middle_name}} {{$menu->last_name}} -<?php echo date('d-m-Y H:i:s',strtotime($menu->booking_time)); ?></option>'; 
           <?php    }  ?>

                let row = '<tr>' +
                '<td class="text-left">' + x + '</td>'+
			    '<td>'+
				'<select name="booking_id[]" id="booking_id_'+x+'" onChange="" class="form-control accommodation" required=""  tabindex="-1" aria-hidden="true">'
                +  string
			    +'</select>'
                +'</td>'
                +'<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove">-</i></button></td>'
                +'</tr>';
                $('#intro2').append(row);

});

$("#intro2").on("click",".removeRow", function(){
        
		$(this).parents('tr').remove();
		
	});
$(document).ready(function() {
    $("#intro2").on('change','.accommodation',function(){
       // var cnt = 0;
     //   checked = $("input[type=checkbox]:checked").length;
      //  console.log(checked);
        var current_val = $(this).val();
        $('#intro2 .accommodation').not(this).each(function(){
            if(  $(this).val() == current_val){
                alert("duplicate!" );
                $(this).closest('tr').remove();
                    
            }else{
            
            }
        })
    })
})

</script>
@endsection
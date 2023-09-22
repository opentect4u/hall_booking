@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Miscellaneous Item {{ isset($customer)?'Edit':'Add'}} for Booking Id #{{$booking_id}}</h4>
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">Menu added successfully.</div>
                    @endif
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" method="post"
                        action="{{ isset($customer)?route('admin.cautionMoneyeditconfirm'):route('admin.bulkStoremisitem')}}">
                        @csrf
                        <input type="text" hidden name="id" id="id" value="{{isset($customer)?$customer->id:''}}">
                        <input type="text" hidden name="booking_id" id="booking_id" value="{{$booking_id}}">

                        <div class="table-responsive w-100">

                        <table class="table">
                        <thead>
                            <tr>
                            <th>#</th>
                                        <th>Item Name</th>
                                        <th>Days</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <!-- <th>No of head</th> -->
                                <th>
                                <button type="button" class="btn btn-success addAnotherrow"><i class="fa fa-plus">+</i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="intro2" class="tables">
                        <?php if($addedmenu) {                            
                              foreach($addedmenu as $item){
                              ?>
                         <tr><td class="text-left"></td>
                         <td class="text-left"><?=$item->item_name?></td>
                         <td class="text-left"><?=$item->num_of_days?></td>
                         <td class="text-left"><?=$item->rate?></td>
                         <td class="text-left"><?=$item->amount?></td>
                         <td class="text-left"><?php $id =$item->id.'_'.$item->booking_id; ?>
                         <a href="{{route('admin.delmis_item',['id'=>$id])}}" ><button type="button" class="btn btn-danger"><i class="fa fa-trash">Delete</i></button></a>
                        </td>
                         </tr>  
                        <?php } }?>  
                        <tr class="text-right" id="row_1">
                                        <td class="text-left">1</td>
                                        <td class="text-left ">
                                        <input type="text" class="form-control" name="item_name[]" id="item_name_1"
                                                placeholder="Item Name"  required>
                                        </td>
                                        <td>
                                        <input type="number" class="form-control" name="num_of_days[]" id="num_of_days_1"
                                                placeholder=""  required>
                                        </td>
                                        <td>
                                        <input type="number" class="form-control" name="rate[]" id="rate_1"
                                                placeholder="rate"  required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="amount[]" id="amount_1"
                                                placeholder="Amount"  required>
                                        </td>
                                        
                                        <td></td>
                                    </tr>
                        </tbody>
					</table>
                            
                        </div>
                        <div class="form-group row">
                            <div class="col"></div>
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
           

                let row = '<tr>' +
                '<td class="text-left">' + x + '</td>'+
			    '<td>'+ 
				'<select name="item_name[]" id="item_name_'+x+'" onChange="ItemName(' + x + ');" class="form-control " required=""  tabindex="-1" aria-hidden="true">'
                +  string
			    +'</select>'
                +'</td>'
                +'<td><input type="text" class="form-control" name="amount[]" id="amount_' + x +'" placeholder="Amount" readonly></td>'
                +'<td><input type="text" class="form-control" name="no_of_head[]" id="no_of_head_' + x +'" placeholder="Amount" ></td>'
                +'<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove">-</i></button></td>'
                +'</tr>';

                $('#intro2').append(row);
         

});

$("#intro2").on("click",".removeRow", function(){
        
		$(this).parents('tr').remove();
		
	});

</script>
@endsection
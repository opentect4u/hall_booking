@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Menu {{ isset($customer)?'Edit':'Add'}} for Booking Id #{{$booking_id}}</h4>
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">Menu added successfully.</div>
                    @endif
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" method="post"
                        action="{{ isset($customer)?route('admin.cautionMoneyeditconfirm'):route('admin.storeMenuHall')}}">
                        @csrf
                        <input type="text" hidden name="id" id="id" value="{{isset($customer)?$customer->id:''}}">
                        <input type="text" hidden name="booking_id" id="booking_id" value="{{$booking_id}}">

                        <div class="table-responsive w-100">
                            <table class="table" id="tableDiv">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th>#</th>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>No of head</th>
                                        <th class="text-right">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <tr class="text-right" id="row_1">
                                        <td class="text-left">1</td>
                                        <td class="text-left dropDownCus">
                                            <select class="form-control" name="item_name[]" id="item_name_1" required
                                                onChange="ItemName(1);">
                                                <option value=""> --Select-- </option>
                                                @foreach($menus as $menu)
                                                <option value="{{$menu->id}}">{{$menu->item_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-left">
                                            <input type="text" class="form-control" name="amount[]" id="amount_1"
                                                placeholder="Amount" readonly required>
                                        </td>
                                        <td class="text-left"><input type="text" class="form-control" name="no_of_head[]"
                                                id="no_of_head_1" placeholder="no of head" required></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="container-fluid d-flex w-100 float-right">
                            <a href="javascript:void(0)" class="btn btn-success float-right mt-4" id="dynamic_add"><i
                                    class="mdi mdi-plus"></i>Add menu</a>
                            <!-- <hr> -->
                        </div>

                        <!-- <button type="submit" class="btn btn-primary mr-2">Submit</button> -->
                        <input type="submit" class="btn btn-primary mr-2" value="{{ isset($customer)?'Edit':'Add'}}">
                        <!-- <button class="btn btn-light">Cancel</button> -->
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

            $('#tbody').append('<tr id="row_' + x + '">' +
                '<td class="text-left">' + x + '</td><td class="text-left dropDownCus">' +
                '<select class="form-control" name="item_name[]" id="item_name_' + x +
                '" required onChange="ItemName(' + x + ');"><option value=""> --Select-- </option>' +
                '<?php 
            foreach($menus as $menu){
               echo "<option value=".$menu->id.">".$menu->item_name."</option>"; 
            }
            ?>' +
                '</select></td>' +
                '<td><input type="text" class="form-control" name="amount[]" id="amount_' + x +
                '" placeholder="Amount" readonly></td>' +
                '<td><input type="text" class="form-control" name="no_of_head[]" id="no_of_head_' + x +
                '" placeholder="no of head" required></td>' +
                '<td><button type="button" id="remove_' + x +
                '" class="btn btn-danger btn-rounded btn-icon" onclick="_delete(' + x +
                ')"><i class="mdi mdi-delete"></i></button></td>' +
                // '<td><button type="button" id="remove_' + x +
                // '" class="btn btn-danger btn-rounded btn-icon" onclick="_delete(' + x +
                // ')"><i class="mdi mdi-delete"></i></button></td>' +
                '</tr>');
            // var y = x-1;

            // $('#tot_shg').val(y);
            // $('#tot_memb').val(total);

            // pack_size_
            // brand_name_
            $("#pack_size_" + x).select2();
            $("#brand_name_" + x).select2();

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
    var val = $('#item_name_1').val();
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
</script>
@endsection
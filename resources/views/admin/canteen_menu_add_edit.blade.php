@extends('admin.common.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Canteen Menu {{ isset($customer)?'Edit':'Add'}}</h4>
                    @if(Session::has('update'))
                    <div class="alert alert-success" role="alert">Canteen Menu updated successfully.</div>
                    @endif
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" method="post" action="{{ isset($customer)?route('admin.canteenMenueditconfirm'):route('admin.canteenMenuadd')}}"  autocomplete="off"> 
                        @csrf
                        <input type="text" hidden name="id" id="id" value="{{isset($customer)?$customer->id:''}}">
                        <div class="form-group">
                            <label for="exampleInputName1">Category Name </label>
                            <select name="menu_category_id" id="menu_category_id" required class="form-control">
                                <option value=""> -- Select -- </option>
                                @foreach($menu_category as $category)
                                <option value="{{$category->id}}" <?php if(isset($customer) && $customer->menu_category_id==$category->id){echo "selected";}?>>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Item Name </label>
                            <textarea name="item_name" id="item_name" required class="form-control" cols="" rows="5" placeholder="item name">{{isset($customer)?$customer->item_name:''}}</textarea>
                            <!-- <input type="text" class="form-control" required name="item_name"  id="item_name" value="{{isset($customer)?$customer->item_name:''}}" placeholder="item name"> -->
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputName1">price </label>
                            <input type="text" class="form-control" required name="price"  id="price" value="{{isset($customer)?$customer->price:''}}" placeholder="price">
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


@endsection
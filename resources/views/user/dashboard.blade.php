@extends('common.master')
@section('content')
User Details : 
{{\Auth::guard('frontuser')->user()->name}}


@endsection


@section('script')



@endsection

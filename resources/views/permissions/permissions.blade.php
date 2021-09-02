@extends('layouts.permissions')
@section('content')
    <div id="permissions">
    	<permissions :formalities="{{$formalities}}" type="client"></permissions>
    	{{-- <permissions></permissions> --}}
        {{-- {{$permissions}} --}}
    </div>
@endsection
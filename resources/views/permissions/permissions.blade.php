@extends('layouts.permissions')
@section('content')
    <div id="permissions">
    	<permissions :formalities="{{json_encode($formalities)}}" type="client"></permissions>
    	{{-- <permissions></permissions> --}}
        {{-- {{$permissions}} --}}
    </div>
@endsection
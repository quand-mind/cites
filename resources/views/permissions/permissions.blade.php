@extends('layouts.permissions')
@section('content')
    <div id="permissions">
        <span>{{$clientData[0]->name}} {{$clientData[0]->dni}}</span>
        <img src="{{$clientData[0]->photo}}" alt="">
    	<permissions :permissions="{{$permissions}}" type="client"></permissions>
    	{{-- <permissions></permissions> --}}
    </div>
@endsection
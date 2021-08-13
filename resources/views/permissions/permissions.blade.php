@extends('layouts.permissions')
@section('content')
    <div id="permissions">
        {{$clientData}}
    	<permissions :permissions="{{$permissions}}" type="client"></permissions>
    	{{-- <permissions></permissions> --}}
    </div>
@endsection
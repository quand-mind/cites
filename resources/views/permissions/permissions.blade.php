@extends('layouts.permissions')
@section('content')
    <div id="permissions">
    	{{-- <permissions :permissions={{ json_encode($permissions) }}></permissions> --}}
    	<permissions></permissions>
    </div>
@endsection
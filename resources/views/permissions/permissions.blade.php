@extends('layouts.permissions')
@section('content')
    <div id="permissions">
        
    	<permissions :permissions="{{$permissions}}"></permissions>
    	{{-- <permissions></permissions> --}}
    </div>
@endsection
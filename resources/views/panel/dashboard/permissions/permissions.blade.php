@extends('layouts.panel')
@section('content')
    <div id="permissions">
        
    	<permissions :permissions="{{$permissions}}" type="admin"></permissions>
    	{{-- <permissions></permissions> --}}
    </div>
@endsection
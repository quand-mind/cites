@extends('layouts.panel')
@section('content')
    <div id="permissions">
    	<permissions :formalities="{{$formalities}}" type="admin"></permissions>
    	{{-- <permissions></permissions> --}}
    </div>
@endsection
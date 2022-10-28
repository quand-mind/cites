@extends('layouts.panel')
@section('content')
    <div id="permissions">
    	<permissions :formalities="{{json_encode($formalities)}}" type="admin"></permissions>
    	{{-- <permissions></permissions> --}}
    </div>
@endsection
@extends('layouts.panel')
@section('content')
    <div id="permits">
    	<permits-view :permits="{{json_encode($permit_types)}}" type="admin"></permits-view>
    </div>
@endsection
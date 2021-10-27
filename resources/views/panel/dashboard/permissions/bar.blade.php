@extends('layouts.panel')
@section('content')
    <div id="bar">
    	<graphic :title="{{json_encode($title)}}"></graphic>

    	<bar :values="{{json_encode($values)}}" :labels="{{json_encode($labels)}}" :label="{{json_encode($label)}}" :backgrounds="{{json_encode($backgrounds)}}"></bar>
    </div>
@endsection
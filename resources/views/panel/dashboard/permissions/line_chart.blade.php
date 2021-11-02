@extends('layouts.panel')
@section('content')
    <div id="doughnut">
    	<graphic :title="{{json_encode($title)}}"></graphic>

    	<line-chart :values="{{json_encode($values)}}" :backgrounds="{{json_encode($backgrounds)}}" :borders="{{json_encode($borders)}}" :label="{{json_encode($label)}}" :labels="{{json_encode($labels)}}"></line-chart>
    </div>
@endsection
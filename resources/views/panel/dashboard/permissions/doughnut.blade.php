@extends('layouts.panel')
@section('content')
    <div id="doughnut">
    	<graphic :title="{{json_encode($title)}}"></graphic>

    	<doughnut :values="{{json_encode($values)}}" :labels="{{json_encode($labels)}}" :label="{{json_encode($label)}}" :backgrounds="{{json_encode($backgrounds)}}"></doughnut>
    </div>
@endsection
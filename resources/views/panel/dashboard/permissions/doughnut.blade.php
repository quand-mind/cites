@extends('layouts.panel')
@section('content')
    <div id="doughnut">
    	<graphic :title="{{json_encode($title)}}"></graphic>

    	<doughnut :data="{{json_encode($data)}}" :subtitle="{{json_encode($subtitle)}}" :label="{{json_encode($label)}}" :total="{{json_encode($total)}}"></doughnut>
    </div>
@endsection
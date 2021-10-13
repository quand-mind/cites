@extends('layouts.panel')
@section('content')
    <div id="statistics">
    	<graphic :data="{{json_encode($data)}}" type="admin"></graphic>
    </div>
@endsection
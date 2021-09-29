@extends('layouts.panel')
@section('content')
    <div id="requeriments">
    	<requeriments-view :requeriments="{{json_encode($requeriments)}}" type="admin"></requeriments-view>
    </div>
@endsection
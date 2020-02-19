@extends('layouts.panel')
@section('content')
    <div id="acronimoList">
    	<acronimo :words="{{ json_encode($acronimos) }}"></acronimo>
    </div>
@endsection


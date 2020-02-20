@extends('layouts.panel')
@section('content')
    <div id="acronimoList">
    	<acronimo-list :words="{{ json_encode($acronimos) }}"></acronimo-list>
    </div>
@endsection


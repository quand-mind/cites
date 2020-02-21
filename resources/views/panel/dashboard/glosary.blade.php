@extends('layouts.panel')
@section('content')
    <div id="glosaryList">
    	<glosary-list :words="{{ json_encode($glosaries) }}"></glosary-list>
    </div>
@endsection


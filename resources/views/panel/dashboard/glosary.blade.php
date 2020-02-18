@extends('layouts.panel')
@section('content')
    <div id="glosaryList">
    	<glosary :words="{{ json_encode($glosaries) }}"></glosary>
    </div>
@endsection


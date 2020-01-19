@extends('layouts.panel')
@section('content')
    <div id="surveysList">
        <surveys-list :surveys="{{ json_encode($surveys) }}"></surveys-list>
    </div>
@endsection


@extends('layouts.panel')
@section('content')
    <div id="questionsList">
        <questions-list :questions="{{ json_encode($questions) }}"></questions-list>
    </div>
@endsection


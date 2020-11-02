@extends('layouts.panel')
@section('content')
    <div id="linksList" >
        <links-list :links="{{ $links->toJson() }}"></links-list>
    </div>
@endsection

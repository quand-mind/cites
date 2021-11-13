@extends('layouts.panel')
@section('content')
    <div id="homeDashboard">
        <home-dashboard :user="{{auth()->user()}}" {{auth()->user()->isWriter() ? ':iswriter="true"' : ''}}></home-dashboard>
    </div>
    
@endsection


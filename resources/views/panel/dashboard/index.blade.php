@extends('layouts.panel')
@section('content')
    <div id="homeDashboard">
        <home-dashboard {{auth()->user()->isWriter() ? ':iswriter="true"' : ''}}></home-dashboard>
    </div>
    
@endsection


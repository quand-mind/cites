@extends('layouts.panel')
@section('content')
    <div id="homeDashboard" >
        <home-dashboard :iswriter="{{ auth()->user()->isWriter() }}"></home-dashboard>
    </div>
    
@endsection


@extends('layouts.panel')
@section('content')
    <div id="socialLinks">
        <social-links :links-list="{{ $links->toJson() }}"></social-links>
    </div>
@endsection


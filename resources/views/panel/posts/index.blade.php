@extends('layouts.panel')
@section('content')
    <div id="postsList">
        <posts-list :posts="{{ $posts->toJson() }}"></posts-list>
    </div>
@endsection
@extends('layouts.home')

@section('content')
    <div id="surveys">
        <surveys :surveys="{{$surveys->toJson()}}"></surveys>
    </div>
@endsection

@section('meta')
<meta name="description" content="{{$page->meta_description}}" />
<meta name="keywords" content="{{$page->meta_keywords}}" />
@endsection

@section('title')
    <title>{{ env('APP_NAME') }} @if ($page != null)| {{ $page->title }}@endif</title>
@endsection
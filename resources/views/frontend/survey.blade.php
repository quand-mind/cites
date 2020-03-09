@extends('layouts.home')

@section('content')
    <div id="survey">
        <survey :survey="{{$survey->toJson()}}"></survey>
    </div>
@endsection

@section('meta')
<meta name="description" content="{{$survey->description}}" />
<meta name="keywords" content="{{$page->meta_keywords}}" />
@endsection

@section('title')
    <title>{{ env('APP_NAME') }} @if ($page != null)| {{ $page->title }}@endif</title>
@endsection
@extends('layouts.home')

@section('content')
    <div id="glosary">
        <glosary :page="{{ $page->toJson() }}" :glosary="{{$glosary->toJson()}}"></glosary>
    </div>
@endsection

@section('meta')
<meta name="description" content="{{$page->meta_description}}" />
<meta name="keywords" content="{{$page->meta_keywords}}" />
@endsection

@section('title')
    <title>{{ env('APP_NAME') }} @if ($page != null)| {{ $page->title }}@endif</title>
@endsection
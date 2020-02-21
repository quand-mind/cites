@extends('layouts.home')

@section('content')
    <div id="legalView">
        <legal-view :files-data="{{$filesData->toJson()}}" :page="{{$page->toJson()}}" ></legal-view>
    </div>
@endsection

@section('meta')
    <meta name="description" content="{{$page->meta_description}}" />
    <meta name="keywords" content="{{$page->meta_keywords}}" />
@endsection

@section('title')
    <title>{{ env('APP_NAME') }} @if ($page != null)| {{ $page->title }}@endif</title>
@endsection
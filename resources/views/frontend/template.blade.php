@extends('layouts.home')

@section('content')
    <div id="pageTemplate">
        <page-template :page="{{$page->toJson()}}"></page-template>
    </div>
@endsection

@section('meta')
<meta name="description" content="{{$page->meta_description}}" />
<meta name="description" content="{{$page->meta_description}}" />
@endsection

@section('title')
    <title>{{ env('APP_NAME') }} @if ($page != null)| {{ $page->title }}@endif</title>
@endsection
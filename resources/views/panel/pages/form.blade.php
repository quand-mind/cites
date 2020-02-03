@extends('layouts.panel')
@section('content')
    <div id="pageForm">
        @if(isset($page))
        {{--  Edit form  --}}
            <page-form :mainPages="{{ $mainPages->toJson() }}" :page="{{ $page->toJson() }}"></page-form>
        @else
        {{--  Create form  --}}
            <page-form :mainPages="{{ $mainPages->toJson() }}"></page-form>
        @endif
    </div>
@endsection

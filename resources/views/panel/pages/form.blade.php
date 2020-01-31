@extends('layouts.panel')
@section('content')
    <div id="pageForm">
        @if(isset($page))
        {{--  Edit form  --}}
            <page-form :page="{{ $page->toJson() }}"></page-form>
        @else
        {{--  Create form  --}}
            <page-form></page-form>
        @endif
    </div>
@endsection

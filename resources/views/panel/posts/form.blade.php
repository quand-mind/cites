@extends('layouts.panel')
@section('content')
    <div id="postForm">
        @if(isset($post))
        {{--  Edit form  --}}
            <post-form :post="{{ $post->toJson() }}"></post-form>
        @else
        {{--  Create form  --}}
            <post-form></post-form>
        @endif
    </div>
@endsection

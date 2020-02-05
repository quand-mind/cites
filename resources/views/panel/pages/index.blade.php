@extends('layouts.panel')
@section('content')
    <div id="pagesList">
    <pages-list :pages="{{ $pages->toJson() }}"></pages-list>
    </div>
@endsection
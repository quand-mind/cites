@extends('layouts.panel')
@section('content')
    <div id="menuList">
        <menu-list :pages="{{ json_encode($pages) }}"></menu-list>
    </div>
@endsection


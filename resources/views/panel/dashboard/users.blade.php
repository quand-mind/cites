@extends('layouts.panel')
@section('content')
    <div id="usersList" >
        <users-list :users="{{ $users->toJson() }}"></users-list>
    </div>
@endsection

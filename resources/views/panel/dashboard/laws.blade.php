@extends('layouts.panel')
@section('content')
    <div id="lawsList" >
        <laws-list :laws="{{ $laws->toJson() }}"></laws-list>
    </div>
@endsection

@extends('layouts.permissions')
@section('content')
    <div id="aproved-permit">
      {{$permit}}
    	{{-- <aproved-permit :permit="{{$permit->toJson()}}" type="client"></aproved-permit> --}}
    </div>
@endsection
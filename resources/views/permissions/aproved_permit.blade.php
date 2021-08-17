@extends('layouts.permissions')
@section('content')
    <div id="aproved-permit">
      
    	<view-permit :permit="{{$permit->toJson()}}" type="client"></view-permit>
    </div>
@endsection
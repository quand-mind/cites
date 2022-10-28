@extends('layouts.permit')
@section('content')
    <div id="permit-info">
    	<permit-info :permit="{{ $permit->toJson() }}"></permit-info>
    </div>
@endsection
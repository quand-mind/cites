@extends('layouts.permissions')
@section('content')
    <div id="permit-form">
    	<permit-form :permit_type="{{ $permitType->toJson() }}" :client_data="{{$clientData}}" type="client"></permit-form>
    </div>
@endsection
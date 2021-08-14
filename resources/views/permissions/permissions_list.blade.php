@extends('layouts.permissions')
@section('content')
    <div id="permissionsList">
    	<permissions-list :permit_types="{{ $permitTypes->toJson() }}" :client_data="{{$clientData}}" type="client" ></permissions-list>
    </div>
@endsection
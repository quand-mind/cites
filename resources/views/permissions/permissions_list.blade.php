@extends('layouts.permissions')
@section('content')
    <div id="permissionsList">
    	<permissions-list :permit_types="{{ $permitTypes->toJson() }}"type="client" ></permissions-list>
    </div>
@endsection
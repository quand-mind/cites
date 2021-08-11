@extends('layouts.permissions')
@section('content')
    <div id="permissionsList">
    	<permissions-list :permit_types="{{ $permitTypes->toJson() }}" ></permissions-list>
    </div>
@endsection
@extends('layouts.permissions')
@section('content')
    <div id="check_comercial_export">
    	<check-comercial-export-requirements :permit="{{ json_encode($permit) }}"></check-comercial-export-requirements>
    	{{-- <check-comercial-export-requirements ></check-comercial-export-requirements> --}}
    </div>
@endsection
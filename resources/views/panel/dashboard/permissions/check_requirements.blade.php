@extends('layouts.panel')
@section('content')
    <div id="check_requeriments">
    	<check-requirements :permit="{{ json_encode($permit) }}" type="admin"></check-requirements>
    	{{-- <check-comercial-export-requirements ></check-comercial-export-requirements> --}}
    </div>
@endsection
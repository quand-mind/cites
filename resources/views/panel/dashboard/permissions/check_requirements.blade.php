@extends('layouts.panel')
@section('content')
    <div id="check_requeriments">
    	<check-requirements :official="{{ $officialData->toJson()}}" :formalitie="{{ json_encode($formalitie) }}" type="admin"></check-requirements>
    	{{-- <check-comercial-export-requirements ></check-comercial-export-requirements> --}}
    </div>
@endsection
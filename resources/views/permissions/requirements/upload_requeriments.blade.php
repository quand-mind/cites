@extends('layouts.permissions')
@section('content')
    <div id="uploadRequirements">
    	<upload-requirements :formalitie="{{ $formalitie }}" :client_data="{{$clientData}}" type="client"></upload-requirements>
    </div>
@endsection
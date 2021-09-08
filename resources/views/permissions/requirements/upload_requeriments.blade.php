@extends('layouts.permissions')
@section('content')
    <div id="uploadRequirements">
    	<upload-requirements :formalitie="{{ $formalitie }}" :client_data="{{auth()->user()->get()->first()}}" type="client"></upload-requirements>
    </div>
@endsection
@extends('layouts.permissions')
@section('content')
    <div id="uploadRequirements">
    	<upload-requirements :formalitie="{{ $formalitie }}" type="client"></upload-requirements>
    </div>
@endsection
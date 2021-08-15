@extends('layouts.permissions')
@section('content')
    <div id="uploadRequirements">
    	<upload-requirements :permit="{{ json_encode($permit) }}" type="client"></upload-requirements>
    </div>
@endsection
@extends('layouts.permissions')
@section('content')
    <div id="edit_client">
    	<edit-client :client="{{$client}}" type="client"></edit-client>
    </div>
@endsection
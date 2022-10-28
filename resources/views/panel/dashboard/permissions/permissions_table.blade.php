@extends('layouts.panel')
@section('content')
    <div id="permissions-table">
    	<permissions-table :formalities="{{json_encode($formalities)}}" type="admin"></permissions-table>
    	{{-- <permissions></permissions> --}}
    </div>
@endsection
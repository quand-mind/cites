@extends('layouts.panel')
@section('content')
    <div id="imagesList" >
        <header-manager :images="{{ $images->toJson() }}"></header-manager>
    </div>
@endsection

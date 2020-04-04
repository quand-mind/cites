@extends('layouts.panel')
@section('content')
    <div id="imagesList" >
        <aside-manager :images="{{ $images->toJson() }}"></aside-manager>
    </div>
@endsection

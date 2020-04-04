@extends('layouts.panel')
@section('content')
    <div>
        <header-manager :images="{{ $images->toJson() }}"></header-manager>
    </div>
@endsection

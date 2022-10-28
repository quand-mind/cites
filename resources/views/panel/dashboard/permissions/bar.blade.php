@extends('layouts.panel')
@section('content')
    <div id="bar">
    	{{-- <graphic :title="{{json_encode($title)}}"></graphic> --}}

        {{-- {{$all_species}} --}}

        <bar-template :all_species="{{json_encode($all_species)}}" :species="{{json_encode($species)}}" :title="{{json_encode($title)}}" :datasets="{{json_encode($datasets)}}" :labels="{{json_encode($labels)}}"></bar-template>

    	{{-- <bar :values="{{json_encode($values)}}" :labels="{{json_encode($labels)}}" :label="{{json_encode($label)}}" :backgrounds="{{json_encode($backgrounds)}}"></bar> --}}
    </div>
@endsection
@extends('layouts.panel')
@section('content')
    <div id="doughnut">
    	{{-- <graphic :title="{{json_encode($title)}}"></graphic> --}}

        <graphic-template :title="{{json_encode($title)}}" :datasets="{{json_encode($datasets)}}" :labels="{{json_encode($labels)}}" :date1="{{json_encode($date1)}}" :date2="{{json_encode($date2)}}"></graphic-template>
        {{-- <select-date :date1="{{json_encode($date1)}}" :date2="{{json_encode($date2)}}"></select-date> --}}

    	{{-- <line-chart :datasets="{{json_encode($datasets)}}" :labels="{{json_encode($labels)}}"></line-chart> --}}
    </div>
@endsection
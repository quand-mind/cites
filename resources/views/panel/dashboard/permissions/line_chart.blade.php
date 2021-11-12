@extends('layouts.panel')
@section('content')
    <div id="doughnut">
        <line-chart-template :title="{{json_encode($title)}}" :datasets="{{json_encode($datasets)}}" :labels="{{json_encode($labels)}}" :date1="{{json_encode($date1)}}" :date2="{{json_encode($date2)}}"></line-chart-template>
    </div>
@endsection
@extends('layouts.panel')
@section('content')
    <div id="species_details">
    	<species-details :species="{{ $species->toJson()}}"></species-details>
    </div>
@endsection
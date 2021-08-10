@extends('layouts.app')

@section('content')
    <h1>Consuming the Species + / CITE api</h1>
    <div class="row">
        <!--div class="col-4">
            <select class="custom-select" id="inputGroupSelect01">
                <option selected>Kingdom</option>
                @foreach($species->taxon_concepts as $specie)
                    </h2><option selected>{{$specie->higher_taxa->kingdom}}
                @endforeach
            </select></div>
        <div class="col-4">
            <select class="custom-select" id="inputGroupSelect01" >
                <option selected>phylum</option>
                @foreach($species->taxon_concepts as $specie)
                    </h2><option selected>{{$specie->higher_taxa->phylum}}
                @endforeach
            </select></div>
        </div-->
        <div class="col-4">
            <select class="custom-select" id="inputGroupSelect01">
                @foreach($species->taxon_concepts as $specie)
                    <option selected>{{$specie->full_name}}
                @endforeach
            </select>
        </div>
        
    </div>
        
@endsection
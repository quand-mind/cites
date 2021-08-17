@extends('layouts.app')

@section('content')
    <h1>Consuming the Species + / CITE api</h1>
    <!--div class="row p-4 w-100">
        <div class="col-12 d-flex flex-wrap justify-content-center p-4">
        <div class="col-5 p-2">
                <label for="">Appendix</label>
                <select class="custom-select" id="inputGroupSelect01">
                    @foreach($species->taxon_concepts as $specie)
                        <option selected>{{ $specie->cites_listing }}
                    @endforeach
                </select>
            </div>
            <div class="col-5 p-2">
                <label for="">Kingdom</label>
                <select class="custom-select" id="inputGroupSelect01">    
                    @foreach($species->taxon_concepts as $specie)
                        @if($specie->rank == "KINGDOM")
                            <option selected>{{$specie->full_name}}<option>
                            <option selected>{{$species->taxon_concepts[45]->full_name}}</option>
                        @endif
                    @endforeach
                    
                </select>
            </div>
            <div class="col-5 p-2">
                <label for="">Phylum</label>
                <select class="custom-select" id="inputGroupSelect01" >
                    @foreach($species->taxon_concepts as $specie)
                        @if($specie->rank == "PHYLUM")
                            <option selected>{{$specie->higher_taxa->phylum}}
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-5 p-2">
                <label for="">Class</label>
                <select class="custom-select" >
                    @foreach($species->taxon_concepts as $specie)
                        @if($specie->rank == "CLASS")
                            <option selected>{{$specie->full_name}}
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-5 p-2">
                <label for="">Order</label>
                <select class="custom-select" id="inputGroupSelect01" >
                    @foreach($species->taxon_concepts as $specie)
                        @if($specie->rank == "ORDER")
                            <option selected>{{$specie->full_name}}
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-5 p-2">
                <label for="">Family</label>
                <select class="custom-select" id="inputGroupSelect01">
                    @foreach($species->taxon_concepts as $specie)
                        @if($specie->rank == "FAMILY")
                            <option selected>{{$specie->full_name}}
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-5 p-2">
                <label for="">Genus</label>
                <select class="custom-select" id="inputGroupSelect01">
                    @foreach($species->taxon_concepts as $specie)
                        @if($specie->rank == "GENUS")
                            <option selected>{{$specie->full_name}}
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-5 p-2">
                <label for="">Species</label>
                <select class="custom-select" id="inputGroupSelect01">
                    @foreach($species->taxon_concepts as $specie)
                        @if($specie->rank == "SPECIES")
                            <option selected>{{$specie->full_name}}
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-5 p-2">
                <label for="">Subspecies</label>
                <select class="custom-select" id="inputGroupSelect01">
                    @foreach($species->taxon_concepts as $specie)
                        @if($specie->rank == "SUBSPECIES")
                            <option selected>{{$specie->full_name}}
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div-->

    <form class="form-inline">
        <input name="filter" class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
        
@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function api_cites($arraySpecies)
    {   
        foreach ($arraySpecies as $value) {
            $full_name =  $value->full_name;
        }
        
        //resiviendo las especies de la funcion api_cites_filte por autocompletado
        /*$requestSpecies = [];
        foreach ($arraySpecies as $value) {
            array_push($requestSpecies,$full_name = $value->full_name);
            return $requestSpecies;
        }*/
        
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://api.speciesplus.net/api/v1/taxon_concepts?name=". $full_name;
        //return $url;
        $headers= [
            // 'Content-Type' => 'application/json',
            'X-Authentication-Token' => 'uD2JyZT7CvR1Snol3xKrYgtt',
        ];
        if (env('APP_ENV') === 'local') {
            $response = $client->request('GET', $url, [
                'verify'  => false,
                'headers' => $headers,
            ]);
        } else {
            $response = $client->request('GET', $url, [
                'verify'  => true,
                'headers' => $headers,
            ]);
        }


        $species = json_decode($response->getBody()->getContents());

        $especies = $species->taxon_concepts;
    
        $arraySpecies = [];

        foreach ($especies as $especie) {
            if ($especie->rank === "SPECIES" || $especie->rank === "SUBSPECIES" ){
                array_push($arraySpecies, $especie);
            }
        }
        //return $arraySpecies;
        return $species;
        // return view('species', compact('species'));
    }



    public function api_cites_filter(Request $request)
    {
        $filter  = $request->get('filter');
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://speciesplus.net/api/v1/auto_complete_taxon_concepts?taxon_concept_query=".$filter;
        $headers= [
            // 'Content-Type' => 'application/json',
            'X-Authentication-Token' => 'uD2JyZT7CvR1Snol3xKrYgtt',
        ];
        if (env('APP_ENV') === 'local') {
            $response = $client->request('GET', $url, [
                'verify'  => false,
                'headers' => $headers,
            ]);
        } else {
            $response = $client->request('GET', $url, [
                'verify'  => true,
                'headers' => $headers,
            ]);
        }


        $species = json_decode($response->getBody()->getContents());
        $especies = $species->auto_complete_taxon_concepts;

        //return $especies;
    
        $arraySpecies = [];

        foreach ($especies as $especie) {
            if ($especie->rank_name === "SPECIES" || $especie->rank_name === "SUBSPECIES" ){
                array_push($arraySpecies, $especie);
            }

        }
        return $arraySpecies;
        return view('species', compact('arraySpecies'));
        // return $this->api_cites($arraySpecies);
      
        
    }
}

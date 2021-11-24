<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use Illuminate\Http\Request;
use GuzzleHttp\Client as ClientSpecie;
use Illuminate\Support\Facades\Storage;

class SpecieController extends Controller
{
    public function index()
    {

    }
    public function showSpeciesDetails()
    {
        $species = Specie::all();
        // return $species;
        return view('panel.dashboard.permissions.species.species_details', compact('species'));
    }
    public function registerSpecie(Request $request)
    {
        $specie = json_decode($request->input('specie'));
        $name = $specie->name_common;
        $img = $request->file('img');

        $apiSpecie = $this->api_cites($name);

        $findedSpecie = Specie::where(['name_scientific' => $apiSpecie->full_name])->get()->first();

        if ($findedSpecie) {
            return response('La especie ya se encuentra agregada', 500);
        } else {
            $nameFile = $specie->name_common."_img_".time().".".$img->guessExtension();
            $sub_url = 'species/'. $specie->name_common;
            $url = $this->createFolder($sub_url);
            $file_url = $request->file('img')->storeAs($url, $nameFile);
            $file_url = '/storage/' . $file_url;
            // return $file_url;

            $newSpecie = new Specie();
            $newSpecie->type = $apiSpecie->higher_taxa->kingdom;
            $newSpecie->appendix = $apiSpecie->cites_listing;       
            $newSpecie->img = $file_url;       
            $newSpecie->general_appearance = $specie->general_appearance;       
            $newSpecie->measurements = $specie->measurements;       
            $newSpecie->pelage = $specie->pelage;       
            $newSpecie->aprox_weight = $specie->aprox_weight;       
            $newSpecie->head_profile = $specie->head_profile;       
            $newSpecie->neck_mane = $specie->neck_mane;       
            $newSpecie->juvenile = $specie->juvenile;       
            $newSpecie->distribution = $specie->distribution;       
            $newSpecie->captive_population = $specie->captive_population;       
            $newSpecie->wild_population = $specie->wild_population;       
            $newSpecie->intraspecific_variation = $specie->intraspecific_variation;
            $newSpecie->blibliography = $specie->blibliography;       
            $newSpecie->name_scientific = $apiSpecie->full_name;       
            if (count($apiSpecie->common_names) > 0) {

                $commonNames = array_filter(
                    $apiSpecie->common_names, function ($name) {
                        if ($name->language === 'ES') {
                            return $name;
                        } else if ($name->language === 'EN') {
                            return $name;
                        }
                    }
                );
                if ($commonNames === []) {
                    $newSpecie->name_common = $apiSpecie->full_name;
                } else {
                    $name =  array_reverse($commonNames)[0];
                    array_push($correctNames, $name);
                    $commonNameCorrect = $correctNames[0];
                    $newSpecie->name_common = $commonNameCorrect->name;
                }
                
            } else {
                $newSpecie->name_common = $apiSpecie->full_name;
            }
            $newSpecie->search_id = $apiSpecie->id;
            $newSpecie->save();

            return $newSpecie;
            
            
        }

        
    }

    public function createFolder($sub_url) 
    {
        $url = '/files/'. $sub_url. '';
        Storage::makeDirectory($url);
        return $url;
    }

    public function api_cites($name)
    {   
        
        $client = new ClientSpecie(); //GuzzleHttp\Client
        $url = "https://api.speciesplus.net/api/v1/taxon_concepts?name=". $name;
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


        $specie = json_decode($response->getBody()->getContents());

        $especie = $specie->taxon_concepts[0];
    
        return $especie;
        // return view('species', compact('species'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use Illuminate\Http\Request;
use GuzzleHttp\Client as ClientSpecie;
use Illuminate\Support\Facades\File;
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
        // return $specie;
        $female_img = $request->file('female_img');
        $male_img = $request->file('male_img');
        $male_title = $request->input('male_title');
        $female_title = $request->input('female_title');
        // return $female_img;

        $findedSpecie = Specie::where(['name_scientific' => $specie->name_scientific])->get()->first();

        if ($findedSpecie) {
            return response('La especie ya se encuentra agregada', 500);
        } else {
            if ($male_img) {
                $maleNameFile = $specie->name_common."_img_".time() . '_male' . ".".$male_img->guessExtension();
                $male_sub_url = 'species/'. $specie->name_common;
                $male_url = $this->createFolder($male_sub_url);
                $male_file_url = $request->file('male_img')->storeAs($male_url, $maleNameFile);
                // return $male_file_url;
                $male_file_url = '/storage/' . $male_file_url;
            } else {
                $male_file_url = null;
            }
            if ($female_img) {
                $femaleNameFile = $specie->name_common."_img_".time() . '_female' . ".".$female_img->guessExtension();
                $female_sub_url = 'species/'. $specie->name_common;
                $female_url = $this->createFolder($female_sub_url);
                $female_file_url = $request->file('female_img')->storeAs($female_url, $femaleNameFile);
                $female_file_url = '/storage/' . $female_file_url;
            } else {
                $female_file_url = null;
            }
            // return $file_url;

            $newSpecie = new Specie();
            $newSpecie->type = $specie->type;
            $newSpecie->appendix = $specie->appendix;       
            $newSpecie->male_img = $male_file_url;       
            $newSpecie->female_img = $female_file_url;       
            $newSpecie->male_title = $male_title;       
            $newSpecie->female_title = $female_title;       
            $newSpecie->description = $specie->description;       
            $newSpecie->features = $specie->features;       
            $newSpecie->geographic_distribution = $specie->geographic_distribution;       
            $newSpecie->family = $specie->family;    
            $newSpecie->class = $specie->class;    
            $newSpecie->name_scientific = $specie->name_scientific;       
            $newSpecie->name_common = $specie->name_common;       
            $newSpecie->search_id = $specie->search_id;
            $newSpecie->save();

            return response('Especie Añadida correctamente', 200);
            
            
        }

        
    }

    public function editSpecie(Request $request)
    {
        $specie = json_decode($request->input('specie'));
        // File::delete(storage_path($obtained_img_url));
        // return response ('Especie Editada', 200);
        $isNewMalePhoto = $request->input('isNewMalePhoto');
        // return $isNewMalePhoto;
        $isNewFemalePhoto = $request->input('isNewFemalePhoto');
        $findedSpecie = Specie::where(['name_scientific' => $specie->name_scientific])->get()->first();
        
        if ($isNewFemalePhoto == 'false') {
            $female_img = $request->input('female_img');
            $female_file_url = $female_img;
        } else {
            
            $female_img = $request->file('female_img');
            $femaleNameFile = $specie->name_common."_img_".time().'_female'.".".$female_img->guessExtension();
            $female_sub_url = 'species/'. $specie->name_common;
            $female_url = $this->createFolder($female_sub_url);
            $female_file_url = $request->file('female_img')->storeAs($female_url, $femaleNameFile);
            $female_file_url = '/storage/' . $female_file_url;
        }

        if ($isNewMalePhoto == 'false') {
            $male_img = $request->input('male_img');
            $male_file_url = $male_img;
        } else {
            
            $male_img = $request->file('male_img');
            $maleNameFile = $specie->name_common."_img_".time().'_male'.".".$male_img->guessExtension();
            $male_sub_url = 'species/'. $specie->name_common;
            $male_url = $this->createFolder($male_sub_url);
            $male_file_url = $request->file('male_img')->storeAs($male_url, $maleNameFile);
            $male_file_url = '/storage/' . $male_file_url;
        }
        
        // return $file_url;
        $findedSpecie->type = $specie->type;
        $findedSpecie->appendix = $specie->appendix;       
        $findedSpecie->male_img = $male_file_url;       
        $findedSpecie->female_img = $female_file_url;       
        $findedSpecie->description = $specie->description;       
        $findedSpecie->male_title = $specie->male_title;       
        $findedSpecie->female_title = $specie->female_title;       
        $findedSpecie->family = $specie->family;    
        $findedSpecie->class = $specie->class;    
        $findedSpecie->name_scientific = $specie->name_scientific;       
        $findedSpecie->name_common = $specie->name_common;       
        $findedSpecie->search_id = $specie->search_id;
        $findedSpecie->save();

        return response('Especie Editada correctamente', 200);
    }

    public function createFolder($sub_url) 
    {
        $url = '/files/'. $sub_url. '';
        Storage::makeDirectory($url);
        return $url;
    }

    public function api_cites(Request $request)
    {   
        $name = $request->input('name');
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

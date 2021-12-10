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
        $img = $request->file('img');

        $findedSpecie = Specie::where(['name_scientific' => $specie->name_scientific])->get()->first();

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
            $newSpecie->type = $specie->type;
            $newSpecie->appendix = $specie->appendix;       
            $newSpecie->img = $file_url;       
            $newSpecie->description = $specie->description;       
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
        $obtained_img_url = json_decode($request->input('obtained_img_url'));
        // File::delete(storage_path($obtained_img_url));
        // return response ('Especie Editada', 200);
        $isNewPhoto = $request->input('isNewPhoto');
        $findedSpecie = Specie::where(['name_scientific' => $specie->name_scientific])->get()->first();
        if ($isNewPhoto == 'false') {
            $img = $request->input('img');
            $file_url = $img;
        } else {
            
            $img = $request->file('img');
            $nameFile = $specie->name_common."_img_".time().".".$img->guessExtension();
            $sub_url = 'species/'. $specie->name_common;
            $url = $this->createFolder($sub_url);
            $file_url = $request->file('img')->storeAs($url, $nameFile);
            $file_url = '/storage/' . $file_url;
        }
        // return $file_url;
        $findedSpecie->type = $specie->type;
        $findedSpecie->appendix = $specie->appendix;       
        $findedSpecie->img = $file_url;       
        $findedSpecie->description = $specie->description;       
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

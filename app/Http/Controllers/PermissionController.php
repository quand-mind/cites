<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\JsonableInterface; 
use Illuminate\Support\Facades\Log;
use App\Models\Client;
use App\Models\Official;
use App\Models\Formalitie;
use App\Models\User;
use GuzzleHttp\Client as ClientSpecie;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use App\Models\Permit;
use App\Models\PermitType;
use App\Models\Requeriment;

use App\Models\Specie;
use Illuminate\Support\Facades\Storage;
use Response;
use Carbon\Carbon;
use Exception;

class PermissionController extends Controller
{

    // GET
    public function returnUser(){
        $user = Client::with('user')->where('user_id', '=', auth()->user()->id)->get();
        foreach ($user as  $us) {
            return $us->user->dni;
        }
    }
    public function index()
    {
        $clientData = Client::with('user')->where(['id' => auth()->user()->id])->get()->first();
        // return $clientData->user;
        $formalities = Formalitie::where(['client_id' => $clientData->id])->with(['permits.requeriments', 'permits.permit_type', 'permits.species', 'client.user'])->get();
        // $permissions = Permit::where(['client_id' => $clientData->id])->with(['requeriments', 'permit_type', 'species', 'client.user'])->get();
        // $permissions = Permit::where(['client_id' => $clientData->id])->with(['requeriments', 'permit_type', 'species', 'client.user'])->paginate(2);
        return view('permissions.permissions', compact('formalities', 'clientData'));
    }
    public function getForm($id)
    {   
        $clientData = Client::with('user')->where('id', '=', auth()->user()->id)->get()->first();
        $permitType = PermitType::with(['requeriments'])->where('id', '=', $id)->get()->first();
        return view('permissions.permit_form', compact(['permitType', 'clientData']));
    }
    public function showUploadRequeriments($id)
    {
        try {
            $formalitie = Formalitie::where(['id' => $id])->with(['permits.requeriments', 'permits.permit_type', 'permits.species', 'client.user'])->get()->first();
            // $permit = Permit::where(['id' => $id])->with(['requeriments', 'permit_type', 'species'])->get();
            if ($formalitie) {
                // return $permit;
                return view('permissions.requirements.upload_requeriments', compact('formalitie'));
            }
            else {
                return view('errors.404');
            }
        } catch (Exception $err) {
            return view('errors.404');
        }
    }

    public function getList()
    {
        $clientData = Client::with('user')->where('id', '=', auth()->user()->id)->get()->first();
        if ($clientData) {
            $clientId = $clientData->id;
        } else {
            $clientId = -1;
        }
        $permissions = Permit::with(['requeriments', 'permit_type', 'species', 'client.user'])->whereNotIn('client_id', [$clientId])->get();
        return view('panel.dashboard.permissions.permissions', compact('permissions'));
    }
    public function showChecklist($id)
    {
        try {
            $getPermit= Permit::find($id);
            $officialData = Official::with('user')->where('id', '=', auth()->user()->id)->get()->first();

            if ($officialData->user_id !== $getPermit->client->user_id) {
                $permit = Permit::where(['id' => $id])->with(['requeriments', 'permit_type', 'species', 'client.user'])->get()->first();
            } else {
                $permit = null;
            }
            if ($permit) {
                return view('panel.dashboard.permissions.check_requirements', compact('permit', 'officialData'));
            } else {
                return view('errors.404');
            }
        } catch (Exception $err) {
            return view('errors.404');
        }
    }
    public function showAprovedPermit($id)
    {
        $permit = Permit::where(['id' => $id])->with(['requeriments', 'permit_type', 'client.user', 'official.user', 'species'])->get()->first();
        // return $permit;
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $image = base64_encode(file_get_contents(public_path('/images/logos/logo-minec.png')));
        $pdf->loadView('permissions.aproved_permit', [ 'permit' => $permit, 'logo' => $image ]);
        return $pdf->stream();

        // return view('permissions.aproved_permit', compact('permit'));
    }

    // POST

    public function storePermit(Request $request)
    {
        $Date_day = Carbon::now()->format('Y-m-d');
        $DateDay = Carbon::now()->format('ymd');
        $getSpecies = json_decode($request->input('species'));

        $index = 0;
        
        $count = 0;

        
        $searchedSpecies= [];
        $correctNames = [];
        $speciesIdsWithPivot= [];
        
        $getPermitTypeId = $request->input('permit_type_id');
        $getPersonals = json_decode($request->input('personals'));
        $getPermit = json_decode($request->input('permit'));
        $getClientId = $request->input('client_id');

        $specieAlgo = null;

        $permitId= null;

        $formalities =  Formalitie::where('created_at', 'like', '%'.$Date_day.'%')->count();

        $formalitie = new Formalitie();

        switch($formalities){
            case $formalities < 10 :
                $total_pemisos_dia = $formalities + 1; 
                $formalitie->request_formalitie_no = $DateDay.'00'.$total_pemisos_dia;
            break;
            case $formalities >= 10 :
                $total_pemisos_dia = $formalities + 1; 
                $formalitie->request_formalitie_no = $DateDay.'0'.$total_pemisos_dia;
            break;
        }
        $formalitie->status = "uploading_requeriments";
        $formalitie->client_id = $request->input('client_id');
        $formalitie->save();
        
        foreach ($getSpecies as $specie) {
            if ($index % 4 === 0) {

                $speciesIdsWithPivot = [];
                // $count++;

                $permisos =  Permit::where('created_at', 'like', '%'.$Date_day.'%')->count();

                $faker = Faker::create();

                $permit = new Permit();

                switch($permisos){
                    case $permisos < 10 :
                        $total_pemisos_dia = $permisos + 1; 
                        $permit->request_permit_no = $DateDay.'00'.$total_pemisos_dia;
                    break;
                    case $permisos >= 10 :
                        $total_pemisos_dia = $permisos + 1; 
                        $permit->request_permit_no = $DateDay.'0'.$total_pemisos_dia;
                    break;
                }

                $permit->permit_type_id = $getPermitTypeId;
                $permit->purpose = $getPermit->purpose;
                $permit->transportation_way = $getPermit->transportation_way;
                $permit->consigned_to = $getPermit->consigned_to;
                $permit->country = $getPermit->country->name;
                $permit->country_code = $getPermit->country->code;
                $permit->landing_port = $getPermit->landing_port;
                $permit->shipment_port = $getPermit->shipment_port;
                $permit->destiny_place = $getPermit->destiny_place;
                $permit->departure_place = $getPermit->departure_place;
                $permit->formalitie_id = $formalitie->id;
                $permit->status = "uploading_requeriments";
                $permit->save();

                $permitId = $permit->id;
                        
                $permitType = PermitType::where(['id' =>  $getPermitTypeId])->with(['requeriments'])->get()->first();

                $requeriments = $permitType->requeriments;
                

                foreach($requeriments as $requeriment) {
                    $requerimentsIdsWithPivot[$requeriment->id] = ["file_url" => null, "is_valid" => null,];
                }

                $permit->requeriments()->sync($requerimentsIdsWithPivot);

                $name = $specie->name_common;
                $findedSpecie = Specie::where('name_scientific', '=', $name)->get()->first();
                if ($findedSpecie) {
                    $country = $specie->origin_country->name;
                    
                    $speciesIdsWithPivot[$findedSpecie->id] = [ "qty" => $specie->qty,
                                                            "description" => $specie->description,
                                                            "origin" => $specie->origin,
                                                            "origin_country" => $country,
                                                            "file_url" => null,
                    ];
                } else {
                    $apiSpecie = $this->api_cites($name);
                    $newSpecie = new Specie();
                    $newSpecie->type = $apiSpecie->higher_taxa->kingdom;
                    $newSpecie->appendix = $apiSpecie->cites_listing;       
                    $newSpecie->name_scientific = $apiSpecie->full_name;       
                    if (count($apiSpecie->common_names) > 0) {

                        $commonNames = array_filter($apiSpecie->common_names, function ($name) {
                            {
                                if ($name->language === 'ES') {
                                    return $name;
                                } elseif ($name->language === 'EN') {
                                    return $name;
                                }
                            }
                        });
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
                    // $specieAlgo = $apiSpecie;
                    array_push($searchedSpecies, $specie);

                    $speciesIdsWithPivot[$newSpecie->id] = [ "qty" => $specie->qty,
                                                            "description" => $specie->description,
                                                            "origin" => $specie->origin,
                                                            "origin_country" => $specie->origin_country->name,
                                                            "file_url" => null,
                    ];
                }
                $permit->species()->sync($speciesIdsWithPivot);
        
                $permit->save();
                
            } else {
                $permit = Permit::find($permitId);
                $name = $specie->name_common;
                $findedSpecie = Specie::where('name_scientific', '=', $name)->get()->first();
                if ($findedSpecie) {
                    $country = $specie->origin_country->name;
                    
                    $speciesIdsWithPivot[$findedSpecie->id] = [ "qty" => $specie->qty,
                                                            "description" => $specie->description,
                                                            "origin" => $specie->origin,
                                                            "origin_country" => $country,
                                                            "file_url" => null,
                    ];
                } else {
                    $apiSpecie = $this->api_cites($name);
                    $newSpecie = new Specie();
                    $newSpecie->type = $apiSpecie->higher_taxa->kingdom;
                    $newSpecie->appendix = $apiSpecie->cites_listing;       
                    $newSpecie->name_scientific = $apiSpecie->full_name;       
                    if (count($apiSpecie->common_names) > 0) {

                        $commonNames = array_filter($apiSpecie->common_names, function ($name) {
                            {
                                if ($name->language === 'ES') {
                                    return $name;
                                } elseif ($name->language === 'EN') {
                                    return $name;
                                }
                            }
                        });
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
                    $specieAlgo = $apiSpecie;
                    array_push($searchedSpecies, $apiSpecie);

                    $speciesIdsWithPivot[$newSpecie->id] = [ "qty" => $specie->qty,
                                                            "description" => $specie->description,
                                                            "origin" => $specie->origin,
                                                            "origin_country" => $specie->origin_country->name,
                                                            "file_url" => null,
                    ];
                }
                $permit->species()->sync($speciesIdsWithPivot);
        
                $permit->save();
            }
            $index++;
        }
        // return $speciesIdsWithPivot;
        Log::info('El solicitante con la cedula de identidad '.$this->returnUser().'a solicitado un nuevo permiso | El permiso se ha solicitado desde la direccion: '. request()->ip());
        return response('Se ha solicitado el permiso, dirijase a la oficina del MINEC para entregar los recaudos.', 200);
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

    public function requestPermit($id)
    {
        $permit = Permit::find($id);
        $permit->status = 'requested';
        $permit->save();
        return response('Solicitud de Permiso finalizada', 200);
    }
    public function addSpecie(Request $request)
    {
        $specie = json_decode($request->input('specie'));
        $permit = json_decode($request->input('permit'));
        // return $specie;
        $specie_name = $specie->name_common;
        $permit_id = $permit->id;
        $getPermit = Permit::where(['id' => $permit_id])->get()->first();
        
        $findedSpecie = Specie::where('name_common', '=', $specie_name)->get()->first();
        
        if($findedSpecie) {  
            $speciesIdsWithPivot[$findedSpecie->id] = ["qty" => $specie->qty, "file_url" => $specie->pivot->file_url, "is_valid" => false];
            $getPermit->species()->attach($speciesIdsWithPivot);
        }
        else{
            $newSpecie = new Specie();
            $newSpecie->type = $specie->kingdom;
            $newSpecie->name_scientific = $specie->name_common;
            $newSpecie->name_common = $specie->name_common;
            // $newSpecie->search_id = $specie->search_id;
            $newSpecie->search_id = 1;
            $newSpecie->save();
            $speciesIdsWithPivot[$newSpecie->id] = ["qty" => $specie->qty, "file_url" => $specie->pivot->file_url, "is_valid" => false];
            $getPermit->species()->attach($speciesIdsWithPivot);
        }
        return response('Especie Añadida', 200);
    }
    public function deleteSpecie(Request $request)
    {
        $specie = json_decode($request->input('specie'));
        $permit = json_decode($request->input('permit'));
        // return $specie;
        $permit_id = $permit->id;
        $getPermit = Permit::where(['id' => $permit_id])->get()->first();
        
        // $findedSpecie = Specie::where('name_common', '=', $specie_name)->get()->first();
        
        $getPermit->species()->detach($specie->id);
        
        return response('Especie Eliminada', 200);
    }
    public function storeFile(Request $request)
    {
        $file = $request->file('file');
        $requeriment = json_decode($request->input('requeriment'));
        $requeriment_id = $requeriment->id;
        $permit_id = $requeriment->pivot->permit_id;
        // return $permit_id;
        $nameFile = "permit_".$permit_id."_requeriment_".$requeriment_id."_file_".time().".".$file->guessExtension();
        $url = $request->file('file')->storeAs('files/permissions', $nameFile);
        $permit = Permit::find($permit_id);
        $permit->requeriments[$requeriment_id -1]->pivot->file_url = $url;
        $permit->push();
        
        Log::info('El solicitante con la cedula de identidad '.$this->returnUser().'a cargado un archivo | El archivo se ha cargado desde la direccion: '. request()->ip());
        return $url;
    }
    public function deleteFile($id, Request $request)
    {
        
        $requeriment = json_decode($request->input('requeriment'));
        $requeriment_id = $requeriment->id;
        $requeriment_url = $requeriment->pivot->file_url;
        
        Storage::delete(str_replace("/storage/", "", $requeriment_url));
        
        $permit = Permit::find($id);
        $permit->requeriments[$requeriment_id -1]->pivot->file_url = null;
        $permit->push();
        Log::info('El solicitante con la cedula de identidad '.$this->returnUser().'a eliminado un archivo | El archivo se ha eliminado desde la direccion: '. request()->ip());
        return response('Archivo Eliminado', 200);
    }
    public function storeSpecieFile(Request $request)
    {
        $file = $request->file('file');
        $specie = json_decode($request->input('specie'));
        $permit = json_decode($request->input('permit'));
        $isNew = json_decode($request->input('isNew'));
        $index = $request->input('index');
        $specie_name = $specie->name_common;
        $permit_id = $permit->id;
        $nameFile = "permit_".$permit_id."_specie_".$specie_name."_file_".time().".".$file->guessExtension();
        $url = $request->file('file')->storeAs('files/permissions', $nameFile);
        if (!$isNew) {
            $permit = Permit::find($permit_id);
            $permit->species[$index]->pivot->file_url = $url;
            $permit->push();
        }

        return $url;
    }
    public function deleteSpecieFile($id, Request $request)
    {
        
        $specie = json_decode($request->input('specie'));
        $index = $request->input('index');
        $specie_url = $specie->pivot->file_url;
        
        Storage::delete(str_replace("/storage/", "", $specie_url));
        
        $permit = Permit::find($id);
        $permit->species[$index]->pivot->file_url = null;
        $permit->push();
        return response('Archivo Eliminado', 200);
    }
    public function showFile($name)
    {
        return Response::make(Storage::get('files/permissions/'. $name), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$name.'"'
        ]);
    }    
    public function checkPermit(Request $request, $id)
    {
        $permit = Permit::find($id);
        $newRequeriment = json_decode($request->input('requeriment'));
        $pivot = $newRequeriment->pivot;
        $requeriment_id = $newRequeriment->id;
        if ($pivot->is_valid) {
            $pivot->is_valid = 1;
            $permit->requeriments[$requeriment_id -1]->pivot->is_valid = $pivot->is_valid;
        } else {
            $pivot->is_valid = 0;
            $permit->requeriments[$requeriment_id -1]->pivot->is_valid = $pivot->is_valid;
        }
        Log::info('El usuario con la cedula de identidad '.$this->returnUser().'a verificado el permiso | desde la direccion: '. request()->ip());
        $permit->push();

        return response('Estatus del Requerimiento Actualizado.', 200);
    }
    public function checkSpecies(Request $request, $id)
    {
        $permit = Permit::find($id);
        $newSpecie = json_decode($request->input('specie'));
        $index = $request->input('index');
        // return $newSpecie;
        $pivot = $newSpecie->pivot;
        $specie_id = $newSpecie->id;
        if ($pivot->is_valid) {
            $pivot->is_valid = 1;
            $permit->species[$index]->pivot->is_valid = $pivot->is_valid;
        } else {
            $pivot->is_valid = 0;
            $permit->species[$index]->pivot->is_valid = $pivot->is_valid;
        }
        
        $permit->push();
        Log::info('El official con la cedula de identidad '.$this->returnUser().'a verificado el requerimineto  | desde la direccion: '. request()->ip());
        return response('Estatus del Requerimiento Actualizado.', 200);
    }
    public function validPermit(Request $request, $id)
    {
        $permit = Permit::find($id);
        $date = strtotime("+180 day");
        $permit->valid_until = date('M d, Y', $date);
        $permit->official_id= $request->input('official_id');
        $permit->sistra= $request->input('sistra');
        $permit->status= 'valid';
        
        $permit->save();
        Log::info('El official con la cedula de identidad '.$this->returnUser().'a verificado el permiso  | el permiso de a verificado desde la direccion: '.request()->ip());
        return response('Estatus del Requerimiento Actualizado.', 200);
    }
    public function printAprovedPermit($id)
    {
        
        return response('Permiso Impreso.', 200);
    }

    public function filterApplicant(Request $request){
        $filter  = $request->get('filter');

        switch($filter){
            case is_numeric($filter) :
                $filterApplicant = User::where('dni', 'like', '%'.$filter.'%' )->with(['client.permits'])->get();
                return $filterApplicant;
            break;
            case is_string($filter):
                $filterApplicant = User::where('name', 'like', '%'.$filter.'%' )->with(['client.permits'])->get();
                return $filterApplicant;
            break;
        }  
    }

    public function filterOfficial(Request $request){
        $filter  = $request->get('filter');

        switch($filter){
            case is_numeric($filter) :
                $filterOficial = User::where('dni', 'like', '%'.$filter.'%' )->with([])->get();
                $filterOficial = User::where('dni', 'like', '%'.$filter.'%' )->with(['official.permits', 'client.permits'])->get();
                return $filterOficial;
            break;
            case is_string($filter):
                $filterOficial = User::where('name', 'like', '%'.$filter.'%' )->with(['official.permits', 'client.permits'])->get();
                return $filterOficial;
            break;
        }  
    }

    public function filterCountry(Request $request){
        //$filter  = $request->get('filter');
        $filterCountry = Permit::with('client', 'client.user')->get();
        return $filterCountry;
    }

    public function filterDate(Request $request){
        $filter  = $request->get('filter');
        return $filterCountry = Permit::where('created_at', 'like', '%'.$filter.'%' )->with('client', 'client.user')->get();
    }

    public function dayMoreTen(){

        //create variable for  upload file limit date  
        //$dayNow = Carbon::now();//->toDateString();
        $dayAddTen = Carbon::now()->addDays(10);
        if ($dayAddTen->isWeekend()) {
            return  $dayAddTen->addDays(2)->toDateString();
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\JsonableInterface; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ValidFormaliteMail;
use App\Mail\createFormaliteMail;
use App\Mail\DateToUploadTheRequirementsWasExceeded;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Mail\sendErrorsMail;
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
// use PDF;
use Knp\Snappy\Pdf;

use App\Models\Specie;
use Illuminate\Support\Facades\Storage;
use Response;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\App;
use SebastianBergmann\CodeUnit\FunctionUnit;

class PermissionController extends Controller
{
    // GET functions

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
        $formalities = Formalitie::where(['client_id' => $clientData->id])->with(['permits.requeriments', 'permits.permit_type', 'permits.species', 'client.user'])->paginate(5);
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
            $clientData = Client::with('user')->where(['id' => auth()->user()->id])->get()->first();
            // return $clientData;
            $formalitie = Formalitie::where(['id' => $id])->with(['permits.requeriments', 'permits.permit_type', 'permits.species', 'client.user'])->get()->first();
            // $permit = Permit::where(['id' => $id])->with(['requeriments', 'permit_type', 'species'])->get();
            if ($formalitie) {
                // return $permit;
                return view('permissions.requirements.upload_requeriments', compact('formalitie', 'clientData'));
            }
            else {
                return view('errors.404');
            }
        } catch (Exception $err) {
            return view('errors.404');
        }
    }

    public function showPermitsView()
    {
        $permit_types = PermitType::with(['departament', 'requeriments'])->paginate(10);
        return view('panel.dashboard.permissions.permits_view', compact('permit_types'));
    }

    public function getList()
    {
        $clientData = Client::with('user')->where('id', '=', auth()->user()->id)->get()->first();
        if ($clientData) {
            $clientId = $clientData->id;
        } else {
            $clientId = -1;
        }
        $formalities = Formalitie::with(['permits.requeriments', 'permits.permit_type', 'permits.species', 'client.user'])->whereNotIn('client_id', [$clientId])->paginate(5);
        // $permissions = Permit::with(['requeriments', 'permit_type', 'species', 'client.user'])->whereNotIn('client_id', [$clientId])->get();
        return view('panel.dashboard.permissions.permissions', compact('formalities'));
    }

    public function showChecklist($id)
    {
        $getFormalitie= Formalitie::find($id);
        // $getPermit= Permit::find($id);
        $officialData = Official::with('user')->where('id', '=', auth()->user()->id)->get()->first();
        
        // return $getFormalitie->client->user_id;
        if ($officialData->user_id !== $getFormalitie->client->user_id) {
            $formalitie = Formalitie::where(['id' => $id])->with(['permits.requeriments', 'permits.permit_type', 'permits.species', 'client.user'])->get()->first();
        } else {
            $formalitie = null;
        }
        // return $formalitie;
        if ($formalitie) {
            return view('panel.dashboard.permissions.check_requirements', compact('formalitie', 'officialData'));
        } else {
            return view('errors.404');
        }
    }

    public function showPermitInfo($id) 
    {
        // return $id;
        $permit = Permit::where(['request_permit_no' => $id])->with(['requeriments', 'permit_type', 'formalitie.client.user',
        'formalitie.official.user', 'species'])->get()->first();
        // return $permit;
        if ($permit->status === 'committed' || $permit->status === 'valid') {
            return view('permissions.permitInfo', compact('permit'));
        } else {
            return view('errors.404');
        }
    }

    public function showAprovedPermit($id)
    {
        $permit = Permit::where(['id' => $id])->with(['requeriments', 'permit_type', 'formalitie.client.user',
        'formalitie.official.user', 'species'])->get()->first();
        // return $permit;
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $image = base64_encode(file_get_contents(public_path('/images/logos/logo-minec.png')));
        $logo = $image;
        $host = $_SERVER["HTTP_HOST"];
        $GcodeQr = QrCode::generate($host.'/permitInfo/'.$permit->request_permit_no, storage_path('app/files/qrcodes/'.$permit->request_permit_no.'.svg'));
        $codeQr = base64_encode(file_get_contents(storage_path('app/files/qrcodes/'.$permit->request_permit_no.'.svg')));
        $pdf->loadView('permissions.aproved_permit', [ 'permit' => $permit, 'logo' => $image, 'codeQr' => $codeQr]);
        return $pdf->stream();
        
        return view('permissions.aproved_permit', compact('permit', 'logo', 'codeQr'));
    }
    public function getDataQr($id){
        return Permit::where("request_permit_no", '=', $id)->with('formalitie.client')->first();
        return "hi";
    }

    // POST functions

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
        $formalitie->collected_time = $this->dayMoreTen();
        // return $formalitie;
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
                    if ($requeriment->type === 'form') {
                        $requerimentsIdsWithPivot[$requeriment->id] = ["file_url" => null, "is_valid" => true,];
                    } else if ($requeriment->short_name === 'cedula') {
                        $client = Client::find($getClientId);
                        if ($client->dni_file_url) {
                            $requerimentsIdsWithPivot[$requeriment->id] = ["file_url" => $client->dni_file_url, "is_valid" => true,];
                        } else {
                            $requerimentsIdsWithPivot[$requeriment->id] = ["file_url" => null, "is_valid" => false,];
                        }

                    } else {
                        $requerimentsIdsWithPivot[$requeriment->id] = ["file_url" => null, "is_valid" => null,];
                    }
                }
                
                $permit->requeriments()->sync($requerimentsIdsWithPivot);
                // break;

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
                                } else if ($name->language === 'EN') {
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
                                } else if ($name->language === 'EN') {
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
        // return $formalitie->permits[0]->requeriments;
        // return $speciesIdsWithPivot;
        Log::info('El solicitante con la cedula de identidad '.$this->returnUser().'a solicitado un nuevo permiso | El permiso se ha solicitado desde la direccion: '. request()->ip());
        Mail::to(auth()->user()->email)->send(new createFormaliteMail($formalitie));
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
        $formalitie = Formalitie::find($id);
        $formalitie->status = 'requested';
        foreach ($formalitie->permits as $permit) {
            $permit->status = 'requested';
            $permit->save();
            foreach ($permit->requeriments as $requeriment) {
                if ($requeriment->pivot->is_valid === null) {
                    $permit->requeriments()->updateExistingPivot($requeriment, array('is_valid' => 0, 'file_url' => $requeriment->file_url), false);
                    // $requeriment->pivot->is_valid = 0;
                    $requeriment->save();
                }
            }
            // $permit->requeriments->save();
        }
        $formalitie->save();
        return response('Solicitud de Permiso finalizada', 200);
    }

    public function savePersonalFile(Request $request)
    {
        $requeriment = json_decode($request->input('requeriment'));
        $index = json_decode($request->input('index'));
        $url = json_decode($request->input('url'));
        $permit_id = $requeriment->pivot->permit_id;
        $permit = Permit::find($permit_id);
        $permit->requeriments[$index]->pivot->file_url = $url;
        $permit->push();
        return $url;
    }

    public function storeFile(Request $request)
    {
        $file = $request->file('file');
        $requeriment = json_decode($request->input('requeriment'));
        $index = json_decode($request->input('index'));
        $requeriment_id = $requeriment->id;
        $permit_id = $requeriment->pivot->permit_id;
        // return $permit_id;
        $nameFile = "permit_".$permit_id."_requeriment_".$requeriment_id."_file_".time().".".$file->guessExtension();
        $url = $request->file('file')->storeAs('files/permissions', $nameFile);
        $permit = Permit::find($permit_id);
        $permit->requeriments[$index]->pivot->file_url = $url;
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
        $index = json_decode($request->input('index'));
        $pivot = $newRequeriment->pivot;
        $requeriment_id = $newRequeriment->id;
        if ($pivot->is_valid) {
            $pivot->is_valid = 1;
            $permit->requeriments[$index]->pivot->is_valid = $pivot->is_valid;
        } else {
            $pivot->is_valid = 0;
            $permit->requeriments[$index]->pivot->is_valid = $pivot->is_valid;
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
        $formalitie = Formalitie::find($id);
        $formalitie->sistra= $request->input('sistra');
        $formalitie->status= 'valid';
        $formalitie->official_id= $request->input('official_id');
        $formalitie->save();

        $date = strtotime("+180 day");
        foreach ($formalitie->permits as $permit) {
            $permit->valid_until = date('M d, Y', $date);
            $permit->sistra= $request->input('sistra');
            $permit->status= 'valid';
            $permit->save();
        }
        $formalitie->save();
        
        $emailClient = Formalitie::with('client')->where('formalities.id', '=', $id)->get();
        foreach ($emailClient as $client) {
            Mail::to($client->client->email)->send(new ValidFormaliteMail($formalitie));
        }
        Log::info('El official con la cedula de identidad '.$this->returnUser().'a verificado el permiso  | el permiso de a verificado desde la direccion: '.request()->ip());
        
        return response('Estatus del Requerimiento Actualizado.', 200);
    }

    public function sendErrors(Request $request, $id)
    {
        $formalitie = Formalitie::find($id);
        $formalitie->status= 'uploading_requeriments';
        $formalitie->official_id= $request->input('official_id');
        $formalitie->observations= $request->input('observations');
        $formalitie->save();

        $date = strtotime("+180 day");
        foreach ($formalitie->permits as $permit) {
            // $permit->valid_until = date('M d, Y', $date);
            $permit->status= 'uploading_requeriments';
            $formalitie->collected_time = $this->dayMoreFive();
            $permit->save();
        }
        $formalitie->save();
        $emailClient = Formalitie::with('client')->where('formalities.id', '=', $id)->get();
        foreach ($emailClient as $client) {
            Mail::to($client->client->email)->send(new sendErrorsMail($formalitie));
        }
        return response('Se ha enviado un correo con los problemas y se ha actualizado el estado', 200);
    }

    public function printAprovedPermit($id)
    {
        return response('Permiso Impreso.', 200);
    }

    // Utils

    public function filterApplicant(Request $request)
    {
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

    public function filterOfficial(Request $request)
    {
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

    public function filterCountry(Request $request)
    {
        //$filter  = $request->get('filter');
        $filterCountry = Permit::with('client', 'client.user')->get();
        return $filterCountry;
    }

    public function filterDate(Request $request)
    {
        $filter  = $request->get('filter');
        return $filterCountry = Permit::where('created_at', 'like', '%'.$filter.'%' )->with('client', 'client.user')->get();
    }

    public function dayMoreTen()
    {

        //create variable for  upload file limit date  
        $dayNow = Carbon::now();
        $dayAddTen = Carbon::now()->addDays(10);


        /**/
        $year = Carbon::now()->format('Y');
        $workingDays = [$year."-09-07", $year."-09-08", $year."-01-01", $year."-02-11", $year."-02-12", $year."-03-28", $year."-03-29", $year."-04-19", $year."-05-01", $year."-05-25", $year."-06-20", $year."-06-24", $year."-06-29", $year."-07-05", $year."-07-24", $year."-10-12", $year."-12-24", $year."-12-25", $year."-12-31"];
        foreach ($workingDays as $workingDay) {

            if ($this->check_in_range($dayNow, $dayAddTen, $workingDay))
            {
               $dayAddTen->addDays(1)->toDateString();
            }
        }
        if ($dayAddTen->isWeekend()) {
            $dayAddTen->addDays(2);
        }
        return $dayAddTen->toDateString();
        
    }

    public function dayMoreFive()
    {

        //create variable for  upload file limit date  
        $dayNow = Carbon::now();
        $dayAddTen = Carbon::now()->addDays(5);


        /**/
        $year = Carbon::now()->format('Y');
        $workingDays = [$year."-09-07", $year."-09-08", $year."-01-01", $year."-02-11", $year."-02-12", $year."-03-28", $year."-03-29", $year."-04-19", $year."-05-01", $year."-05-25", $year."-06-20", $year."-06-24", $year."-06-29", $year."-07-05", $year."-07-24", $year."-10-12", $year."-12-24", $year."-12-25", $year."-12-31"];
        foreach ($workingDays as $workingDay) {

            if ($this->check_in_range($dayNow, $dayAddTen, $workingDay))
            {
               $dayAddTen->addDays(1)->toDateString();
            }
        }
        if ($dayAddTen->isWeekend()) {
            $dayAddTen->addDays(2);
        }
        return $dayAddTen->toDateString();
        
    }

    public function check_in_range($dayNow, $dayAddTen, $workingDay)
    {

        $dayNow = strtotime($dayNow);
        $dayAddTen = strtotime($dayAddTen);
        $workingDay = strtotime($workingDay);

        if(($workingDay >= $dayNow) && ($workingDay <= $dayAddTen)) {
   
            return true;
   
        } else {
   
            return false;
   
        }
    }

}





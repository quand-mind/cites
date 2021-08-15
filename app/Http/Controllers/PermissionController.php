<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
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
    public function storeFile(Request $request)
    {
        $file = $request->file('file');
        $requeriment = json_decode($request->input('requeriment'));
        $requeriment_id = $requeriment->id;
        $permit_id = $requeriment->pivot->permit_id;
        $nameFile = "permit_".$permit_id."_requeriment_".$requeriment_id."_file_".time().".".$file->guessExtension();
        $url = $request->file('file')->storeAs('files/permissions', $nameFile);
        $permit = Permit::find($permit_id);
        $permit->requeriments[$requeriment_id -1]->pivot->file_url = $url;
        $permit->push();

        return $url;
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
    public function showFile($name)
    {
        return Response::make(Storage::get('files/permissions/'. $name), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$name.'"'
        ]);
    }
    public function requestPermit($id)
    {
        $permit = Permit::find($id);
        $permit->status = 'requested';
        $permit->save();
        return response('Solicitud de Permiso finalizada', 200);
    }
    public function deleteFile($id, Request $request)
    {
        
        $requeriment = json_decode($request->input('requeriment'));
        $requeriment_id = $requeriment->id;
        $requeriment_url = $requeriment->pivot->file_url;
        
        Storage::delete(str_replace("/storage/", "", $requeriment_url));
        
        $permit = Permit::find($id);
        $permit->requeriments[$requeriment_id -1]->pivot->file_url = null;
        $permit->requeriments[$requeriment_id -1]->pivot->file_errors = null;
        $permit->push();
        return response('Archivo Eliminado', 200);
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
    public function index()
    {
        //$id = 1;
        $clientData = User::with('clients')->where('id', '=', auth()->user()->id )->get();
        $permissions = Permit::where(['client_id' => auth()->user()->id])->with(['requeriments', 'permit_type'])->get();
        //return $clientData;
        return view('permissions.permissions', compact('permissions', 'clientData'));
    }
    public function getList()
    {
        $permissions = Permit::with(['requeriments', 'permit_type'])->get();
        return view('panel.dashboard.permissions.permissions', compact('permissions'));
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
            $permit->requeriments[$requeriment_id -1]->pivot->file_errors = null;
        } else {
            $pivot->is_valid = 0;
            $permit->requeriments[$requeriment_id -1]->pivot->is_valid = $pivot->is_valid;
            $permit->requeriments[$requeriment_id -1]->pivot->file_errors = $pivot->file_errors;
        }
        
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
            $permit->species[$index]->pivot->file_errors = null;
            $permit->species[$index]->pivot->is_valid = $pivot->is_valid;
        } else {
            $pivot->is_valid = 0;
            $permit->species[$index]->pivot->is_valid = $pivot->is_valid;
            $permit->species[$index]->pivot->file_errors = $pivot->file_errors;
        }
        
        $permit->push();
        
        return response('Estatus del Requerimiento Actualizado.', 200);
    }

    public function showComercialExportSpecies()
    {   
        return view('permissions.requirements.comercial_export_species_requirements');
    }
    public function getForm($id)
    {   
        $clientData = User::with('clients')->where('id', '=', auth()->user()->id)->get();
        $permitType = PermitType::with(['requeriments'])->where('id', '=', $id)->get();
        return view('permissions.permit_form', compact(['permitType', 'clientData']));
    }
    public function showChecklist($id)
    {
        try {
            $permit = Permit::where(['id' => $id])->with(['requeriments', 'permit_type', 'species'])->get();
            if ($permit) {
                return view('panel.dashboard.permissions.check_requirements', compact('permit'));
            }
            else {
                return view('errors.404');
            }
        } catch (Exception $err) {
            return view('errors.404');
        }
    }
    public function showUploadRequeriments($id)
    {
        try {
            $permit = Permit::where(['id' => $id])->with(['requeriments', 'permit_type', 'species'])->get();
            if ($permit) {
                // return $permit;
                return view('permissions.requirements.upload_requeriments', compact('permit'));
            }
            else {
                return view('errors.404');
            }
        } catch (Exception $err) {
            return view('errors.404');
        }
    }
    public function storePermit(Request $request)
    {
        $Date_day = Carbon::now()->format('Y-m-d');
        $DateDay = Carbon::now()->format('Ymd');

        $permisos =  Permit::where('created_at', 'like', '%'.$Date_day.'%')->count();

        $faker = Faker::create();

        $getPermitTypeId = $request->input('permit_type_id');
        $getPersonals = json_decode($request->input('personals'));
        $getPermit = json_decode($request->input('permit'));
        $getClientId = $request->input('client_id');
        $getSpecies = json_decode($request->input('species'));

        // return $getSpecies;
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
        $date = strtotime("+60 day");
        $permit->valid_until = date('M d, Y', $date);
        $permit->purpose = $getPermit->purpose;
        $permit->transportation_way = $getPermit->transportation_way;
        $permit->consigned_to = $getPermit->consigned_to;
        $permit->country = $getPermit->country;
        $permit->landing_port = $getPermit->landing_port;
        $permit->shipment_port = $getPermit->shipment_port;
        $permit->destiny_place = $getPermit->destiny_place;
        $permit->departure_place = $getPermit->departure_place;
        $permit->status = "uploading_requeriments";
        $permit->client_id = $request->input('client_id');
        $permit->save();

        $user = User::where(['id' =>  $getClientId])->get()->first();
        $user->phone = $getPersonals->phone;
        $user->mobile = $getPersonals->mobile;
        $user->fax = $getPersonals->fax;
        $user->push();
        // return $user;
        

        
        $permitType = PermitType::where(['id' =>  $getPermitTypeId])->with(['requeriments'])->get()->first();

        $requeriments = $permitType->requeriments;

        foreach($requeriments as $requeriment) {
            $requerimentsIdsWithPivot[$requeriment->id] = ["file_url" => null, "is_valid" => false, "file_errors" => null];
        }


        $speciesIdsWithPivot=[];

        foreach($getSpecies as $specie) {
            $name = $specie->name_common;
            $findedSpecie = Specie::where('name_scientific', '=', $name)->get()->first();
            if($findedSpecie) {
                
                $speciesIdsWithPivot[$findedSpecie->id] = ["qty" => $specie->qty];
            }
            else{
                $newSpecie = new Specie();
                $newSpecie->type = $specie->kingdom;
                $newSpecie->name_scientific = $specie->name_common;
                $newSpecie->name_common = $specie->name_common;
                // $newSpecie->search_id = $specie->search_id;
                $newSpecie->search_id = 1;
                $newSpecie->save();

                $speciesIdsWithPivot[$newSpecie->id] = ["qty" => $specie->qty];
            }
        }
        $permit->species()->sync($speciesIdsWithPivot);


        $permit->requeriments()->sync($requerimentsIdsWithPivot);
        $permit->save();

        return response('Se ha solicitado el permiso, dirijase a la oficina del MINEC para entregar los recaudos.', 200);
    }

    /*public function count(){

        $Date_day = Carbon::now()->format('Y-m-d');
        $DateDay = Carbon::now()->format('Ymd');

        $countPermit =  Permit::where('created_at','like', '%'.$Date_day.'%')->count();
        switch($countPermit){
            case $countPermit < 10 :
                $total_pemisos_dia = $countPermit + 1; 
                return $DateDay.'00'.$total_pemisos_dia;
            break;
            case $countPermit >= 10 :
                $total_pemisos_dia = $countPermit + 1; 
                return $DateDay.'0'.$total_pemisos_dia;
            break;
        }
        /*if ($permisos < 10) {

            $total_pemisos_dia = $permisos + 1; 
        }
        //return $DateDay.'00'.$total_pemisos_dia;
    }*/
}

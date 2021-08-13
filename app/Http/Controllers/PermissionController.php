<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker;
use App\Models\permit;
use App\Models\PermitType;
use App\Models\Requeriment;
use App\Models\Specie;
use Illuminate\Support\Facades\Storage;
use Response;
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
        $permit = permit::find($permit_id);
        $permit->requeriments[$requeriment_id -1]->pivot->file_url = $url;
        $permit->push();

        return $url;
    }
    public function showFile($name)
    {
        return Response::make(Storage::get('files/permissions/'. $name), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$name.'"'
        ]);
    }
    public function storeSpecieFile(Request $request)
    {
        $file = $request->file('file');
        $specie = json_decode($request->input('specie'));
        $specie_id = $specie->id;
        $permit_id = $specie->pivot->permit_id;
        $nameFile = "permit_".$permit_id."_specie_".$specie_id."_file_".time().".".$file->guessExtension();
        $url = $request->file('file')->storeAs('files/permissions', $nameFile);
        $permit = permit::find($permit_id);
        $permit->species[$specie_id -1]->pivot->file_url = $url;
        $permit->push();

        return $url;
    }
    public function index()
    {
        $id = 1;
        $permissions = permit::where(['client_id' => $id])->with(['requeriments', 'permit_type'])->get();
        return view('permissions.permissions', compact('permissions'));
    }
    public function getList()
    {
        $permissions = permit::with(['requeriments', 'permit_type'])->get();
        return view('panel.dashboard.permissions.permissions', compact('permissions'));
    }
    public function checkPermit(Request $request, $id)
    {
        $permit = permit::find($id);
        $newRequeriment = (object) $request->input('requeriment');
        $pivot = (object) $newRequeriment->pivot;
        if ($pivot->is_valid) {
            $pivot->is_valid = 1;
        } else {
            $pivot->is_valid = 0;
        }
        $requeriment_id = $newRequeriment->id;
        
        $permit->requeriments[$requeriment_id -1]->pivot->is_valid = $pivot->is_valid;
        $permit->push();
        
        return response('Estatus del Requerimiento Actualizado.', 200);
    }

    public function showComercialExportSpecies()
    {   
        return view('permissions.requirements.comercial_export_species_requirements');
    }
    public function showChecklist($id)
    {
        try {
            $permit = permit::where(['id' => $id])->with(['requeriments', 'permit_type', 'species'])->get();
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
    public function storePermit(Request $request)
    {
        $faker = Faker::create();
        $permit = new permit();
        $permit_no = intval($faker->ean8());
        $permit->request_permit_no = $permit_no;
        $permit->permit_type_id = $request->input('permit_type_id');
        $date = strtotime("+60 day");
        $permit->valid_until = date('M d, Y', $date);
        $permit->purpose = $request->input('purpose');
        $permit->status = "requested";
        $permit->client_id = $request->input('client_id');
        $permit->save();
        
        $species = $request->input('species');

        foreach($species as $specie) {
            $name = $specie['name'];
            $findedSpecie = Specie::where('name_scientific', '=', $name)->get()->first();
            if($findedSpecie) {
                
                $speciesIdsWithPivot[$findedSpecie->id] = ["qty" => $specie['qty']];
            }
            else{
                $newSpecie = new Specie();
                $newSpecie->type = $specie['kingdom'];
                $newSpecie->name_scientific = $specie['name'];
                $newSpecie->name_common = $specie['name'];
                // $newSpecie->search_id = $specie->search_id;
                $newSpecie->search_id = 1;
                $newSpecie->save();

                $speciesIdsWithPivot[$newSpecie->id] = ["qty" => $specie['qty']];
            }
        }
        $permit->species()->sync($speciesIdsWithPivot);
        $permitType = PermitType::where(['id' =>  $permit->permit_type_id])->with(['requeriments'])->get()->first();

        $requeriments = $permitType->requeriments;

        foreach($requeriments as $requeriment) {
            $requerimentsIdsWithPivot[$requeriment->id] = ["file_url" => null, "is_valid" => false, "file_errors" => null];
        }


        $permit->requeriments()->sync($requerimentsIdsWithPivot);
        $permit->save();

        return response('Se ha solicitado el permiso, dirijase a la oficina del MINEC para entregar los recaudos.', 200);
    }
}

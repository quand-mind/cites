<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker;
use App\Models\permit;
use Exception;

class PermissionController extends Controller
{
    public function index()
    {
        $id = 1;
        $permissions = permit::where(['client_id' => $id])->with(['requeriments', 'permit_type'])->get();
        return view('permissions.permissions', compact('permissions'));
    }

    public function showComercialExportSpecies()
    {   
        return view('permissions.requirements.comercial_export_species_requirements');
    }
    public function showComercialExportSpeciesChecklist($id)
    {
        try {
            $permit = permit::where(['id' => $id, 'permit_type' => 'comercial_export'])->get();
            if ($permit) {
                return view('panel.dashboard.permissions.check_comercial_export_requirements', compact('permit'));
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
        try {
            $permit = new permit();
            $permit_no = intval($faker->ean8());
            $permit->request_permit_no = $permit_no;
            $permit->permit_type = $request->input('type');
            $date = strtotime("+60 day");
            $permit->valid_until = date('M d, Y', $date);
            $permit->purpose = $request->input('purpose');
            $permit->status = "requested";
            $permit->client_id = $request->input('client_id');
            $permit->official_id = null;
            $permit->save();
            return response('Se ha solicitado el permiso, dirijase a la oficina del MINEC para entregar los recaudos.', 200);
        } catch (\Exception $err) {
            return response($err, 500);
        } 
    }
}

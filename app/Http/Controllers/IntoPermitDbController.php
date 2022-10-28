<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

use App\Imports\PermitTypeImport;
use App\Models\PermitType;
use App\Models\Requeriment;

class IntoPermitDbController extends Controller
{
    public function readFileXlsx(Request $request)
    {
        
        $collectionPermits = Excel::toArray(new PermitTypeImport, 'permissions_files\CITES_MINEC_Tramites_vs_requisitos_consolidados_y_detallados.xlsx');
        //save permit
        $array=[];
        foreach ($collectionPermits as $collectionPermit[2]) {
            foreach ($collectionPermit as $listPermit) {
                array_push($array, $listPermit[2]);
            }
        }
        foreach ($array as $permit) {
            for ($i=2; $i < 63 ; $i++) { 
                $permitType = new PermitType();
                $permitType->name = $permit[$i];
                $permitType->status = 'active';
                $permitType->departament_id = 1;
                $permitType->save();
            }//return $permit[3];
        }
        $requerimentArray=[];
        foreach($collectionPermits as $collectionPermit){
            for ($j=4; $j <= 54 ; $j++) { 
                array_push($requerimentArray, $collectionPermit[$j]);
            }
        }
    
        foreach ($requerimentArray as $requeriment) {
            for ($i=3; $i < 51 ; $i++) { 
                //return $requeriment[$i];
                $consulta = Requeriment::where('name', '=', $requeriment[$i])->get();
                //return count($consulta);
                if (count($consulta) == 0 && $requeriment[$i] !== NULL) {
                    
                    /*$requeriment = new Requeriment();
                    
                    
                    $requeriment->name =$requeriment[$i];
                    $requeriment->short_name = 'sda';
                    $requeriment->type = 'physical';
                    $requeriment->save();*/
                    //return "no se encontro una coincidencia";

                    Requeriment::create([
                        'name' =>$requeriment[$i],
                        'type' => 'physical'
                    ]);
                }
                
            }
        }

        return "finish Upload data of file .XLSx";
    
    }

    public function showPermitTypes()
    {
        return PermitType::get();
    }

    public function addPermitType(Request $request)
    {
        $newPermit = json_decode($request->input('permit'));
        $permit = new PermitType;
        $permit->name = $newPermit->name;
        $permit->status = $newPermit->status;
        $permit->departament_id = $newPermit->departament_id;
        $permit->type = $newPermit->type;
        $permit->save();

        $requeriments = $request->only('requeriments');
        $requeriments = json_decode($requeriments['requeriments']);

        $requerimentsIds = array_map(function ($requeriment) {
            return $requeriment->id;
        }, $requeriments );


        $permit->requeriments()->sync($requerimentsIds);

        return response('Nuevo Permiso Guardado', 200);
    }

    public function editPermitType(Request $request, $id)
    {
        
        $permit = PermitType::find($id);
        $newPermit = json_decode($request->input('permit'));
        $permit->name = $newPermit->name;
        $permit->type = $newPermit->type;
        $permit->departament_id = $newPermit->departament_id;
        $permit->status = $newPermit->status;
        $permit->save();

        // return $permit;

        $requeriments = $request->only('requeriments');
        $requeriments = json_decode($requeriments['requeriments']);

        $requerimentsIds = array_map(function ($requeriment) {
            return $requeriment->id;
        }, $requeriments );


        $permit->requeriments()->sync($requerimentsIds);
        return response('Permiso Actualizado', 200);
    }

    public function deletePermitType($id)
    {
        PermitType::destroy($id);
        return response('Permiso Eliminado', 200);
    }

}

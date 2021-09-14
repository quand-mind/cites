<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

use App\Imports\PermitTypeImport;
use App\Models\PermitType;

class IntoPermitDbController extends Controller
{
    public function readFileXlsx(Request $request){
        /*$fileXlsx = $request->file('file');
        Excel::import(new PermitTyprImport, $file);
        return json('inportación completad');*/

        $collectionPermits = Excel::toArray(new PermitTypeImport, 'permissions_files\CITES_MINEC_Tramites_vs_requisitos_consolidados_y_detallados.xlsx');
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
            }
            return $permit;
            
            //return $permit[3];
        }
    }
}

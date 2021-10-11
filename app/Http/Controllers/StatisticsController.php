<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FormalitiesExport;
use App\Models\Formalitie;
use App\Models\Permit;

class StatisticsController extends Controller
{
    public function TestExportExcel(){
        $formalitie = Permit::get();
        $array= [];
        foreach ($formalitie as $formalities) {
            return $permit = Permit::where( 'status', '=', $formalities->status)->count();
            //$countStatusPermit = count($permit); 

           //$formalities->status[$permit];
            array_push($array, $permit);
        }
        return $array;
        //return Excel::download(new FormalitiesExport, 'test.xlsx');
    }
}

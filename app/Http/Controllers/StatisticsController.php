<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FormalitiesExport;
use App\Models\Formalitie;
use App\Models\Permit;

class StatisticsController extends Controller
{
    public function TestExportExcel(){
       //$permitStatus = Permit::get();
        $status =["requested", "committed", ];

        $statusCount = [];
        foreach ($status  as $statu) {
            $statusCount[] = Permit::where( 'status', '=', $statu)->count();
            
        }
        return view('species')->with('status',json_encode($status))->with('statusCount',json_encode($statusCount,JSON_NUMERIC_CHECK));
        //return Excel::download(new FormalitiesExport, 'test.xlsx');
    }
}

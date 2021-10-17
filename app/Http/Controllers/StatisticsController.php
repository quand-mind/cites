<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FormalitiesExport;
use GuzzleHttp\Client;
use App\Models\Formalitie;
use App\Models\Permit;
use App\Models\PermitType;
use App\Http\Controllers\ApiController;

class StatisticsController extends Controller
{
    public function TestExportExcel(){
        $permitStatus = Permit::get();
        $prelabels = [];
        foreach ($permitStatus as $permitStatu) {
            $prelabels[]= $permitStatu->status;
        }
        $secondlabels = array_unique($prelabels);
        
        $labels = [];
        $data = [];
        foreach ($secondlabels  as $secondlabel) {
            $labels[]=$secondlabel;
        }
        foreach ($labels as $label) {
            $data[] = Permit::where( 'status', '=', $label)->count();
        }
        //return view('excelTest', compact('labels', 'data'));
        //return view('species')->with('labels',json_encode($labels))->with('data',json_encode($data,JSON_NUMERIC_CHECK));
        return Excel::download(new FormalitiesExport, 'test.xlsx');
    }

    public function chartForcountry(){
        $apiController = new ApiController();
        $countries =  $apiController->json_country();
        $arrayCountries = [];
        foreach ($countries as $countrie) {
            $arrayCountries[] = $countrie->label;
        }
        
        $prelabels=[];
        $data= [];
        foreach ($arrayCountries as $arrayCountry) {
            $verifyCountry = Permit::where('country', '=', $arrayCountry)->get();
            if (count($verifyCountry)) {
                foreach ($verifyCountry as $verifyCountrys) {
                    $prelabels[]= $verifyCountrys->country;
                }
            }
        }
        return $labels = array_unique($prelabels);
        foreach ($labels as $label) {
            $data[] = Permit::where( 'country', '=', $label)->count();
        }
        return view('species')->with('labels',json_encode($labels))->with('data',json_encode($data,JSON_NUMERIC_CHECK));
    }

    public function chartForpermitType(){
        $permitTypes = Permit::join('permit_types', 'permit_types.id', '=', 'permit_type_id')->get();
        $prelabels=[];
        $data= [];
        foreach ($permitTypes as $permitType) {
            $verifypermitType = Permit::join('permit_types', 'permit_types.id', '=', 'permit_type_id')->where('name', '=', $permitType->name)->get();
            if (count($verifypermitType)) {
                $prelabels[]= $permitType->name;
            }

        };
        $labels = array_unique($prelabels);
        foreach ($labels as $label) {
            $data[]= Permit::join('permit_types', 'permit_types.id', '=', 'permit_type_id')->where('name', '=', $label)->count();
        };
        return view('species')->with('labels',json_encode($labels))->with('data',json_encode($data,JSON_NUMERIC_CHECK));
    }
    
}

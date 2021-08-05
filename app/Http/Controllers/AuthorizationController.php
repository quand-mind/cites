<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\species;
use App\Models\permit;
use App\Models\CommercialNurseriesRequirement;

use Illuminate\Support\Facades\DB;

class AuthorizationController extends Controller
{
    public function index()
    {
        return view('permissions.authorizations');
    }

    public function Nurseries(Request $request){

        $file1=$request->file("solicitude_file");
        $nameSolicitudeFile = "solicitude_file_".time().".".$file1->guessExtension();
        $rutaSolicitudeFile = $_SERVER['DOCUMENT_ROOT'].'/permissions_files/'.$nameSolicitudeFile;
        file_put_contents($rutaSolicitudeFile, $file1);

        $file2=$request->file("revenue_stamps_file");
        $nameRevenueStampsFile = "revenue_stamps_file_".time().".".$file2->guessExtension();
        $rutaRevenueStampsFile = $_SERVER['DOCUMENT_ROOT'].'/permissions_files/'.$nameRevenueStampsFile;
        file_put_contents($rutaRevenueStampsFile, $file2);

        $file3=$request->file("proyect_file");
        $nameProyectFile = "proyect_file_".time().".".$file3->guessExtension();
        $rutaProyectFile = $_SERVER['DOCUMENT_ROOT'].'/permissions_files/'.$nameProyectFile;
        file_put_contents($rutaProyectFile, $file3);

        $file4=$request->file("plane_file");
        $namePlaneFile = "plane_file_".time().".".$file4->guessExtension();
        $rutaPlaneFile = $_SERVER['DOCUMENT_ROOT'].'/permissions_files/'.$namePlaneFile;
        file_put_contents($rutaPlaneFile, $file4);

        $file5=$request->file("property_file");
        $namePropertyFile = "property_file_".time().".".$file5->guessExtension();
        $rutaPropertyFile = $_SERVER['DOCUMENT_ROOT'].'/permissions_files/'.$namePropertyFile;
        file_put_contents($rutaPropertyFile, $file5);

        $nurseries = new CommercialNurseriesRequirement;
        $nurseries->solicitude_file_url = $rutaSolicitudeFile;
        $nurseries->is_valid_solicitude = FALSE;
        $nurseries->revenue_stamps_file_url = $rutaRevenueStampsFile;
        $nurseries->is_valid_revenue_stamps = FALSE;
        $nurseries->proyect_file_url = $rutaProyectFile;
        $nurseries->is_valid_proyect = FALSE;
        $nurseries->plane_file_url = $rutaPlaneFile;
        $nurseries->is_valid_plane = FALSE;
        $nurseries->property_file_url = $rutaPropertyFile;
        $nurseries->is_valid_property_file = FALSE;
        $nurseries->client_id = 1;
        $nurseries->save();

        return response()->json(['message' =>'files is saved'], 200);
        
    }

    public function createPermits(Request $request){
        
        $resive = $request->input('species.*.name_scientific');
       
        $consulta = species::select('id')
                            ->where('name_scientific', '=', $resive)->get();
        if(count($consulta) >= 1){

            //si la especie existe se hara se guarda el id en la tabla 
            //return response($consulta);

            /*$permitsData = $request->all();
            
            $permits = new permit($permitsData);
            $permits->official_id = 1;
            $permits->client_id = 1;
            $permits->save();

            $species = $request->only('species');
            $species = json_decode($specie['species']);

            $species = array_map(function($specie){
                        return (array) $specie;
            }, $species);
            $permits->save();
            $permits->species()->createMany($specie);*/

            //return response()->json(['messge'=>'the species already exists']);

        }else{
            // si no existe se guardara la nueva especie 
            $permitsData = $request->only();
            
            $permits = new permit($permitsData);
            $permits->official_id = 1;
            $permits->client_id = 1;

            return $permits;
            /*$permits->save();

            $species = $request->only('species');
            $species = json_decode($specie['species']);

            $species = array_map(function($specie){
                        return (array) $specie;
            }, $species);
            $permits->save();
            $permits->species()->createMany($specie);*/
            
        }
        
            //return response()->json(['message' =>'a new species was added'], 200); 
        }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\permit;
use App\Models\CommercialNurseriesRequirement;

class AuthorizationController extends Controller
{
    public function index()
    {
        return view('permissions.authorizations');
    }

    public function SaveFileZooHatcherie(Request $request){
        
        if($request->hasFile("solicitude_file" && "revenue_stamps_file" && "proyect_file"&& "plane_file" && "property_file" )){
            $file1=$request->file("solicitude_file");
            $nameSolicitudeFile = "solicitude_file_".time().".".$file1->guessExtension();
            $rutaSolicitudeFile = \public_path("permissions_files/".$nameSolicitudeFile);

            $file2=$request->file("revenue_stamps_file");
            $nameRevenueStampsFile = "revenue_stamps_file_".time().".".$file2->guessExtension();
            $rutaRevenueStampsFile = \public_path("permissions_files/".$nameRevenueStampsFile);

            $file3=$request->file("proyect_file");
            $nameProyectFile = "proyect_file_".time().".".$file3->guessExtension();
            $rutaProyectFile = \public_path("permissions_files/".$nameProyectFile);

            $file4=$request->file("plane_file");
            $namePlaneFile = "plane_file_".time().".".$file4->guessExtension();
            $rutaPlaneFile = \public_path("permissions_files/".$namePlaneFile);

            $file5=$request->file("property_file");
            $namePropertyFile = "property_file_".time().".".$file5->guessExtension();
            $rutaPropertyFile = \public_path("permissions_files/".$namePropertyFile);

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
            $nurseries->client_id = FALSE;
            $nurseries->save();
            

        }

        public function createPermits(Request $request){

            if($request->validate(
                [
                    'request_permit_no' => 'required',
                    'means' => 'required',
                    'permit_type' => 'required',
                    'name' => 'required',
                    'address' => 'required',
                    'country' => 'required',
                    'purpose' => 'required',
                    'half_signature' => 'required',
                    'official_position' => 'required',
                ]   
            )){
                
            }

        }
    }
}

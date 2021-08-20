<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Institution;

class InstitutionController extends Controller
{
    public function storeInstitution(Request $request){

        if($request->validate([
            'name' => 'required',
            'institutional_email' => 'required',
        ])){
            try {
                
                $institution = new Institution();
                $institution->name = $request->input('name');
                $institution->institutional_email = $request->input('institutional_email');
                $institution->client_id = auth()->user()->id;
                $institution->save();

                $phones= $request->only('phones');
                $phones = json_decode(json_encode($phones['phones']));
                
                $phones = array_map(function($phone) {
                    return (array) $phone;
                }, $phones);
                $institution->phones()->createMany($phones);
                return "Las institucion se ha agregado correctamente.";
           } catch (\Exception $err) {
                return response(json_encode($err), 500);
            }
       }else {
            return response('Error en validación');
        }
    }
}

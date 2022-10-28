<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requeriment;

class IntoRequerimentDbController extends Controller
{
    public function getRequeriment(){
        return Requeriment::get();
    }

    public function editRequerimen(Request $request, $id){
        $requerimen = Requeriment::find($id);
        $requerimen->name = $request->input('name');
        $requerimen->short_name = $request->input('short_name');
        $requerimen->type = $request->input('type');
        $requerimen->save();
    }
}

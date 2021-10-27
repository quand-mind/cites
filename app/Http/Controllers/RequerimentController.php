<?php

namespace App\Http\Controllers;

use App\Models\Requeriment;
use Illuminate\Http\Request;

class RequerimentController extends Controller
{
    public function index()
    {
        $requeriments = Requeriment::paginate(10);
        return view('panel.dashboard.permissions.requeriments_view', compact('requeriments'));
    }
    public function getRequeriments()
    {
        $requeriments = Requeriment::get();
        return $requeriments;
    }
    public function addRequeriment(Request $request)
    {
        $newRequeriment = json_decode($request->input('requeriment'));
        $requeriment = new Requeriment;
        $requeriment->name = $newRequeriment->name;
        $requeriment->short_name = $newRequeriment->short_name;
        $requeriment->type = $newRequeriment->type;
        $requeriment->save();
        return response('Nuevo Recaduo Guardado', 200);
    }
    public function editRequeriment(Request $request, $id)
    {
        $newRequeriment = json_decode($request->input('requeriment'));
        $requeriment = Requeriment::find($id);
        $requeriment->name = $newRequeriment->name;
        $requeriment->short_name = $newRequeriment->short_name;
        $requeriment->type = $newRequeriment->type;
        $requeriment->save();
        return response('Recaduo Actualizado', 200);
    }
    public function deleteRequeriment($id)
    {
        Requeriment::destroy($id);
        return response('Recaduo Eliminado', 200);
    }
}

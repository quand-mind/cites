<?php

namespace App\Http\Controllers;

use App\Models\Glosary;
use Exception;
use Illuminate\Http\Request;

class GlosaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $glosaries = Glosary::all();
        return view('panel.dashboard.glosary', compact('glosaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->validate([
            'word' => 'required|max:100',
            'description' => 'required|max:800'
        ])) {
            $glosary = new Glosary($request->all());
            $glosary->save();

            return response('Palabra guardada exitosamente', 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->validate([
            'word' => 'required|max:100',
            'description' => 'required|max:800'
        ])) {
            $glosary = Glosary::find($id);
            $glosary->update($request->all());

            return response('Palabra guardada exitosamente', 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Glosary::find($id)->delete();
            return response('Palabra eliminada exitosamente', 200);
        } catch (Exception $err) {
            return response($err->getMessage(), 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Acronimo;
use Exception;
use Illuminate\Http\Request;

class AcronimoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acronimos= Acronimo::all();
        return view('panel.dashboard.acronimo', compact('acronimos'));        
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
            'siglas' => 'required|max:10',
            'description' => 'required|max:100'
        ])) {
            $acronimo = new Acronimo($request->all());
            $acronimo->save();

            return response('Acrónimo guardado exitosamente', 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'siglas' => 'required|max:10',
            'description' => 'required|max:100'
        ])) {
            $acronimo = Acronimo::find($id);
            $acronimo->update($request->all());

            return response('Acrónimo guardado exitosamente', 200);
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
            Acronimo::find($id)->delete();
            return response('Acrónimo eliminado exitosamente', 200);
        } catch (Exception $err) {
            return response($err->getMessage(), 500);
        }
    }
}

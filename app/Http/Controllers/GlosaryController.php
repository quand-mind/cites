<?php

namespace App\Http\Controllers;

use App\Glosary;
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
            'word' => 'required|max:10',
            'description' => 'required|max:100'
        ])) {
            $acronimo = new Glosary($request->all());
            $acronimo->save();

            return response('Palabra guardada exitosamente', 200);
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
            $acronimo = Glosary::find($id);
            $acronimo->update($request->all());

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

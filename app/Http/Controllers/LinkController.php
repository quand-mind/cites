<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Exception;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::all();
        return view('panel.dashboard.links', compact('links'));
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
            'name' => 'required|unique:links',
            'url' => 'required|url',
            'photo' => 'required|file|mime:svg,png'

        ])) {

            try {
                $link = new Link($request->except('photo'));
                $order = Link::all()->count();
                $link->order = $order;
    
                // Save photo
                $photoPath = $request->file('photo')->store('images/links');
                $photoPath = '/storage/' . $photoPath;
    
                $link->photo = $photoPath;
                $link->save();

                return response('Link guardado exitosamente', 200);
            } catch (\Exception $err) {
                return response($err->json(), 500);
            }
        }

        return response('Datos inválidos', 400);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

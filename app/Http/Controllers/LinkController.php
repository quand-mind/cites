<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Exception;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource using blade view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::all();
        return view('panel.dashboard.social-links', compact('links'));
    }

    /**
     * Get a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLinks()
    {
        $links = Link::all();

        return response($links->toJson(), 200);
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
            'photo' => 'required|file|mimes:svg,png'

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
                return response($err, 500);
            }
        }

        return response('Datos inválidos', 400);
    }

    /**
     * Change the visible state of link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleIsVisible(Request $request, $id)
    {
        $link = Link::find($id);
        $link->isVisible =  !$link->isVisible;

        $link->save();

        return response('Se actualizó la visibilidad del link');
    }

    /**
     * Get all visible links
     *
     * @return void
     */
    static function getVisibleLinks() {
        $socialLinks = Link::where('isVisible', 1)->get();
        return $socialLinks;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Link::destroy($id);
        return response('Link eliminado');
    }
}

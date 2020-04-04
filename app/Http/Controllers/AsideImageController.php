<?php

namespace App\Http\Controllers;

use App\AsideImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AsideImageController extends Controller
{
    /**
     * Display a listing of the resource in the admin panel.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = AsideImage::orderBy('image_order')->get();
        return view('panel.dashboard.asideManager', compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // IMPORTANT: check image size

        if ($request->validate([
            'image' => 'required|image|max:2048'
        ])) {

            try {

                $image = new AsideImage([
                    'src' => $request->file('image')->store('images'),
                    'image_order' => AsideImage::count('*'),
                    'name' => $request->input('name'),
                    'url' => $request->input('url')
                ]);
                
                $image->save();
    
                return response('Imagen guardada exitosamente', 200);
            } catch (Exception $err) {
                return response($err->getMessage(), 500);
            }
        }
    }

    /**
     * Display the header-images resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return AsideImage::orderBy('image_order')->get()->toJson();
    }

    /**
     * Update one aside image resource in db.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOne($id, Request $request)
    {
        
    }

    /**
     * Update the all header images resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {
        try {
            foreach ($request->input('images') as $image) {

                AsideImage::where('id', $image['id'])
                            ->update($image);
            }
            return response('Panel lateral actualizado exitosamente', 200);
        } catch (Exception $err) {
            return response($err->getMessage(), 500);
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
            $image = AsideImage::find($id);
            Storage::delete($image->src);
            $image->delete();
            return response('Imagen eliminada');
        } catch (Exception $err) {
            return response($err->getMessage(), 500);
        }
    }
}

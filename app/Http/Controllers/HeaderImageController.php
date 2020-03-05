<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HeaderImage;
use Exception;
use Illuminate\Support\Facades\Storage;

class HeaderImageController extends Controller
{
    /**
     * Display a listing of the resource in the admin panel.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = HeaderImage::orderBy('image_order')->get();
        return view('panel.dashboard.headerManager', compact('images'));
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
            'images.*' => 'required|image|max:4096'
        ])) {

            try {
                foreach ($request->file('images') as $file) {

                    $image = new HeaderImage([
                        'src' => $file->store('images'),
                        'image_order' => HeaderImage::count('*')
                    ]);
                    
                    $image->save();
                }
    
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
        return HeaderImage::orderBy('image_order')->get()->toJson();
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
     * Update the all header images resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
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
            $image = HeaderImage::find($id);
            Storage::delete($image->src);
            $image->delete();
            return response('Imagen eliminada');
        } catch (Exception $err) {
            return response($err->getMessage(), 500);
        }
    }
}

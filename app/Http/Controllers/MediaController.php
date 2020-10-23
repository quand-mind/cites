<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medias = Media::all();
        return response($medias, 200);
    }

    /**
     * Store a newly created resource in storage.
     * Only accepts video. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->validate([
            'name' => 'required|unique:medias|max:255',
            'file' => 'required|file|mimetypes:video/mpeg,video/ogg,video/webm|max:6144',
        ])) {
            try {
                $path = $request->file('file')->store('media');
                $path = '/storage/' . $path;
                
                $media = new Media(['name' => $request->name, 'path' => $path]);
                $media->save();
                
                return response('Archivo multimedia guardado exitosamente.', 200);
            } catch (\Exception $err) {
                return response()->json([
                    'msg' => 'No se pudo subir el archivo.',
                    'error' => $err
                ]);
            }
        }

        return response('Formato inválido del archivo.', 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Media::find($id);
        // handle post content picture
        Storage::delete(str_replace("/storage/", "", $media->path));
        $media->delete();
    }
}

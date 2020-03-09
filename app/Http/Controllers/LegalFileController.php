<?php

namespace App\Http\Controllers;

use App\LegalFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Response;

class LegalFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laws = LegalFile::all();

        return view('panel.dashboard.laws', compact('laws'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->validate(
            [
                'name' => 'required|string',
                'description' => 'required|string',
                'type' => 'required|in:nac,int',
                'file' => 'required|mimetypes:application/pdf'
            ]
        )) {
            // Save the file
            $file = new LegalFile($request->except(['file']));

            // save file in the storage
            $file->setFilePath();
            $file->file_order = LegalFile::where('type', $file->type)->count();
            $file->save();
            $request->file('file')->storeAs('files', $file->name);

            return response('Archivo guardado exitosamente', 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $fileData = LegalFile::where('name', $name)->first();
        $filePath = storage_path('app/public/files/'. $fileData->name);

        return Response::make(file_get_contents($filePath), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileData->name.'"'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->validate(
            [
                'description' => 'required|string',
                'type' => 'required|in:nac,int'
            ]
        )) {
            // Save the file
            LegalFile::where('id', $id)->update($request->all());

            // save file in the storage
            return response('Archivo actualizado', 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // handle post content picture
            $file = LegalFile::find($id);
            $file->delete();
            Storage::delete(str_replace("/storage/", "", $file->path));

            return response('Archivo eliminado', 200);
        } catch (Exception $err) {
            return response($err->getMessage, 500);
        }
    }
}

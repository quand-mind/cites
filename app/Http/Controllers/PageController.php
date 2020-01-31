<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pages = Page::with(['createdBy', 'lastModifiedBy'])->select(
            'id',
            'title',
            'slug',
            'meta_description',
            'created_by',
            'lastModified_by',
            'created_at'
        )->get();
        return view('panel.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.pages.form');
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
            'title' => 'required|unique:pages|string',
            'meta_description' => 'required|string|min:120|max:158',
            'meta_robots' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'content' => 'required|string'
        ])) {
            $values = $request->all();

            // Save Page object
            try {
                $page = new Page($values);
                $page->createdBy()->associate(Auth::user());
                $page->lastModifiedBy()->associate(Auth::user());
                $page->save();

                return response([
                    "msg" => "Página guardada exitosamente",
                    "page_id" => $page->id
                ], 200);
            } catch (Exception $err) {
                return response($err->getMessage, 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->first();
        $pages = Page::all();

        return $page !== null ? 'Found page' : response()->view('errors.' . '404', [], 404);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        return view('panel.pages.form', compact('page'));
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
            'title' => 'required|string',
            'meta_description' => 'required|string|min:120|max:158',
            'meta_robots' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'content' => 'required|string'
        ])) {
            $values = $request->all();

            // Save Page object
            try {
               $page = Page::find($id);
               $page->update($values);
               $page->lastModifiedBy()->associate(Auth::user());
               $page->save();

                return response([
                    "msg" => "Página guardada exitosamente",
                    "page_id" =>$page->id
                ], 200);
            } catch (Exception $err) {
                return response($err->getMessage, 500);
            }
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
            $page = Page::find($id);
            $page->delete();
            return response('Página eliminada', 200);
        } catch (Exception $err) {
            return response($err->getMessage(), 500);
        }
    }
}

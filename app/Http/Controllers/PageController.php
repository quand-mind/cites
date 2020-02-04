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
        $pages = Page::with(['createdBy', 'lastModifiedBy', 'getMainPage'])->select(
            'id',
            'title',
            'slug',
            'meta_description',
            'created_by',
            'is_subpage',
            'lastModified_by',
            'main_page',
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
        $mainPages = Page::where('is_subpage', false)->get();
        return view('panel.pages.form', compact('mainPages'));
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
            'content' => 'required|string',
            'is_subpage' => 'required|boolean',
            'main_page' => 'nullable|integer'
        ])) {
            $values = $request->except(['main_page']);

            // Save Page object
            try {
                $page = new Page($values);
                $page->is_subpage = $values['is_subpage'];
                $page->createdBy()->associate(Auth::user());
                $page->lastModifiedBy()->associate(Auth::user());
                $mainPageId = $request->input('main_page');
                
                if ($mainPageId !== null)
                    $page->getMainPage()->associate(Page::find($mainPageId));

                $page->save();

                return response("Página guardada exitosamente", 200);
            } catch (Exception $err) {
                return response($err->getMessage, 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->first();

        return $page !== null ? view('frontend.template', compact('page')) : response()->view('errors.' . '404', [], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @param  string  $subpage
     * @return \Illuminate\Http\Response
     */
    public function showSubPage($slug, $subpage)
    {
        $page = Page::where('slug', $subpage)->first();

        if ($page->getMainPage->slug === $slug) {
            return view('frontend.template', compact('page'));
        }

        return response()->view('errors.' . '404', [], 404);
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
        $mainPages = Page::where('is_subpage', false)->get();
        return view('panel.pages.form', compact('page', 'mainPages'));
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
            'content' => 'required|string',
            'is_subpage' => 'required|boolean',
            'main_page' => 'nullable|integer'
        ])) {
            $values = $request->except(['main_page']);

            // Save Page object
            try {
               $page = Page::find($id);
               $page->is_subpage = $values['is_subpage'];
               $page->update($values);
               $page->lastModifiedBy()->associate(Auth::user());

               $mainPageId = $request->input('main_page');
                
                if ($mainPageId !== null)
                    $page->getMainPage()->associate(Page::find($mainPageId));

               $page->save();

                return response("Página guardada exitosamente", 200);
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

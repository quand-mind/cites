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
            'is_active',
            'lastModified_by',
            'main_page'
        )->get();

        return view('panel.pages.index', compact('pages'));
    }

    public function getMenuLinks () {
        $links = Page::with(['getSubpages'])
            ->select(
                'id',
                'slug',
                'title',
                'is_onMenu',
                'menu_order'
            )
            ->where([
                ['is_subpage', false],
                ['is_active', true],
                ['is_onMenu', true]
            ])
            ->orderBy('menu_order')
            ->get();

        return $links;
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
            'is_active' => 'required|boolean',
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

                return response($mainPageId, 200);
                
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
    public function show($slug = '')
    {
        $page = Page::where('slug', $slug)->first();
        $links = $this->getMenuLinks();

        return $page !== null && $page->is_active ? view('frontend.template', compact('page', 'links')) : response()->view('errors.' . '404', [], 404);
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
        $links = $this->getMenuLinks();

        if ($page->getMainPage->slug === $slug) {
            return view('frontend.template', compact('page', 'links'));
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
        $page = Page::select(
            'id',
            'meta_description',
            'is_active',
            'is_subpage',
            'main_page',
            'title',
            'meta_robots',
            'meta_keywords',
            'content'
        )->where('id', $id)->first();

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
            'is_active' => 'required|boolean',
            'main_page' => 'nullable'
        ])) {
            $values = $request->except(['main_page']);

            // Save Page object
            try {
                $page = Page::find($id);

                // main_pages cannot change between subpages easily
                // WARNING: orphan subpages if main_page is changed to subpage
                if ($values['is_subpage'] && $page->getSubpages->isNotEmpty()) {
                    $page->getSubpages()->each(function ($page, $key) {
                        $page->getMainPage()->dissociate();
                        $page->is_subpage = false;
                        $page->save();
                    });
                }

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

    public function changeActiveState(Request $request, $id)
    {
        if ($request->validate([
            'is_active' => 'boolean'
        ])) {
            try {
                $post = Page::find($id);
                $post->is_active = $request->input('is_active');
                $post->save();
                return response('Página actualizada', 200);
            } catch (Exception $err) {
                return response($err->getMessage(), 500);
            }
        }
    }
}

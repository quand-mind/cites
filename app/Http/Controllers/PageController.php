<?php

namespace App\Http\Controllers;

use App\Models\Acronimo;
use App\Models\Glosary;
use App\Models\LegalFile;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LinkController;

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
            'is_mainPage',
            'main_page'
        )->get();

        return view('panel.pages.index', compact('pages'));
    }

    /**
     * Return the list of main links
     *
     * @return Collection
     */
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
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainPages = Page::where('is_subpage', false)->get();
        return view('panel.pages.form', compact('mainPages'));
    }

    /**
     * Store a newly created page in storage.
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
            'is_onMenu' => 'required|boolean',
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

                // It is a subpage                
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
        if ($slug == '') {
            $page = Page::where('is_mainPage', true)->first();
        } else {
            $page = Page::where('slug', $slug)->first();
        }

        $links = $this->getMenuLinks();
        $socialLinks = LinkController::getVisibleLinks();

        return $page !== null && $page->is_active ? view('frontend.template', compact('page', 'links', 'socialLinks')) : response()->view('errors.' . '404', compact('links', 'socialLinks'), 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @param  string  $subpage
     * @return \Illuminate\Http\Response
     */
    public function showSubPage($slug, $subpage = '')
    {
        $page = Page::where('slug', $subpage)->first();
        $links = $this->getMenuLinks();
        $socialLinks = LinkController::getVisibleLinks();

        if ($subpage == 'glosario') {
            return $this->glosaryView();
        } else if ($subpage == 'acronimos') {
            return $this->acronimosView();
        } else if ($page !== null && $page->getMainPage->slug === $slug) {
            return view('frontend.template', compact('page', 'links', 'socialLinks'));
        }

        return response()->view('errors.' . '404', compact('links', 'socialLinks'), 404);
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
            'is_onMenu',
            'is_subpage',
            'is_static',
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

    public function showSurvey ($id) {
        $survey = Survey::find($id);
        $links = $this->getMenuLinks();
        $page = Page::where('slug', 'encuestas')->first();
        $socialLinks = LinkController::getVisibleLinks();

        if ($survey == null) {
            return response()->view('errors.' . '404', compact('links', 'socialLinks'), 404);
        } else {
            return view('frontend.survey', compact('survey', 'links', 'page', 'socialLinks'));
        }
    }

    /**
     * Toggle status of page on the menu
     * 
     * Set if the page is active or not
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function toggleIsOnMenu(Request $request, $id) {
        if ($request->validate([
            'is_onMenu' => 'required|boolean'
        ])) {
            try {
                $page = Page::find($id);
                $page->is_onMenu = $request->input('is_onMenu');
                $page->save();

                $pages = Page::with(['getSubpages'])
                ->select(
                    'id',
                    'slug',
                    'title',
                    'menu_order',
                    'is_onMenu',
                    'is_subpage'
                )
                ->where([
                    ['is_subpage', false],
                    ['is_active', true],
                ])->orderBy('menu_order')
                ->get();

                return response([
                    'msg' =>'Página actualizada',
                    'pages' => $pages
                ], 200);
            } catch (Exception $err) {
                return response($err->getMessage(), 500);
            }
        }
    }

    /**
     * Toggle status of page on the menu
     * 
     * Set if the page is active or not
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
            'is_onMenu' => 'required|boolean',
            'main_page' => 'nullable'
        ])) {
            $values = $request->except(['main_page']);

            // Save Page object
            try {
                $page = Page::find($id);

                // main_pages cannot change between subpages easily
                // WARNING: orphan subpages if main_page is changed to subpage
                if ($values['is_subpage'] && $page->getSubpages->isNotEmpty()) {
                    $page->getSubpages()->each(function ($subpage, $key) {
                        $subpage->getMainPage()->dissociate();
                        $subpage->is_subpage = false;
                        $subpage->save();
                    });
                }

                $page->is_subpage = $values['is_subpage'];
                $page->update($values);

                $page->lastModifiedBy()->associate(Auth::user());

                $mainPageId = $request->input('main_page');
                
                if ($mainPageId !== null && $page->is_subpage)
                    $page->getMainPage()->associate(Page::find($mainPageId));
                else if ($mainPageId !== null && !$page->is_subpage)
                    $page->getMainPage()->dissociate();

                $page->save();

                return response("Página guardada exitosamente", 200);
            } catch (Exception $err) {
                return response($err->getMessage, 500);
            }
        }
    }

    /**
     * Remove the specified page from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $page = Page::find($id);
            if ($page->is_static) {
                return response("No se puede eliminar una página estática. Puedes deshabilitar esta página accediendo a la interfaz de edición", 500);
            }

            $page->delete();
            return response('Página eliminada', 200);
        } catch (Exception $err) {
            return response($err->getMessage(), 500);
        }
    }

    /**
     * Toggle status of page on the menu
     * 
     * Set if the page is active or not
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the faqs on the frontend
     *
     * @return \Illuminate\Http\Response
     */

     public function faqsView () {
        $page = Page::where('slug', 'preguntas-frecuentes')->first();
        $questions = Question::where(['is_faq' => true])->get();
        $socialLinks = LinkController::getVisibleLinks();
        $links = $this->getMenuLinks();

        return view('frontend.faqs', compact('page', 'questions', 'links', 'socialLinks'));
     }

     /**
     * Show the surveys on the frontend
     *
     * @return \Illuminate\Http\Response
     */

    public function encuestasView () {
        $page = Page::where('slug', 'encuestas')->first();
        $surveys = Survey::all();
        $links = $this->getMenuLinks();
        $socialLinks = LinkController::getVisibleLinks();

        return view('frontend.surveys', compact('page', 'surveys', 'links', 'socialLinks'));
     }

     /**
     * Show the newQuestion on the frontend
     *
     * @return \Illuminate\Http\Response
     */

    public function newQuestionView ($slug) {
        $page = Page::where('slug', $slug)->first();
        $socialLinks = LinkController::getVisibleLinks();
        $links = $this->getMenuLinks();

        if ($page != null && $page->id === 20) {
    
            return view('frontend.newQuestion', compact('page', 'links', 'socialLinks'));
        } else {
            $this->showSubPage($slug);
        }

        return response()->view('errors.' . '404', compact('links', 'socialLinks'), 404);

    }

    /**
     * Show the laws on the frontend
     *
     * @return \Illuminate\Http\Response
     */

    public function laws () {
        
        $title = 'legislacion-nacional';
        
        $page = Page::where('slug', $title)->first();
        $links = $this->getMenuLinks();
        $socialLinks = LinkController::getVisibleLinks();
        $filesData = LegalFile::where('type', 'nac')->get();

        return view('frontend.legal', compact('page', 'links', 'filesData', 'socialLinks'));
    }

    /**
     * Show the glosary on the frontend
     *
     * @return \Illuminate\Http\Response
     */

    public function glosaryView () {
        
        $page = Page::where('slug', 'glosario')->first();
        $glosary = Glosary::all();
        $links = $this->getMenuLinks();
        $socialLinks = LinkController::getVisibleLinks();

        return view('frontend.glosary', compact('page', 'links', 'glosary', 'socialLinks'));
    }

    /**
     * Show the acronimos on the frontend
     *
     * @return \Illuminate\Http\Response
     */

    public function acronimosView () {
        
        $page = Page::where('slug', 'acronimos')->first();
        $acronimos = Acronimo::all();
        $socialLinks = LinkController::getVisibleLinks();
        $links = $this->getMenuLinks();

        return view('frontend.acronimos', compact('page', 'links', 'acronimos', 'socialLinks'));
    }

    /**
     * Change the default homepage
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function setAsMainPage ($id) {

        try {
            $actualMainPage = Page::where('is_mainPage', true)->first();
            $actualMainPage->is_mainPage =  false;
            $actualMainPage->save();
    
            $newMainPage = Page::find($id);
            $newMainPage->is_mainPage = true;
            $newMainPage->save();
    
            return response('¡Se ha configurado la página de inicio exitosamente!', 200);
        } catch (\Exception $err) {
            return response($err->toJson(), 500);
        }
    }
}
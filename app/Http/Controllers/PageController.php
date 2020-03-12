<?php

namespace App\Http\Controllers;

use App\Acronimo;
use App\Glosary;
use App\LegalFile;
use Illuminate\Http\Request;
use App\Page;
use App\Question;
use App\Survey;
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
            'title' => 'nullable|unique:pages|string',
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

        return $page !== null && $page->is_active ? view('frontend.template', compact('page', 'links')) : response()->view('errors.' . '404', compact('links'), 404);
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

        if ($page !== null && $page->getMainPage->slug === $slug) {
            return view('frontend.template', compact('page', 'links'));
        }

        return response()->view('errors.' . '404', compact('links'), 404);
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

        if ($survey == null) {
            return response()->view('errors.' . '404', compact('links'), 404);
        } else {
            return view('frontend.survey', compact('survey', 'links', 'page'));
        }
    }
    


    public function update(Request $request, $id)
    {
        if ($request->validate([
            'title' => 'nullable|string',
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

                if (strcmp($page->title, "Bienvenidos") == 0) $page->slug = "";

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
            if ($page->is_static) {
                return response("No se puede eliminar una página estática. Puedes deshabilitar esta página accediendo a la interfaz de edición", 500);
            }

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

    /**
     * Show the faqs on the frontend
     *
     * @return \Illuminate\Http\Response
     */

     public function faqsView () {
        $page = Page::where('slug', 'preguntas-frecuentes')->first();
        $questions = Question::where(['is_faq' => true])->get();
        $links = $this->getMenuLinks();

        return view('frontend.faqs', compact('page', 'questions', 'links'));
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

        return view('frontend.surveys', compact('page', 'surveys', 'links'));
     }

     /**
     * Show the newQuestion on the frontend
     *
     * @return \Illuminate\Http\Response
     */

    public function newQuestionView ($slug) {
        $page = Page::where('slug', $slug)->first();

        if ($page->id === 20) {
            $links = $this->getMenuLinks();
    
            return view('frontend.newQuestion', compact('page', 'links'));
        } else {
            $this->showSubPage($slug);
        }

     }

    /**
     * Show the laws on the frontend
     *
     * @return \Illuminate\Http\Response
     */

    public function laws ($title) {
        
        $page = Page::where('slug', $title)->first();
        $links = $this->getMenuLinks();

        if ($title === 'legislacion-internacional') {
            
            $filesData = LegalFile::where('type', 'int')->get();
        } else if ($title === 'legislacion-nacional') {

            $filesData = LegalFile::where('type', 'nac')->get();
        } else {

            return view('errors.404', compact('links'));
        }

        return view('frontend.legal', compact('page', 'links', 'filesData'));
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

        return view('frontend.glosary', compact('page', 'links', 'glosary'));
    }

    /**
     * Show the acronimos on the frontend
     *
     * @return \Illuminate\Http\Response
     */

    public function acronimosView () {
        
        $page = Page::where('slug', 'acronimos')->first();
        $acronimos = Acronimo::all();
        $links = $this->getMenuLinks();

        return view('frontend.acronimos', compact('page', 'links', 'acronimos'));
    }
}

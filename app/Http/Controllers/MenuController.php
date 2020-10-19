<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class MenuController extends Controller
{
    /**
     * Return the page's links.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        return view('panel.dashboard.menu', compact('pages'));
    }

    /**
     * Return the menu links availables.
     *
     * @return \Illuminate\Http\Response
     */
    public function renderFrontPage ()
    {
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
                ['is_onMenu', false],
                ['is_active', true]
            ])
            ->orderBy('menu_order')
            ->get();

        return view('welcome', compact('links'));
    }

    /**
     * Change the menu links order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrder (Request $request) {
        $pages = $request->all();

        foreach($pages as $page) {
            Page::find($page["id"])->update($page);
            
            if (count($page["get_subpages"]) > 0) {
                foreach ($page["get_subpages"] as $subpage) {
                    Page::find($subpage["id"])->update($subpage);
                }
            }
        };

        return response('Menú actualizado', 200);
    }
}

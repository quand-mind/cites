<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
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
            'is_onMenu',
            'menu_order'
        )
        ->where('is_subpage', false)
        ->get();

        return view('panel.dashboard.menu', compact('pages'));
    }

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
                ['is_onMenu', false]
            ])
            ->orderBy('menu_order')
            ->get();

        return view('welcome', compact('links'));
    }
}

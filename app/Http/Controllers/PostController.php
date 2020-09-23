<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::with(['author', 'image'])->select(
            'id',
            'publish_date',
            'title',
            'slug',
            'meta_description',
            'author_id',
            'is_active'
        )->get();
        return view('panel.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.posts.form');
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
            'title' => 'required|unique:posts|string',
            'meta_description' => 'required|string|min:120|max:158',
            'meta_robots' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'is_active' => 'required|boolean',
            'content' => 'required|string'
        ])) {
            $values = $request->all();

            // Save Post object
            try {
                $post = new Post($values);
                $post->author()->associate(Auth::user());
                $post->save();

                return response([
                    "msg" => "Post guardado exitosamente",
                    "post_id" => $post->id
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
    public function show($id)
    {
        // Post preview (?)
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with(['image', 'author'])->find($id);

        // Not allow another user different to the author can edit the document
        if (Auth::id() == $post->author->id) {

            return view('panel.posts.form', compact('post'));
        }

        return redirect()->route('posts');
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
            'is_active' => 'required|boolean',
            'content' => 'required|string'
        ])) {
            $values = $request->all();

            // Save Post object
            try {
                $post = Post::find($id);
                $post->update($values);
                $post->author()->associate(Auth::user());
                $post->save();

                return response([
                    "msg" => "Post guardado exitosamente",
                    "post_id" => $post->id
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
            $post = Post::find($id);
            Storage::delete($post->image->url);
            $post->delete();
            return response('Post eliminado', 200);
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
                $post = Post::find($id);
                $post->is_active = $request->input('is_active');
                $post->save();
                return response('Post actualizado', 200);
            } catch (Exception $err) {
                return response($err->getMessage(), 500);
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{   
    /**
     * Save image from post created using vue-editor on admin panel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savePostContentImage(Request $request)
    {
        if ($request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ])) {
            // handle post content picture
            $path = $request->file('image')->store('images/posts');
            $path = '/storage/' . $path;

            return response(['url' => $path], 200);
        }
    }

    /**
     * Delete image from post created using vue-editor on admin panel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deletePostContentImage(Request $request)
    {
        if ($request->validate([
            'path' => 'required|string'
        ])) {
            try {
                // handle post content picture
                Storage::delete(str_replace("/storage/", "", $request->input('path')));

                return response('Deleted image', 200);
            } catch (Exception $err) {
                return response($err->getMessage, 500);
            }
        }
    }

    /**
     * Save image from page created using vue-editor on admin panel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savePageContentImage(Request $request)
    {
        if ($request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ])) {
            // handle post content picture
            $path = $request->file('image')->store('images/pages');
            $path = '/storage/' . $path;

            return response(['url' => $path], 200);
        }
    }

    /**
     * Delete image from page created using vue-editor on admin panel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deletePageContentImage(Request $request)
    {
        if ($request->validate([
            'path' => 'required|string'
        ])) {
            try {
                // handle post content picture
                Storage::delete(str_replace("/storage/", "", $request->input('path')));

                return response('Deleted image', 200);
            } catch (Exception $err) {
                return response($err->getMessage, 500);
            }
        }
    }

    /**
     * Save main image of post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savePostMainImage(Request $request)
    {
        if ($request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'author' => 'required|string',
            'alt_img' => 'required|string',
            'publish_date' => 'required|date',
            'post_id' => 'required|numeric'
        ])) {
            // handle post main picture
            $path = $request->file('file')->store('images/posts');
            $path = '/storage/' . $path;

            $values = $request->except(['file']);
            $values['url'] = $path;

            $img = new Image($values);
            $post = Post::find($request->input('post_id'));
            $post->image()->save($img);
            $img->save();

            return response('Post creado exitosamente', 200);
        }
    }

    /**
     * Change or keep the main image of post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function updatePostMainImage(Request $request, $id)
    {
        if ($request->validate([
            'file' => 'nullable|sometimes|image|mimes:jpg,jpeg,png|max:2048',
            'author' => 'required|string',
            'alt_img' => 'required|string',
            'publish_date' => 'required|date',
            'post_id' => 'required|numeric',
            'url' => 'nullable|sometimes|string'
        ])) {

            if ($request->hasFile('file')) {

                // New image
                $path = $request->file('file')->store('images/posts');
                $path = '/storage/' . $path;
                $values = $request->except(['file']);
                $values['url'] = $path;

                // Delete previous image
                Storage::delete($request->url);
            } else {
                // It's the same image
                $values = $request->all();
            }

            try {
                $img = Image::find($id);
                $img->update($values);
                $post = Post::find($request->input('post_id'));
                $post->image()->save($img);
                $img->save();
                return response('Post actualizado exitosamente', 200);
            } catch (Exception $err) {
                return response($err->getMessage(), 500);
            }
        }
    }
}

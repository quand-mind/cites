<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Post;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
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

    public function deletePostContentImage(Request $request)
    {
        if ($request->validate([
            'path' => 'required|string'
        ])) {
            // handle post content picture
            Storage::delete($request->input('path'));

            return response('Deleted image', 200);
        }
    }

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

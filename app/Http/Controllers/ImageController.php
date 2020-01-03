<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Post;

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

    public function savePostMainImage(Request $request)
    {
        if ($request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'author' => 'required|string',
            'alt_img' => 'required|string',
            'date' => 'required|date',
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function savePostMainImage()
    {
    }
}

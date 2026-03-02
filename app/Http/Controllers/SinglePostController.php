<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SinglePostController extends Controller
{
    public function __invoke(Request $request, $slug)
    {
        // Find post by slug
        $post = Post::where('slug', $slug)->firstOrFail();

        // Check if post is published
        if (!$post->is_published || $post->published_at > now()) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }
}

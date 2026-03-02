<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::published()
            ->with('user')
            ->latest('published_at')
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $post->incrementViews();

        return view('blog.show', compact('post'));
    }
}

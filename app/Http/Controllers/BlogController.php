<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page', 1);

        $posts = Cache::remember("blog_index_page_{$page}", 1800, function () {
            return BlogPost::where('is_published', true)
                ->orderBy('published_at', 'desc')
                ->paginate(10);
        });

        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Cache::remember("blog_post_{$slug}", 3600, function () use ($slug) {
            return BlogPost::where('slug', $slug)
                ->where('is_published', true)
                ->firstOrFail();
        });

        // Deduplicate view counting per session
        $viewedKey = 'viewed_blog_' . $post->id;
        if (!session()->has($viewedKey)) {
            $post->incrementViews();
            session()->put($viewedKey, true);
        }

        return view('blog.show', compact('post'));
    }
}


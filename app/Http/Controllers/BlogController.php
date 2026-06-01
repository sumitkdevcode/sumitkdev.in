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
        $search = $request->get('search', '');

        $cacheKey = "blog_index_page_{$page}_search_" . md5($search);

        $posts = Cache::remember($cacheKey, 1800, function () use ($search) {
            $query = BlogPost::where('is_published', true);

            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%");
                });
            }

            return $query->orderBy('published_at', 'desc')->paginate(10);
        });

        // Only return the partial for genuine AJAX pagination requests,
        // NOT for SPA navigation requests
        if ($request->ajax() && !$request->header('X-SPA-Request')) {
            return view('blog.partials.posts', compact('posts'))->render();
        }

        return view('blog.index', compact('posts', 'search'));
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

        // Fetch suggested posts (same category first, then recent)
        $suggestedPosts = Cache::remember("blog_suggestions_{$slug}", 3600, function () use ($post) {
            return BlogPost::where('is_published', true)
                ->where('id', '!=', $post->id)
                ->orderByRaw("CASE WHEN category = ? THEN 0 ELSE 1 END", [$post->category])
                ->orderBy('published_at', 'desc')
                ->take(6)
                ->get();
        });

        return view('blog.show', compact('post', 'suggestedPosts'));
    }
}


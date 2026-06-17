<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialPost;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Storage;

class SocialPostController extends Controller
{
    public function index()
    {
        $posts = SocialPost::orderBy('published_at', 'desc')->paginate(15);
        return view('admin.social_posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.social_posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string',
            'content' => 'nullable|string',
            'media_type' => 'required|string',
            'permalink' => 'nullable|url',
            'media_upload' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'media_url' => 'nullable|string',
            'published_at' => 'required|date',
        ]);

        if ($request->hasFile('media_upload')) {
            $validated['media_url'] = ImageHelper::storeAsWebp($request->file('media_upload'), 'social');
        }

        $validated['is_published'] = $request->has('is_published');
        
        SocialPost::create($validated);

        return redirect()->route('admin.social-posts.index')->with('success', 'Social post created successfully.');
    }

    public function edit(SocialPost $social_post)
    {
        return view('admin.social_posts.edit', compact('social_post'));
    }

    public function update(Request $request, SocialPost $social_post)
    {
        $validated = $request->validate([
            'platform' => 'required|string',
            'content' => 'nullable|string',
            'media_type' => 'required|string',
            'permalink' => 'nullable|url',
            'media_upload' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'media_url' => 'nullable|string',
            'published_at' => 'required|date',
        ]);

        if ($request->hasFile('media_upload')) {
            if ($social_post->media_url && !str_starts_with($social_post->media_url, 'http')) {
                Storage::disk('public')->delete($social_post->media_url);
            }
            $validated['media_url'] = ImageHelper::storeAsWebp($request->file('media_upload'), 'social');
        }

        $validated['is_published'] = $request->has('is_published');
        
        $social_post->update($validated);

        return redirect()->route('admin.social-posts.index')->with('success', 'Social post updated successfully.');
    }

    public function destroy(SocialPost $social_post)
    {
        if ($social_post->media_url && !str_starts_with($social_post->media_url, 'http')) {
            Storage::disk('public')->delete($social_post->media_url);
        }
        $social_post->delete();

        return redirect()->route('admin.social-posts.index')->with('success', 'Social post deleted successfully.');
    }
}

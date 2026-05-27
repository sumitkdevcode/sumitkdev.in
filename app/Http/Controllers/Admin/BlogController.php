<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ImageHelper;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('author')->orderBy('published_at', 'desc')->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'nullable|string',
            'tags' => 'nullable|array',
            'sub_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Handle sub images
        $subImagePaths = [];
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $image) {
                $subImagePaths[] = ImageHelper::storeAsWebp($image, 'blog/sub');
            }
        }
        $validated['sub_images'] = $subImagePaths;

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = ImageHelper::storeAsWebp($request->file('featured_image'), 'blog');
        }

        // Set additional fields
        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($request->title);
        $validated['tags'] = $request->tags ?? [];
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $request->has('is_published') ? now() : null;

        BlogPost::create($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Post created successfully.');
    }

    public function edit(BlogPost $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'nullable|string',
            'tags' => 'nullable|array',
            'sub_images' => 'nullable|array',
            'sub_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('sub_images')) {
            // Delete old sub images
            if ($blog->sub_images) {
                foreach ($blog->sub_images as $oldSubImage) {
                    Storage::disk('public')->delete($oldSubImage);
                }
            }
            $subImagePaths = [];
            foreach ($request->file('sub_images') as $image) {
                $subImagePaths[] = ImageHelper::storeAsWebp($image, 'blog/sub');
            }
            $validated['sub_images'] = $subImagePaths;
        }

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = ImageHelper::storeAsWebp($request->file('featured_image'), 'blog');
        }

        $validated['slug'] = Str::slug($request->title);
        $validated['is_published'] = $request->has('is_published');
        $validated['tags'] = $request->tags ?? [];
        if ($request->has('is_published') && !$blog->published_at) {
            $validated['published_at'] = now();
        }

        $blog->update($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(BlogPost $blog)
    {
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }
        if ($blog->sub_images) {
            foreach ($blog->sub_images as $oldSubImage) {
                Storage::disk('public')->delete($oldSubImage);
            }
        }
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Post deleted successfully.');
    }
}

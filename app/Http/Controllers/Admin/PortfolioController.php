<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PortfolioItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageHelper;

class PortfolioController extends Controller
{
    public function index()
    {
        $items = PortfolioItem::orderBy('order')->paginate(10);
        return view('admin.portfolio.index', compact('items'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'short_description' => 'nullable|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tech_stack' => 'nullable|array',
            'category' => 'nullable|string',
            'github_link' => 'nullable|url',
            'live_link' => 'nullable|url',
            'is_featured' => 'nullable',
            'order' => 'nullable|integer',
            'sub_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Handle sub images
        $subImagePaths = [];
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $image) {
                $subImagePaths[] = ImageHelper::storeAsWebp($image, 'projects/sub');
            }
        }
        $validated['sub_images'] = $subImagePaths;

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = ImageHelper::storeAsWebp($request->file('featured_image'), 'projects');
        }

        // Set additional fields
        $validated['slug'] = Str::slug($request->title);
        $validated['tech_stack'] = $request->tech_stack ?? [];
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_published'] = $request->has('is_published');
        $validated['order'] = $request->order ?? 0;

        PortfolioItem::create($validated);

        return redirect()->route('admin.portfolio.index')->with('success', 'Project created successfully.');
    }

    public function edit(PortfolioItem $portfolio)
    {
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, PortfolioItem $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'short_description' => 'nullable|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tech_stack' => 'nullable|array',
            'category' => 'nullable|string',
            'github_link' => 'nullable|url',
            'live_link' => 'nullable|url',
            'order' => 'nullable|integer',
            'sub_images' => 'nullable|array',
            'sub_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('sub_images')) {
            // Delete old sub images if they exist
            if ($portfolio->sub_images) {
                foreach ($portfolio->sub_images as $oldSubImage) {
                    Storage::disk('public')->delete($oldSubImage);
                }
            }
            $subImagePaths = [];
            foreach ($request->file('sub_images') as $image) {
                $subImagePaths[] = ImageHelper::storeAsWebp($image, 'projects/sub');
            }
            $validated['sub_images'] = $subImagePaths;
        }

        if ($request->hasFile('featured_image')) {
            if ($portfolio->featured_image) {
                Storage::disk('public')->delete($portfolio->featured_image);
            }
            $validated['featured_image'] = ImageHelper::storeAsWebp($request->file('featured_image'), 'projects');
        }

        $validated['slug'] = Str::slug($request->title);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_published'] = $request->has('is_published');
        $validated['tech_stack'] = $request->tech_stack ?? [];
        $validated['order'] = $request->order ?? 0;

        $portfolio->update($validated);

        return redirect()->route('admin.portfolio.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(PortfolioItem $portfolio)
    {
        if ($portfolio->featured_image) {
            Storage::disk('public')->delete($portfolio->featured_image);
        }
        if ($portfolio->sub_images) {
            foreach ($portfolio->sub_images as $oldSubImage) {
                Storage::disk('public')->delete($oldSubImage);
            }
        }
        $portfolio->delete();
        return redirect()->route('admin.portfolio.index')->with('success', 'Project deleted successfully.');
    }
}

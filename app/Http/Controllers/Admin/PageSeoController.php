<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSeo;
use Illuminate\Http\Request;

class PageSeoController extends Controller
{
    public function index()
    {
        // Default pages to ensure they always exist for easy setup
        $defaultPages = [
            ['path' => '/', 'name' => 'Home'],
            ['path' => '/about', 'name' => 'About'],
            ['path' => '/portfolio', 'name' => 'Portfolio'],
            ['path' => '/blog', 'name' => 'Blog'],
            ['path' => '/gallery', 'name' => 'Gallery'],
            ['path' => '/contact', 'name' => 'Contact'],
        ];

        foreach ($defaultPages as $page) {
            PageSeo::firstOrCreate(
                ['page_path' => $page['path']],
                ['page_name' => $page['name']]
            );
        }

        $seos = PageSeo::orderBy('page_name')->paginate(15);
        return view('admin.seo.index', compact('seos'));
    }

    public function create()
    {
        return view('admin.seo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required|string|max:255',
            'page_path' => 'required|string|max:255|unique:page_seos,page_path',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string|max:255',
            'twitter_card' => 'required|string',
            'twitter_handle' => 'nullable|string|max:255',
        ]);

        PageSeo::create($request->all());

        return redirect()->route('admin.seo.index')->with('success', 'New page SEO entry created successfully.');
    }

    public function edit(PageSeo $seo)
    {
        return view('admin.seo.edit', compact('seo'));
    }

    public function update(Request $request, PageSeo $seo)
    {
        $request->validate([
            'page_name' => 'required|string|max:255',
            'page_path' => 'required|string|max:255|unique:page_seos,page_path,' . $seo->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string|max:255',
            'twitter_card' => 'required|string',
            'twitter_handle' => 'nullable|string|max:255',
        ]);

        $seo->update($request->all());

        return redirect()->route('admin.seo.index')->with('success', 'SEO for ' . $seo->page_name . ' updated successfully.');
    }

    public function destroy(PageSeo $seo)
    {
        $seo->delete();
        return redirect()->route('admin.seo.index')->with('success', 'Page SEO entry deleted successfully.');
    }
}

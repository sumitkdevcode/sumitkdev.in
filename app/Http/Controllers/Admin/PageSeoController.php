<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageSeoController extends Controller
{
    public function index()
    {
        // Clean up legacy entries: merge duplicates without leading slash into the /path version
        $this->cleanupDuplicatePaths();

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
        // Normalize path to always have a leading slash
        $request->merge([
            'page_path' => '/' . ltrim($request->input('page_path'), '/'),
        ]);

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
        $this->clearSeoCache();

        return redirect()->route('admin.seo.index')->with('success', 'New page SEO entry created successfully.');
    }

    public function edit(PageSeo $seo)
    {
        return view('admin.seo.edit', compact('seo'));
    }

    public function update(Request $request, PageSeo $seo)
    {
        // Normalize path to always have a leading slash
        $request->merge([
            'page_path' => '/' . ltrim($request->input('page_path'), '/'),
        ]);

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
        $this->clearSeoCache();

        return redirect()->route('admin.seo.index')->with('success', 'SEO for ' . $seo->page_name . ' updated successfully.');
    }

    public function destroy(PageSeo $seo)
    {
        $seo->delete();
        $this->clearSeoCache();
        return redirect()->route('admin.seo.index')->with('success', 'Page SEO entry deleted successfully.');
    }

    /**
     * Clean up duplicate entries where paths exist both with and without leading slash.
     * Keeps the entry with more SEO data filled in, or the one with leading slash if equal.
     */
    private function cleanupDuplicatePaths()
    {
        $allEntries = PageSeo::all();
        $pathsWithSlash = [];
        $pathsWithoutSlash = [];

        foreach ($allEntries as $entry) {
            if (str_starts_with($entry->page_path, '/')) {
                $pathsWithSlash[$entry->page_path] = $entry;
            } else {
                $pathsWithoutSlash[$entry->page_path] = $entry;
            }
        }

        foreach ($pathsWithoutSlash as $path => $legacyEntry) {
            $normalizedPath = '/' . $path;

            if (isset($pathsWithSlash[$normalizedPath])) {
                $canonicalEntry = $pathsWithSlash[$normalizedPath];

                // If the legacy entry has SEO data but the canonical one doesn't, copy it over
                if ($legacyEntry->meta_title && !$canonicalEntry->meta_title) {
                    $canonicalEntry->update([
                        'page_name' => $legacyEntry->page_name,
                        'meta_title' => $legacyEntry->meta_title,
                        'meta_description' => $legacyEntry->meta_description,
                        'meta_keywords' => $legacyEntry->meta_keywords,
                        'og_title' => $legacyEntry->og_title,
                        'og_description' => $legacyEntry->og_description,
                        'og_image' => $legacyEntry->og_image,
                        'twitter_card' => $legacyEntry->twitter_card,
                        'twitter_handle' => $legacyEntry->twitter_handle,
                    ]);
                }

                // Delete the duplicate without leading slash
                $legacyEntry->delete();
            } else {
                // No canonical version exists, just fix the path
                $legacyEntry->update(['page_path' => $normalizedPath]);
            }
        }
    }

    /**
     * Clear all cached SEO data so changes take effect immediately.
     */
    private function clearSeoCache()
    {
        // Clear known page SEO cache keys
        $paths = ['/', '/about', '/portfolio', '/blog', '/gallery', '/contact', '/links', '/open-source', '/feed', '/tools'];
        foreach ($paths as $path) {
            Cache::forget('page_seo_' . md5($path));
        }
    }
}

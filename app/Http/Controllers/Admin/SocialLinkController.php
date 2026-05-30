<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = SocialLink::orderBy('order')->get();
        return view('admin.social_links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.social_links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform_name' => 'required|string|max:255',
            'url' => 'required|string',
            'handle' => 'nullable|string|max:255',
            'icon_svg' => 'nullable|string',
            'category' => 'required|string',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        SocialLink::create($validated);
        Cache::forget('global_social_links');

        return redirect()->route('admin.social-links.index')->with('success', 'Social Link created successfully.');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social_links.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'platform_name' => 'required|string|max:255',
            'url' => 'required|string',
            'handle' => 'nullable|string|max:255',
            'icon_svg' => 'nullable|string',
            'category' => 'required|string',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $socialLink->update($validated);
        Cache::forget('global_social_links');

        return redirect()->route('admin.social-links.index')->with('success', 'Social Link updated successfully.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        Cache::forget('global_social_links');

        return redirect()->route('admin.social-links.index')->with('success', 'Social Link deleted successfully.');
    }
}

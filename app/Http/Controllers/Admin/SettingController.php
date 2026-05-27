<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = $request->except(['_token', 'home_hero_image']);

        // Handle text settings
        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        // Handle image uploads
        if ($request->hasFile('home_hero_image')) {
            $path = \App\Helpers\ImageHelper::storeAsWebp(
                $request->file('home_hero_image'),
                'settings'
            );
            
            Setting::set('home_hero_image', $path, 'image', 'general');
        }

        // Flush cache explicitly just to be safe
        Setting::flushCache();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}

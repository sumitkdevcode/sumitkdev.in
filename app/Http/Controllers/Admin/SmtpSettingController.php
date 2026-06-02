<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SmtpSettingController extends Controller
{
    public function index()
    {
        $settings = SmtpSetting::all();
        return view('admin.smtp_settings.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.smtp_settings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mail_mailer' => 'required|string|max:255',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|integer',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|max:255',
            'mail_from_address' => 'required|email|max:255',
            'mail_from_name' => 'required|string|max:255',
        ]);

        $setting = SmtpSetting::create($validated);
        
        // If it's the first one, make it default automatically
        if (SmtpSetting::count() === 1) {
            $setting->update(['is_default' => true]);
            Cache::forget('default_smtp_setting');
        }

        return redirect()->route('admin.smtp-settings.index')->with('success', 'SMTP Configuration created successfully.');
    }

    public function edit(SmtpSetting $smtpSetting)
    {
        return view('admin.smtp_settings.edit', compact('smtpSetting'));
    }

    public function update(Request $request, SmtpSetting $smtpSetting)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mail_mailer' => 'required|string|max:255',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|integer',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|max:255',
            'mail_from_address' => 'required|email|max:255',
            'mail_from_name' => 'required|string|max:255',
        ]);

        $smtpSetting->update($validated);

        if ($smtpSetting->is_default) {
            Cache::forget('default_smtp_setting');
        }

        return redirect()->route('admin.smtp-settings.index')->with('success', 'SMTP Configuration updated successfully.');
    }

    public function destroy(SmtpSetting $smtpSetting)
    {
        $wasDefault = $smtpSetting->is_default;
        $smtpSetting->delete();

        if ($wasDefault) {
            Cache::forget('default_smtp_setting');
        }

        return redirect()->route('admin.smtp-settings.index')->with('success', 'SMTP Configuration deleted successfully.');
    }

    public function makeDefault($id)
    {
        $setting = SmtpSetting::findOrFail($id);

        SmtpSetting::where('id', '!=', $id)->update(['is_default' => false]);
        $setting->update(['is_default' => true]);

        Cache::forget('default_smtp_setting');

        return redirect()->route('admin.smtp-settings.index')->with('success', 'Default SMTP Configuration updated.');
    }
}

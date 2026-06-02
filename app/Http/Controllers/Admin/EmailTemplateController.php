<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function index()
    {
        $templates = EmailTemplate::paginate(15);
        return view('admin.email_templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.email_templates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'attachments.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,gif|max:10240',
        ]);

        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('email_attachments', 'public');
                $attachments[] = $path;
            }
        }
        
        $validated['attachments'] = $attachments;

        EmailTemplate::create($validated);

        return redirect()->route('admin.email-templates.index')->with('success', 'Email Template created successfully.');
    }

    public function edit(EmailTemplate $emailTemplate)
    {
        return view('admin.email_templates.edit', compact('emailTemplate'));
    }

    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'attachments.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,gif|max:10240',
            'remove_attachments' => 'nullable|array',
        ]);

        $attachments = $emailTemplate->attachments ?? [];

        // Handle removals
        if ($request->has('remove_attachments')) {
            foreach ($request->remove_attachments as $index => $remove) {
                if ($remove == '1' && isset($attachments[$index])) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($attachments[$index]);
                    unset($attachments[$index]);
                }
            }
            $attachments = array_values($attachments); // Re-index array
        }

        // Handle new uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('email_attachments', 'public');
                $attachments[] = $path;
            }
        }

        $validated['attachments'] = $attachments;
        unset($validated['remove_attachments']);

        $emailTemplate->update($validated);

        return redirect()->route('admin.email-templates.index')->with('success', 'Email Template updated successfully.');
    }

    public function destroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();
        return redirect()->route('admin.email-templates.index')->with('success', 'Email Template deleted successfully.');
    }
}

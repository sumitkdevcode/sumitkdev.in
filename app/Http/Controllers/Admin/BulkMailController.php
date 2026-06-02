<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Jobs\SendBulkMailJob;
use Illuminate\Http\Request;

class BulkMailController extends Controller
{
    public function index()
    {
        $templates = EmailTemplate::all();
        return view('admin.bulk_mail.index', compact('templates'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:email_templates,id',
            'emails' => 'required|string',
        ]);

        $template = EmailTemplate::findOrFail($request->template_id);
        
        // Parse emails by newline or comma
        $rawEmails = preg_split('/[\n,]+/', $request->emails);
        $validEmails = [];

        foreach ($rawEmails as $email) {
            $email = trim($email);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validEmails[] = $email;
            }
        }

        if (count($validEmails) === 0) {
            return back()->withErrors(['emails' => 'No valid email addresses were provided.']);
        }

        // Dispatch the job to send emails
        SendBulkMailJob::dispatch($validEmails, $template);

        return redirect()->route('admin.bulk-mail.index')->with('success', 'Bulk mail job dispatched successfully to ' . count($validEmails) . ' recipients.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\AutoReplyMail;
use App\Mail\AdminNotificationMail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|max:255',
            'message' => 'required|min:10',
        ]);

        $contact = ContactMessage::create($validated);

        try {
            // Send notification to Admin (with BCC to secondary email)
            Mail::to('contact@sumitkdev.in')
                ->bcc('kumar.sumit321321@gmail.com')
                ->send(new AdminNotificationMail($validated));

            // Send Auto-reply to User (with BCC to secondary email so you know it was sent)
            Mail::to($validated['email'])
                ->bcc('kumar.sumit321321@gmail.com')
                ->send(new AutoReplyMail($validated));
        } catch (\Exception $e) {
            // Log the error or handle it silently if mail server is not configured
            \Log::error('Mail sending failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Message sent successfully. I will get back to you soon.');
    }
}

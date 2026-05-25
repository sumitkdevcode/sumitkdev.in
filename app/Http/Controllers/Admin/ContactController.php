<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.contacts.index', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->markAsRead();
        return view('admin.contacts.show', compact('message'));
    }

    public function destroy($id)
    {
        ContactMessage::destroy($id);
        return redirect()->route('admin.contacts.index')->with('success', 'Message deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // Check if user is admin (security)
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $messages = ContactMessage::latest()->paginate(10);
        return view('messages.index', compact('messages'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return back()->with('success', 'Message deleted successfully.');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string',
            'message' => 'required|string|min:10',
        ]);
        ContactMessage::create($validated);
        return back()->with('success', 'Thank you! Your message has been sent to our agents.');
    }
}

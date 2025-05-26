<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create($request->all());

        // Hier kun je later email functionaliteit toevoegen
        // Mail::to('admin@gamehub.com')->send(new ContactMessageMail($contactMessage));

        return redirect()->route('contact')->with('success', 'Bedankt voor je bericht! We nemen binnenkort contact op.');
    }
}

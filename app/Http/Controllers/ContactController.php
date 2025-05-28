<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

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

        // Mail versturen
        Mail::raw("Nieuw bericht van {$validated['name']} ({$validated['email']}):\n\n{$validated['message']}", function ($message) {
            $message->to('admin@ehb.be') // Verander dit naar echte admin e-mail
                    ->subject('Nieuw contactformulier bericht');
        
        });

        return redirect()->route('contact')->with('success', 'Bedankt voor je bericht! We nemen binnenkort contact op.');
    }
}

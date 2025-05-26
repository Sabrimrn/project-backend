<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GamerProfileController extends Controller
{
    // Toon publiek profiel (iedereen kan zien)
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('profiles.show', compact('user'));
    }

    // Toon eigen profiel bewerken (alleen voor ingelogde user)
    public function edit()
    {
        $user = Auth::user();
        return view('profiles.edit', compact('user'));
    }

    // Update eigen profiel
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'birthday' => 'nullable|date',
            'about_me' => 'nullable|string|max:500',
            'favorite_game' => 'nullable|string|max:255',
            'gaming_platform' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['username', 'birthday', 'about_me', 'favorite_game', 'gaming_platform']);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::delete('public/profile_photos/' . $user->profile_photo);
            }
            
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/profile_photos', $filename);
            $data['profile_photo'] = $filename;
        }

        $user->update($data);

        return redirect()->route('profile.edit')->with('success', 'Profiel succesvol bijgewerkt!');
    }

    // Lijst van alle gamers (publiek)
    public function index()
    {
        $users = User::whereNotNull('username')
                    ->orderBy('created_at', 'desc')
                    ->paginate(12);
        
        return view('profiles.index', compact('users'));
    }
}

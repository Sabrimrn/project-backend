<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', Rules\Password::defaults()],
            'is_admin' => ['boolean'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->has('is_admin'),
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully!');
    }

    public function toggleAdmin(User $user)
    {
        if ($user->isAdmin()) {
            $user->removeAdmin();
            $message = 'Admin privileges removed from ' . $user->name;
        } else {
            $user->makeAdmin();
            $message = $user->name . ' is now an admin';
        }

        return redirect()->back()->with('success', $message);
    }
}

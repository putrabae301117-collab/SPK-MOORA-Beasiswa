<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.index',compact('users'));
    }

    public function store(Request $request, Periode $periode)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'role' => 'required|string',
            'password' => 'required|string',
        ]);

        User::create($validated);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        if ($user->role === 'admin') {
        abort(403, 'Admin tidak bisa diedit');
        }
        
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $User)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'role' => 'required|string',
            'password' => 'required|string',

        ]);

        $User->update($validated);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        if (session('selected_user_id') == $user->id) {
            session()->forget(['selected_user_id', 'selected_user_name']);
        }

        if ($user->role === 'admin') {
            return redirect()->route('user.index')
                ->with('error','User dengan role admin tidak dapat dihapus!.');
        }

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus');
    }
}

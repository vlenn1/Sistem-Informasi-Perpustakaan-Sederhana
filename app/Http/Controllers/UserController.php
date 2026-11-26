<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $title = 'Daftar Pengguna';
        $users = User::all();

        return view('users.index', compact('title', 'users'));
    }

    public function create() {
        $title = 'Tambah Pengguna';

        return view('users.create', compact('title'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,petugas',
        ]);

        User::create($validated);

        return redirect()->route('users.index')->with('Pengguna berhasil ditambahkan');
    }

    public function edit(User $user){
        $title = 'Edit Pengguna';
        return view('users.edit', compact('title', 'user'));
    }

    public function update(Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,petugas',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user) {
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
}
}

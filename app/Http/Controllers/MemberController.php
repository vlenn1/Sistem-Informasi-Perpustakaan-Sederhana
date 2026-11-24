<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $title = 'Daftar Anggota Perpustakaan';
        $members = Member::latest()->paginate(10);

        return view('members.index', compact('title', 'members'));
    }

    public function create()
    {
        $title = 'Tambah Anggota';

        return view('members.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:members,email'],
            'phone_number' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
        ]);

        Member::create($validated);

        return redirect()->route('members.index')->with('Anggota berhasil ditambahkan.');
    }

    public function show(Member $member)
    {
        $title = 'Detail Anggota';

        return view('members.show', compact('title', 'member'));
    }

    public function edit(Member $member)
    {
        $title = 'Edit Anggota';

        return view('members.edit', compact('title', 'member'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:members,email,' . $member->id],
            'phone_number' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
        ]);

        $member->update($validated);

        return redirect()->route('members.index')->with('Data anggota berhasil diperbarui.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('Anggota berhasil dihapus.');
    }
}

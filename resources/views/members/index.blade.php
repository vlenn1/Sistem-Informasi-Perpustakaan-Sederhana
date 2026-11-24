
@extends('layouts.app')

@section('title', $title)

@section('content')
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <h2>{{ $title }}</h2>

    <a href="{{ route('members.create') }}">Tambah Anggota</a>

    <ol>
        @forelse ($members as $member)
            <li>
                <h3>{{ $member->name }}</h3>

                <p>Email: {{ $member->email }}</p>
                <p>Telepon: {{ $member->phone_number }}</p>
                <p>Alamat: {{ $member->address }}</p>

                <a href="{{ route('members.show', $member->id) }}">Detail Anggota</a>
                <a href="{{ route('members.edit', $member->id) }}">Edit Anggota</a>

                <form action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit">Hapus</button>
                </form>
            </li>
        @empty
            <p>Belum ada data anggota.</p>
        @endforelse
    </ol>

    {{ $members->links() }}
@endsection

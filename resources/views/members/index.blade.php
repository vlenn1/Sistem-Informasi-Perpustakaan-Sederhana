```blade
@extends('layouts.app')

@section('title', $title)

@section('content')
    <h2>{{ $title }}</h2>

    <a href="{{ route('members.create') }}">Tambah Anggota</a>

    <br><br>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No. Telepon</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
</thead>

<tbody>
    @forelse ($members as $member)
        <tr>
            <td>{{ $member->id }}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->phone_number }}</td>
            <td>{{ $member->address }}</td>
            <td>
                <a href="{{ route('members.show', $member->id) }}">Detail</a>
                |
                <a href="{{ route('members.edit', $member->id) }}">Edit</a>
                <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6">Belum ada data anggota.</td>
        </tr>
    @endforelse
</tbody>
    </table>
@endsection
```

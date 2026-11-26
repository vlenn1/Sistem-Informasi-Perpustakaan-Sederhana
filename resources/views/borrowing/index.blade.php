@extends('layouts.app')

@section('title', $title)

@section('content')
    <h2>{{ $title }}</h2>

    <a href="{{ route('borrowing.create') }}">Tambah Peminjaman</a>
    <form action="{{ route('borrowing.index') }}" method="GET">
        <input type="text" name="search" placeholder="Cari ID peminjaman atau nama anggota..." value="{{ request('search') }}">

        <select name="status">
            <option value="">Semua Status</option>
            <option value="borrowed"{{ request('status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
            <option value="returned"{{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
        </select>

        <button type="submit">Cari / Filter</button>
        <a href="{{ route('borrowing.index') }}">Reset</a>
    </form>

    <br>

    <br><br>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>ID_Peminjaman</th>
                <th>Nama Anggota</th>
                <th>Petugas</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($borrowing as $item)
                <tr>
                    <td>{{ $borrowing->firstItem() + $loop->index }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->member->name }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->borrow_date }}</td>
                    <td>{{ $item->due_date }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="{{ route('borrowing.show', $item->id) }}">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada transaksi peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    {{ $borrowing->links() }}
@endsection

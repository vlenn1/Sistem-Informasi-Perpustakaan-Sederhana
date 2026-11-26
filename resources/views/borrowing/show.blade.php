
@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
    <h2>Detail Peminjaman</h2>

    <h3>Informasi Peminjaman</h3>

    <p>Nama Anggota: {{ $borrowing->member->name }}</p>
    <p>Kode Anggota: {{ $borrowing->member->id }}</p>
    <p>Petugas: {{ $borrowing->user->name }}</p>
    <p>Tanggal Peminjaman: {{ $borrowing->borrow_date }}</p>
    <p>Jatuh Tempo: {{ $borrowing->due_date }}</p>
    <p>Tanggal Pengembalian: {{ $borrowing->return_date ?? '-' }}</p>
    <p>Status: {{ $borrowing->status }}</p>

    <h3>Daftar Buku yang Dipinjam</h3>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($borrowing->details as $detail)
                <tr>
                    <td>{{ $detail->book->title }}</td>
                    <td>{{ $detail->book->author }}</td>
                    <td>{{ $detail->quantity }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada detail buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    @if ($borrowing->status == 'borrowed')
        <form action="{{ route('borrowings.return', $borrowing->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <button type="submit">Kembalikan Buku</button>
        </form>
    @else
    <br>
    <p>Buku sudah dikembalikan.</p>
@endif

<br>

    <a href="{{ route('borrowing.index') }}">Kembali</a>
@endsection

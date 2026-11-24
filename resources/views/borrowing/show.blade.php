
@extends('layouts.app')

@section('title', $title)

@section('content')
    <h2>{{ $title }}</h2>

    <h3>Informasi Peminjaman</h3>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Nama Anggota</th>
            <td>{{ $borrowing->member->name }}</td>
        </tr>
        <tr>
            <th>Petugas</th>
            <td>{{ $borrowing->user->name }}</td>
        </tr>
        <tr>
            <th>Tanggal Pinjam</th>
            <td>{{ $borrowing->borrow_date }}</td>
        </tr>
        <tr>
            <th>Tanggal Jatuh Tempo</th>
            <td>{{ $borrowing->due_date }}</td>
        </tr>
        <tr>
            <th>Tanggal Kembali</th>
            <td>{{ $borrowing->return_date ?? '-' }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $borrowing->status }}</td>
        </tr>
    </table>

    <h3>Daftar Buku yang Dipinjam</h3>

    <ol>
        @foreach ($borrowing->details as $detail)
            <li>
                {{ $detail->book->title }} - Jumlah: {{ $detail->quantity }}
            </li>
        @endforeach
    </ol>
    
    @if ($borrowing->status == 'borrowed')
    <form action="{{ route('borrowings.return', $borrowing->id) }}" method="POST">
        @csrf
        <button type="submit">Kembalikan Buku</button>
    </form>
@endif
    <a href="{{ route('borrowings.index') }}">Kembali</a>
@endsection

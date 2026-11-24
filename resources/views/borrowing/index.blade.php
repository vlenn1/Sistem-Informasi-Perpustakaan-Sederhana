
@extends('layouts.app')

@section('title', $title)

@section('content')
    <h2>{{ $title }}</h2>

    <a href="{{ route('borrowing.create') }}">Tambah Peminjaman</a>

    <ol>
        @forelse ($borrowing as $borrowing)
            <li>
                <h3>{{ $borrowing->member->name }}</h3>

                <p>Petugas: {{ $borrowing->user->name }}</p>
                <p>Tanggal Pinjam: {{ $borrowing->borrow_date }}</p>
                <p>Tanggal Jatuh Tempo: {{ $borrowing->due_date }}</p>
                <p>Status: {{ $borrowing->status }}</p>

                <a href="{{ route('borrowing.show', $borrowing->id) }}">Detail Peminjaman</a>
            </li>
        @empty
            <p>Belum ada transaksi peminjaman.</p>
        @endforelse
    </ol>

    {{ $borrowing->links() }}
@endsection

@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
    <div class="page-header">
        <h2>Detail Peminjaman</h2>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Informasi Peminjaman</h3>
        </div>

        <table class="table-books" style="margin-top: 0;">
            <tr>
                <th style="width: 220px;">Nama Anggota</th>
                <td>{{ $borrowing->member->name }}</td>
            </tr>
            <tr>
                <th>Kode Anggota</th>
                <td>{{ $borrowing->member->id }}</td>
            </tr>
            <tr>
                <th>Petugas</th>
                <td>{{ $borrowing->user->name }}</td>
            </tr>
            <tr>
                <th>Tanggal Peminjaman</th>
                <td>{{ $borrowing->borrow_date }}</td>
            </tr>
            <tr>
                <th>Jatuh Tempo</th>
                <td>{{ $borrowing->due_date }}</td>
            </tr>
            <tr>
                <th>Tanggal Pengembalian</th>
                <td>{{ $borrowing->return_date ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span class="badge-status {{ $borrowing->status == 'borrowed' ? 'status-borrowed' : 'status-returned' }}">
                        {{ ucfirst($borrowing->status) }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Daftar Buku yang Dipinjam</h3>
        </div>

        <table class="table-books" style="margin-top: 0;">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th style="width: 120px;">Jumlah</th>
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

        @if ($borrowing->status != 'borrowed')
            <div class="alert alert-success" style="margin-top: 18px; margin-bottom: 0;">
                Buku sudah dikembalikan.
            </div>
        @endif

        <div class="form-actions">
            @if ($borrowing->status == 'borrowed')
                <form action="{{ route('borrowings.return', $borrowing->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="btn" onclick="return confirm('Konfirmasi pengembalian buku ini?')">
                        Kembalikan Buku
                    </button>
                </form>
            @endif

            <a href="{{ route('borrowing.index') }}" class="btn-back">Kembali</a>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="page-header">
        <h2>{{ $title }}</h2>
        <a href="{{ route('borrowing.create') }}" class="btn">+ Tambah Peminjaman</a>
    </div>

    <form action="{{ route('borrowing.index') }}" method="GET" class="search-form">
        <input type="text" name="search" class="search-input" placeholder="Cari ID peminjaman atau nama anggota..." value="{{ request('search') }}">

        <select name="status" class="form-control" style="width: auto;">
            <option value="">Semua Status</option>
            <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
            <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
        </select>

        <button type="submit" class="btn">Cari / Filter</button>
        <a href="{{ route('borrowing.index') }}" class="btn-back">Reset</a>
    </form>

    @if (session('success'))
        <div class="alert alert-success" style="margin-top: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-books">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Peminjaman</th>
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
                    <td>
                        <span class="badge-status {{ $item->status == 'borrowed' ? 'status-borrowed' : 'status-returned' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
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

    @if ($borrowing->total() > 0)
        <div class="table-footer">
            <div class="pagination">
                {{ $borrowing->links() }}
            </div>

            <div class="pagination-info">
                Showing {{ $borrowing->firstItem() }} - {{ $borrowing->lastItem() }} of {{ $borrowing->total() }}
            </div>
        </div>
    @endif
@endsection

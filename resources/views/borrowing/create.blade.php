@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="page-header">
        <h2>{{ $title }}</h2>
    </div>

    <div class="card">
        <form action="{{ route('borrowing.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="member_id">Anggota</label>
                <select name="member_id" id="member_id" class="form-control">
                    <option value="">Pilih Anggota</option>

                    @foreach ($members as $member)
                        <option value="{{ $member->id }}"
                            {{ old('member_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>
                @error('member_id')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="borrow_date">Tanggal Peminjaman</label>
                <input type="date" name="borrow_date" id="borrow_date" class="form-control" value="{{ old('borrow_date') }}">
                @error('borrow_date')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="card-header" style="margin-top: 25px; padding-top: 18px; border-top: 1px solid #E8EDE6;">
                <h3>Daftar Buku</h3>
            </div>

            <div class="form-group">
                <label for="book_id">Buku</label>
                <select name="books[0][book_id]" id="book_id" class="form-control">
                    <option value="">Pilih Buku</option>

                    @foreach ($books as $book)
                        <option value="{{ $book->id }}"
                            {{ old('books.0.book_id') == $book->id ? 'selected' : '' }}>
                            {{ $book->title }} (Stok: {{ $book->stock }})
                        </option>
                    @endforeach
                </select>
                @error('books.0.book_id')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="quantity">Jumlah</label>
                <input type="number" name="books[0][quantity]" id="quantity" class="form-control" min="1" value="{{ old('books.0.quantity', 1) }}">
                @error('books.0.quantity')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Simpan Peminjaman</button>
                <a href="{{ route('borrowing.index') }}" class="btn-back">Kembali</a>
            </div>
        </form>
    </div>
@endsection

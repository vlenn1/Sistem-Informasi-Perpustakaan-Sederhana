
@extends('layouts.app')

@section('title', $title)

@section('content')
    <h2>{{ $title }}</h2>

    <form action="{{ route('borrowing.store') }}" method="POST">
        @csrf

        <div>
            <label for="member_id">Anggota</label>
            <select name="member_id" id="member_id">
                <option value="">Pilih Anggota</option>

                @foreach ($members as $member)
                    <option value="{{ $member->id }}"
                        {{ old('member_id') == $member->id ? 'selected' : '' }}>
                        {{ $member->name }}
                    </option>
                @endforeach
            </select>
            @error('member_id')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="borrow_date">Tanggal Peminjaman</label>
            <input type="date" name="borrow_date" id="borrow_date" value="{{ old('borrow_date') }}">
            @error('borrow_date')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <h3>Daftar Buku</h3>

        <div>
            <label for="book_id">Buku</label>
            <select name="books[0][book_id]" id="book_id">
                <option value="">Pilih Buku</option>

                @foreach ($books as $book)
                    <option value="{{ $book->id }}">
                        {{ $book->title }} (Stok: {{ $book->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="quantity">Jumlah</label>
            <input type="number" name="books[0][quantity]" id="quantity" min="1" value="1">
        </div>

        <button type="submit">Simpan Peminjaman</button>
        <a href="{{ route('borrowing.index') }}">Kembali</a>
    </form>
@endsection

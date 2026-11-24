@extends('layouts.app')

@section('title', $title)

@section('content')
    <h2>{{ $title }}</h2>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div>
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id">
                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="title">Judul Buku</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">

            @error('title')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="author">Penulis</label>
            <input type="text" name="author" id="author" value="{{ old('author') }}">

            @error('author')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="publisher">Penerbit</label>
            <input type="text" name="publisher" id="publisher" value="{{ old('publisher') }}">

            @error('publisher')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="publication_year">Tahun Terbit</label>
            <input type="number" name="publication_year" id="publication_year" value="{{ old('publication_year') }}">

            @error('publication_year')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="stock">Stok</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0">

            @error('stock')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Simpan</button>
        <a href="{{ route('books.index') }}">Kembali</a>
    </form>
@endsection

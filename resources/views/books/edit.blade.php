@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="page-header">
        <h2>{{ $title }}</h2>
    </div>

    <div class="card">
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">-- Pilih Kategori --</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Judul Buku</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title) }}">

                @error('title')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="author">Penulis</label>
                <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $book->author) }}">

                @error('author')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="publisher">Penerbit</label>
                <input type="text" name="publisher" id="publisher" class="form-control" value="{{ old('publisher', $book->publisher) }}">

                @error('publisher')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="publication_year">Tahun Terbit</label>
                <input type="number" name="publication_year" id="publication_year" class="form-control" value="{{ old('publication_year', $book->publication_year) }}">

                @error('publication_year')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Stok</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $book->stock) }}" min="0">

                @error('stock')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Perbarui</button>
                <a href="{{ route('books.index') }}" class="btn-back">Kembali</a>
            </div>
        </form>
    </div>
@endsection

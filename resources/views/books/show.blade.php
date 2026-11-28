@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="page-header">
        <h2>{{ $title }}</h2>
    </div>

    <div class="card">
        <table class="table-books" style="margin-top: 0;">
            <tr>
                <th style="width: 200px;">Judul Buku</th>
                <td>{{ $book->title }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ $book->category->name }}</td>
            </tr>
            <tr>
                <th>Penulis</th>
                <td>{{ $book->author }}</td>
            </tr>
            <tr>
                <th>Penerbit</th>
                <td>{{ $book->publisher }}</td>
            </tr>
            <tr>
                <th>Tahun Terbit</th>
                <td>{{ $book->publication_year }}</td>
            </tr>
            <tr>
                <th>Stok</th>
                <td>
                    <span class="badge-status {{ $book->stock > 0 ? 'status-active' : 'status-returned' }}">
                        {{ $book->stock }} tersedia
                    </span>
                </td>
            </tr>
        </table>

        <div class="form-actions">
            <a href="{{ route('books.edit', $book->id) }}" class="btn">Edit Buku</a>
            <a href="{{ route('books.index') }}" class="btn-back">Kembali</a>
        </div>
    </div>
@endsection

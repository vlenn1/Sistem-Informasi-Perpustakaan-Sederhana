@extends('layouts.app')

@section('title', $title)

@section('content')
    <h2>{{ $title }}</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Judul Buku</th>
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
            <td>{{ $book->stock }}</td>
        </tr>
    </table>

    <br>

    <a href="{{ route('books.edit', $book->id) }}">Edit Buku</a>
    <a href="{{ route('books.index') }}">Kembali</a>
@endsection

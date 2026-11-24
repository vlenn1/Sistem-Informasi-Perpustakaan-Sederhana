@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <h2>Tambah Kategori</h2>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <label for="name">Nama Kategori</label>
        <input type="text" name="name" id="name"
            value="{{ old('name') }}">

        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('categories.index') }}">Kembali</a>
@endsection

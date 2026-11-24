@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <h2>Edit Kategori</h2>

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nama Kategori</label>
        <input type="text" name="name" id="name"
            value="{{ old('name', $category->name) }}">

        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="{{ route('categories.index') }}">Kembali</a>
@endsection

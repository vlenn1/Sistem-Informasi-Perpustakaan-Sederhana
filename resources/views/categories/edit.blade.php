@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="page-header">
        <h2>Edit Kategori</h2>
    </div>

    <div class="card">
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $category->name) }}">

                @error('name')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">Simpan Perubahan</button>
            <a href="{{ route('categories.index') }}" class="btn-back">Kembali</a>
        </form>
    </div>
@endsection

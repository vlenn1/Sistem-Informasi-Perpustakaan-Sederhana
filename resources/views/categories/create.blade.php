@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="page-header">
        <h2>Tambah Kategori</h2>
    </div>

    <div class="card">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name') }}">

                @error('name')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">Simpan</button>
            <a href="{{ route('categories.index') }}" class="btn-back">Kembali</a>
        </form>
    </div>
@endsection

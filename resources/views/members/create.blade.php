
@extends('layouts.app')

@section('title', $title)

@section('content')
    <h2>{{ $title }}</h2>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nama Anggota</label>
            <input type="text" name="name" id="name"value="{{ old('name') }}">

            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">

            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="phone_number">Nomor Telepon</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">

            @error('phone_number')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="address">Alamat</label>
            <textarea name="address" id="address">{{ old('address') }}</textarea>

            @error('address')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Simpan</button>
        <a href="{{ route('members.index') }}">Kembali</a>
    </form>
@endsection

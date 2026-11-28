@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="page-header">
        <h2>{{ $title }}</h2>
    </div>

    <div class="card">
        <form action="{{ route('members.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Anggota</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $member->name) }}">

                @error('name')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $member->email) }}">

                @error('email')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_number">Nomor Telepon</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $member->phone_number) }}">

                @error('phone_number')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea name="address" id="address" class="form-control" rows="3">{{ old('address', $member->address) }}</textarea>

                @error('address')
                    <p style="color: #B94A48; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Perbarui</button>
                <a href="{{ route('members.index') }}" class="btn-back">Kembali</a>
            </div>
        </form>
    </div>
@endsection

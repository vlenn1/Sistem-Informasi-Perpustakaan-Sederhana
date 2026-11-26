@extends('layouts.app')

@section('title', $title)

@section('content')
    <h2>{{ $title }}</h2>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <br>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <br>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak ingin mengubah password">
        </div>

        <br>

        <div>
            <label for="role">Role</label>
            <select name="role" id="role" required>
                <option value="admin"
                    {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>

                <option value="petugas"
                    {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>
                    Petugas
                </option>
            </select>
        </div>

        <br>

        <button type="submit">Update</button>
        <a href="{{ route('users.index') }}">Kembali</a>
    </form>
@endsection


@extends('layouts.app')

@section('title', $title)

@section('content')
    <h2>{{ $title }}</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Nama Anggota</th>
            <td>{{ $member->name }}</td>
        </tr>

        <tr>
            <th>Email</th>
            <td>{{ $member->email }}</td>
        </tr>

        <tr>
            <th>Nomor Telepon</th>
            <td>{{ $member->phone_number }}</td>
        </tr>

        <tr>
            <th>Alamat</th>
            <td>{{ $member->address }}</td>
        </tr>
    </table>

    <br>

    <a href="{{ route('members.edit', $member->id) }}">Edit Anggota</a>
    <a href="{{ route('members.index') }}">Kembali</a>
@endsection

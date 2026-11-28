@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="page-header">
        <h2>{{ $title }}</h2>
    </div>

    <div class="card">
        <table class="table-books" style="margin-top: 0;">
            <tr>
                <th style="width: 200px;">Nama Anggota</th>
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

        <div class="form-actions">
            <a href="{{ route('members.edit', $member->id) }}" class="btn">Edit Anggota</a>
            <a href="{{ route('members.index') }}" class="btn-back">Kembali</a>
        </div>
    </div>
@endsection

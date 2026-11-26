@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2>Dashboard</h2>

    <h3>Ringkasan Data Perpustakaan</h3>

    <ul>
        <li>Jumlah Judul Buku: {{ $totalbooks }}</li>
        <li>Total Stok Buku: {{ $totalstocks }}</li>
        <li>Jumlah Anggota: {{ $totalmembers }}</li>
        <li>Peminjaman Aktif: {{ $activeborrowing }}</li>
    </ul>
@endsection

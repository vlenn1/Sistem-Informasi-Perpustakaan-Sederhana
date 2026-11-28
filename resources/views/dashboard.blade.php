@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <h2>Dashboard</h2>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Ringkasan Data Perpustakaan</h3>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 16px;">
            <div style="background: #F8FAF7; border: 1px solid #E8EDE6; border-radius: 8px; padding: 18px;">
                <div style="font-size: 13px; color: #5F6F65; margin-bottom: 6px;">Jumlah Judul Buku</div>
                <div style="font-size: 28px; font-weight: 700; color: #2C3E35;">{{ $totalbooks }}</div>
            </div>

            <div style="background: #F8FAF7; border: 1px solid #E8EDE6; border-radius: 8px; padding: 18px;">
                <div style="font-size: 13px; color: #5F6F65; margin-bottom: 6px;">Total Stok Buku</div>
                <div style="font-size: 28px; font-weight: 700; color: #2C3E35;">{{ $totalstocks }}</div>
            </div>

            <div style="background: #F8FAF7; border: 1px solid #E8EDE6; border-radius: 8px; padding: 18px;">
                <div style="font-size: 13px; color: #5F6F65; margin-bottom: 6px;">Jumlah Anggota</div>
                <div style="font-size: 28px; font-weight: 700; color: #2C3E35;">{{ $totalmembers }}</div>
            </div>

            <div style="background: #F8FAF7; border: 1px solid #E8EDE6; border-radius: 8px; padding: 18px;">
                <div style="font-size: 13px; color: #5F6F65; margin-bottom: 6px;">Peminjaman Aktif</div>
                <div style="font-size: 28px; font-weight: 700; color: #2C3E35;">{{ $activeborrowing }}</div>
            </div>
        </div>
    </div>
@endsection

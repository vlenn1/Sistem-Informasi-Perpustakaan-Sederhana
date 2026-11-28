@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="page-header">
        <h2>{{ $title }}</h2>
        <a href="{{ route('members.create') }}" class="btn">+ Tambah Anggota</a>
    </div>

    <form action="{{ route('members.index') }}" method="GET" class="search-form">
        <input type="text" name="search" class="search-input" placeholder="Cari ID atau nama anggota..." value="{{ request('search') }}">
        <button type="submit" class="btn">Cari</button>
        <a href="{{ route('members.index') }}" class="btn-back">Reset</a>
    </form>

    @if (session('success'))
        <div class="alert alert-success" style="margin-top: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-books">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone_number }}</td>
                    <td>{{ $member->address }}</td>
                    <td>
                        <a href="{{ route('members.show', $member->id) }}">Detail</a> |
                        <a href="{{ route('members.edit', $member->id) }}">Edit</a> |

                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus anggota ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data anggota.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($members->total() > 0)
        <div class="table-footer">
            <div class="pagination">
                {{ $members->links() }}
            </div>

            <div class="pagination-info">
                Showing {{ $members->firstItem() }} - {{ $members->lastItem() }} of {{ $members->total() }}
            </div>
        </div>
    @endif
@endsection

@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="page-header">
        <h2>{{ $title }}</h2>
        <a href="{{ route('books.create') }}" class="btn">+ Tambah Buku</a>
    </div>
    <form action="{{ route('books.index') }}" method="GET" class="search-form">
        <input type="text" name="search" class="search-input" placeholder="Cari judul atau Penulis..." value="{{ request('search') }}">
        <select name="category_id" class="form-control" style="width: auto;">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn">Cari/Filter</button>
        <a href="{{ route('books.index') }}" class="btn-back">Reset</a>
    </form>
    <br>
    
    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <table class="table-books">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $books->firstItem() + $loop->index }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->publication_year }}</td>
                    <td>{{ $book->stock }}</td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}">Detail</a> |
                        <a href="{{ route('books.edit', $book->id) }}">Edit</a> |

                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada data buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if ($books->total() > 0)
        <div class="table-footer">
            <div class="pagination">
                {{ $books->links() }}
            </div>

            <div class="pagination-info">
                Showing {{ $books->firstItem() }} - {{ $books->lastItem() }} of {{ $books->total() }}
            </div>
        </div>
    @endif
@endsection

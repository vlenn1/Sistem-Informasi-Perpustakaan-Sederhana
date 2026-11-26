<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Daftar Buku';

        $query = Book::with('category');

        if($request->filled('search')){
            $search = $request->search;

            $query->where(function($q) use ($search){
                $q->where('title', 'like', "%{$search}%")->orWhere('author', 'like', "%{$search}%");
            });
        }

        if($request->filled('category_id')){
            $query->where('category_id', $request->category_id);
        }

        $books = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();
        
        return view('books.index', compact('title', 'books', 'categories'));
    }

    public function create()
    {
        $title = 'Tambah Buku';

        $categories = Category::orderBy('name')->get();

        return view('books.create', compact('title', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'publication_year' => ['required', 'integer', 'min:1000', 'max:' . date('Y')],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('Buku berhasil ditambahkan.');
    }

    public function show(Book $book)
    {
        $title = 'Detail Buku';

        $book->load('category');

        return view('books.show', compact('title', 'book'));
    }

    public function edit(Book $book)
    {
        $title = 'Edit Buku';

        $categories = Category::orderBy('name')->get();

        return view('books.edit', compact('title', 'book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'publication_year' => ['required', 'integer', 'min:1000', 'max:' . date('Y')],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('Buku berhasil dihapus.');
    }
}

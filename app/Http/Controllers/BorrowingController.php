<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;

class BorrowingController extends Controller
{
    public function index(){
        $title = 'Daftar Peminjaman';
        $borrowing = Borrowing::with(['member', 'user'])->latest()->paginate(10);
        
        return view('borrowing.index', compact('title', 'borrowing'));
    }

    public function create(){
        $title = 'Tambah Peminjaman';
        $members = Member::all();
        $books = Book::all();

        return view('borrowing.create', compact('title', 'members', 'books'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'member_id' => ['required', 'exists:members,id'],
            'borrow_date' => ['required', 'date'],
            'books' => ['required', 'array', 'min:1'],
            'books.*.book_id' => ['required', 'exists:book,id'],
            'books.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated) {

            $borrowing = Borrowing::create([
            'user_id' => auth()->id(),
            'member_id' => $validated['member_id'],
            'borrow_date' => $validated['borrow_date'],
            'due_date' => date('Y-m-d', strtotime($validated['borrow_date'] . ' +7 days')),
            'status' => 'borrowed',
        ]);

        foreach ($validated['books'] as $item) {
            $book = Book::where('id', $item['book_id'])->lockForUpdate()->first();

            if ($book->stock < $item['quantity']) {
                throw ValidationException::withMessages([
                    'books' => 'Stok buku ' . $book->title . ' tidak mencukupi.',
                ]);
            }

            BorrowingDetail::create([
                'borrowing_id' => $borrowing->id,
                'book_id' => $book->id,
                'quantity' => $item['quantity'],
                ]);

                $book->decrement('stock', $item['quantity']);
            }
        });

        return redirect()->route('borrowings.index')->with('Peminjaman berhasil ditambahkan.');
    }

    public function show(){
        $title = 'Detail Peminjaman';
        $borrowing->load(['member', 'user', 'details.book']);

        return view('borrowing.show', compact('title', 'borrowing'));
    }

    public function returnBook(Borrowing $borrowing){
        if ($borrowing->status == 'returned') {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        foreach ($borrowing->details as $detail) {
            $detail->book->increment('stock', $detail->quantity);
        }

        $borrowing->update([
            'return_date' => now()->toDateString(),
            'status' => 'returned',
        ]);

        return redirect()->route('borrowings.show', $borrowing->id)->with('success', 'Buku berhasil dikembalikan.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;

class BorrowingController extends Controller
{
public function index(Request $request){
    $title = 'Daftar Peminjaman';

    $query = Borrowing::with(['member', 'user']);

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%{$search}%")->orWhereHas('member', function ($memberQuery) use ($search) {
                $memberQuery->where('name', 'like', "%{$search}%");
            });
        });
    }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $borrowing = $query->latest()->paginate(10)->withQueryString();

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

        return redirect()->route('borrowing.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function show(Borrowing $borrowing){
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

        return redirect()->route('borrowing.show', $borrowing->id)->with('success', 'Buku berhasil dikembalikan.');
    }
}

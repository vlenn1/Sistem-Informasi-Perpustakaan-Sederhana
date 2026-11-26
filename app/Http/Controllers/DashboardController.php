<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    public function index (){
        $totalbooks = Book::count();
        $totalstocks = Book::sum('stock');
        $totalmembers = Member::count();
        $activeborrowing = Borrowing::where('status', 'borrowed')->count();

        return view('dashboard', compact('totalbooks', 'totalstocks', 'totalmembers', 'activeborrowing'));

    }
}

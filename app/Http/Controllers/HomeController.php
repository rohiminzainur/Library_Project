<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Member;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Book;
use App\Models\Catalog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // // No. 1
        // $data1 = Member::select('*')
        // ->join('users', 'users.member_id', '=', 'members.id')
        // ->get();

        // // No. 2
        // $data2 = Member::select('*')
        // ->leftJoin('users', 'users.member_id', '=', 'members.id')
        // ->where('users.id', '=', NULL)
        // ->get();

        // // No. 3
        // $data3 = Transaction::select('members.id', 'members.name')
        // ->rightJoin('members', 'members.id', '=', 'transactions.member_id')
        // ->where('transactions.member_id', '=', NULL)
        // ->get();

        // // No. 4
        // $data4 = Member::select('members.id', 'members.name', 'members.phone_number')
        // ->join('transactions', 'transactions.member_id', '=', 'members.id')
        // ->orderBy('members.id', 'asc')
        // ->get();
        
        // // No. 5
        // $data5 = Member::select('members.id', 'members.name', 'members.phone_number')
        // ->join('transactions', 'transactions.member_id', '=', 'members.id')
        // ->select(Member::raw('count(*) as total_pinjam_lebih_dari_1x, transactions.member_id'))
        // ->groupBy('transactions.member_id')
        // ->having('total_pinjam_lebih_dari_1x', '>', 1)
        // ->get();
        
        // // No. 6
        // $data6 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
        // ->join('transactions', 'transactions.member_id', '=', 'members.id')
        // ->get();

        // // No. 7
        // $data7 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
        // ->join('transactions', 'transactions.member_id', 'members.id')
        // ->where('transactions.date_end', 'like', '%-06-%')
        // ->get();

        // // No. 8
        // $data8 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
        // ->join('transactions', 'transactions.member_id', '=', 'members.id')
        // ->where('transactions.date_end', 'like', '%-05-%')
        // ->get();

        // // No. 9
        // $data9 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
        // ->join('transactions', 'transactions.member_id', '=', 'members.id')
        // ->where('transactions.date_start', 'like', '%-06-%', 'AND', 'transactions.date_end', 'like', '%-06-%')
        // ->get();

        // // No. 10
        // $data10 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
        // ->join('transactions', 'transactions.member_id', '=', 'members.id')
        // ->where('members.address', 'like', '%Bandung%')
        // ->get();

        // // No. 11
        // $data11 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end')
        // ->join('transactions', 'transactions.member_id', '=', 'members.id')
        // ->where('members.address', 'like', '%Bandung%', 'AND', 'members.gender', 'like', '%F%')
        // ->get();

        // // No. 12
        // $data12 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end', 'books.isbn', 'transaction_details.qty')
        // ->join('transactions', 'transactions.member_id', '=', 'members.id')
        // ->join('transaction_details', 'transaction_details.id', '=', 'transaction_details.book_id')
        // ->join('books', 'books.id', '=', 'transaction_details.book_id')
        // ->where('transaction_details.qty', '>', 1)
        // ->get();

        // // No. 13
        // $data13 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end', 'books.isbn', 'transaction_details.qty', 'books.title', 'books.price', Book::raw('transaction_details.qty * books.price'))
        // ->join('transactions', 'transactions.member_id', '=', 'members.id')
        // ->join('transaction_details', 'transaction_details.id', '=', 'transaction_details.book_id')
        // ->join('books', 'books.id', '=', 'transaction_details.book_id')
        // ->get();

        // // No. 14
        // $data14 = Member::select('members.name', 'members.phone_number', 'members.address', 'transactions.date_start', 'transactions.date_end', 'books.isbn', 'transaction_details.qty', 'books.title', 'publishers.name', 'authors.name', 'catalogs.name')
        // ->join('transactions', 'transactions.member_id', '=', 'members.id')
        // ->join('transaction_details', 'transaction_details.id', '=', 'transaction_details.book_id')
        // ->join('books', 'books.id', '=', 'transaction_details.book_id')
        // ->join('publishers', 'publishers.id', '=', 'books.publisher_id')
        // ->join('authors', 'authors.id', '=', 'books.author_id')
        // ->join('catalogs', 'catalogs.id', '=', 'books.catalog_id')
        // ->get();

        // // No. 15
        // $data15 = DB::table('catalogs')
        //             ->join('books', 'books.catalog_id', '=', 'catalogs.id')
        //             ->select('catalogs.*', 'books.title')
        //             ->get();

        // // No. 16
        // $data16 = DB::table('books')
        // ->rightJoin('publishers', 'publishers.id', '=', 'books.publisher_id')
        // ->select('books.*', 'publishers.name')
        // ->get();

        // // No. 17
        // $data17 = Book::select('books')
        // ->select(Book::raw('count(*) as Jumlah_Pengarang_PG05, author_id'))
        // ->where('books.author_id', '=', 5)
        // ->groupBy('author_id')
        // ->get();

        // // No. 18
        // $data18 = Book::select('*')
        // ->where('price', '>', 10000)
        // ->orderBy('price','asc')
        // ->get();

        // // No. 19
        // $data19 = Book::select('*')
        // ->where('publisher_id', '=', 1, 'and', 'qty', '>', 10)
        // ->get();

        // // No. 20
        // $data20 = Member::select('*')
        // ->where('created_at', 'like', '%-06-%')
        // ->get();

        // return $data20;

        // $catalogs = Catalog::select('catalogs')->count();
        // $authors = Author::select('authors')->count();
        // $books = Book::select('books')->count();
        // $members = Member::select('members')->count();
        // $publishers = Publisher::select('publishers')->count();
        // return view('home', compact(['catalogs', 'authors', 'publishers', 'books', 'members']));

        return view('pages.home');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Transaction;
use App\Models\Member;
use App\Models\User;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Book;
use App\Models\Catalog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $catalogs = Catalog::select('catalogs')->count();
        $authors = Author::select('authors')->count();
        $books = Book::select('books')->count();
        $members = Member::select('members')->count();
        $publishers = Publisher::select('publishers')->count();
        $transactions = Transaction::select('transactions')->count();

        $data_areas = Book::select(Book::raw("COUNT(author_id) as total"))->groupBy('author_id')->orderBy('author_id', 'asc')->pluck('total');
        $label_areas = Author::orderBy('authors.id', 'asc')->join('books', 'books.author_id', '=', 'authors.id')->groupBy('authors.name')->pluck('authors.name');
        
        $data_donuts = Book::select(Book::raw("COUNT(publisher_id) as total"))->groupBy('publisher_id')->orderBy('publisher_id', 'asc')->pluck('total');
        $label_donuts = Publisher::orderBy('publishers.id', 'asc')->join('books', 'books.publisher_id', '=', 'publishers.id')->groupBy('name')->pluck('name');

        // return $data_donut;
        // return $label_donut;

        $label_bars = ['Peminjaman', 'Pengembalian'];
        $data_bars = [];

        foreach ($label_bars as $key => $value) {
            $data_bars[$key]['label'] = $label_bars[$key];
            $data_bars[$key]['backgroundColor'] = $key == 0 ? 'rgba(60,141,188,0.9)' : 'rgba(210, 214, 222, 1)';
            $data_month = [];

            foreach (range(1,12) as $month) {
                if ($key == 0) {
                    $data_month[] = Transaction::select(Transaction::raw("COUNT(*) as total"))->whereMonth('date_start', $month)->first()->total;
                } else {
                    $data_month[] = Transaction::select(Transaction::raw("COUNT(*) as total"))->whereMonth('date_end', $month)->first()->total;
                }
            }
            $data_bars[$key]['data'] = $data_month;
        }

        // return $data_bars;

        return view('pages.admin.dashboard', compact(['catalogs', 'authors', 'publishers', 'books', 'members', 'transactions', 'data_donuts', 'label_donuts', 'data_bars', 'data_areas', 'label_areas']));
    }
   
}
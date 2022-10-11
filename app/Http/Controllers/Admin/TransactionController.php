<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Member;
use App\Models\TransactionDetail;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $transactions = DB::table('transactions')
        // ->join('members', 'members.id', '=', 'transactions.member_id')
        // ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
        // ->join('books', 'books.id', '=', 'transaction_details.book_id')
        // ->select(Transaction::raw('datediff(date_end,date_start) as lama, transactions.date_start, transactions.date_end, members.name, transaction_details.qty, books.price, transactions.status'))
        // ->get();

        // return $transactions;

        // $transactions = Transaction::with('members')->get();


        return view('pages.admin.transaction.index');
    }

    public function api()
    {

        $transactions = DB::table('transactions')
            ->join('members', 'members.id', '=', 'transactions.member_id')
            ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->join('books', 'books.id', '=', 'transaction_details.book_id')
            ->select(Transaction::raw('datediff(date_end,date_start) as lama, transactions.id, transactions.date_start, transactions.date_end, members.name,
                                    (transaction_details.qty) as total_buku, (books.price*transaction_details.qty) as total, 
                                    IF(transactions.status = 0, "Belum Dikembalikan", "Sudah Dikembalikan") as status1'))
            ->get();
        $tmp = [];
        foreach ($transactions as $trx) {
            if (isset($tmp[$trx->name])) {
                $tmp[$trx->name]->total_buku += $trx->total_buku;
                continue;
            }
            $tmp[$trx->name] = $trx;
        }
        $resp = [];
        foreach ($tmp as $t => $v) {
            array_push($resp, $v);
        }
        $datatables = datatables()->of($resp)->addIndexColumn();
        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::all();
        $books = Book::all();

        return view('pages.admin.transaction.create', compact(['members', 'books']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aih = $request->validate([
            'name' => 'required|max:64',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'title' => 'required|max:64'
        ]);

        $data = $request->all();

        $transactions = new Transaction;
        $transactions->member_id = $data['name'];
        $transactions->date_start = $data['date_start'];
        $transactions->date_end = $data['date_end'];
        // $transactions->status = $data['status'];
        $transactions->save();
        if (count($data['title']) > 0) {
            $tmp = [];
            foreach ($data['title'] as $value) {
                $data2 = array(
                    'transaction_id' => $transactions->id,
                    'book_id' => $value,
                    'created_at' => carbon::now(),
                    'updated_at' => carbon::now(),
                );
                array_push($tmp, $data2);
            }
            TransactionDetail::insert($tmp);
        }


        // dd($total);
        //  dd($transactin_details);

        $jml_buku = DB::table('books')->where('id', '=', $request['title'])->select('qty')->get()->toArray();
        $total = $jml_buku[0]->qty - 1;

        $buku = Book::where('id', $request['title'])->update(['qty' => $total]);


        // $transaction = Transaction::with('books');

        return redirect('admin/transactions')->with('success', 'Data Telah Ditambahkan!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        // $transaction = Transaction::find($transaction);

        // return response()->json($transaction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $transactions = Transaction::where('id', $transaction->id)->first();
        $books = Book::all();
        $members = Member::all();
        $transactiondetails = TransactionDetail::where('transaction_id', $transactions->id)->get();

        return view('pages.admin.transaction.edit')->with([
            'transactions' => $transactions,
            'books' => $books,
            'members' => $members,
            'transactiondetails' => $transactiondetails,
            'transaction' => $transaction,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $trx = Transaction::where('id', (int) $id)->first();
        // Kondisi ini jika status di database 0 dan mau diupdate jadi 0
        if ($trx->status == 0 && (int) $request['status'] == 0) {
            return redirect('admin/transactions')->with('success', 'Data Telah Diupdate!!');
        }
        //  Kondisi ini jika status di database 1 dan mau diupdate jadi 1
        if ($trx->status == 1 && (int) $request['status'] == 1) {
            return redirect('admin/transactions')->with('success', 'Data Telah Diupdate!!');
        }
        // Kondisi ini jika status di database 1 dan mau diupdate jadi 0
        if ($trx->status == 1 && (int) $request['status'] == 0) {
            return redirect('admin/transactions')->with('success', 'Data Telah Diupdate!!');
        }

        $trx->status = $request['status'];
        $trx->save();

        $trx_details = TransactionDetail::where('transaction_id', $trx['id'])->get();

        foreach ($trx_details as $trxd) {
            $book = Book::where('id', $trxd->book_id)->first();
            $book->qty += $trxd->qty;
            $book->save();
        }


        return redirect('admin/transactions')->with('success', 'Data Telah Ditambahkan!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete($transaction->id);

        return redirect('admin/transactions')->with('success', 'Data Telah Dihapus!!');
    }
    public function test_spatie()
    {
        // $role = Role::create(['name' => 'bos']);
        // $permission = Permission::create(['name' => 'index peminjaman']);

        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);

        // $user = auth()->user();
        // $user->assignRole('bos');
        // return $user;

        // $user = User::where('id', 2)->first();
        // $user->assignRole('petugas');
        // return $user;


        // $user = User::with('roles')->get();
        // return $user;

        // $user = auth()->user();
        // $user->removeRole('petugas');
    }
}
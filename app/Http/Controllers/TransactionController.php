<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaction::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            // Gunakan nama kolom yang baru
            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%')
                ->orWhere('product_name', 'like', '%' . $searchTerm . '%'); // Tambahkan pencarian produk
        }

        // Logika Filter Tanggal
        if ($request->filled('start_date')) {
            // $transactions = $query->get()->where('created_at', '>=', $request->input('start_date'), 'Y-m-d');
            // dd($transaction);
            if ($request->filled('end_date')) {
                // dd($query->get()->where('created_at', '<=', $request->input('end_date'), 'Y-m-d'));
                // dd($request->input('end_date'));
                $transactions = $query->get()->where('created_at', '>=', $request->input('start_date'), 'Y-m-d')->where('created_at', '<=', $request->input('end_date'), 'Y-m-d');
            } else {
                $transactions = $query->get()->where('created_at', '>=', $request->input('start_date'), 'Y-m-d');
            }
        } else {
            if ($request->filled('end_date')) {

                $transactions = $query->get()->where('created_at', '<=', $request->input('end_date'), 'Y-m-d');
            } else {
                // Urutkan dari yang terbaru dan paginasi hasilnya (10 data per halaman)
                $transactions = $query->orderBy('created_at', 'desc')->paginate(10);
            }
        }



        //dd($query->whereDate('created_at', '<=', $request->input('end_date')))->toSql();

        // Urutkan dari yang terbaru dan paginasi hasilnya (10 data per halaman)
        // $transactions = $query->orderBy('created_at', 'desc')->paginate(10);
        // dd($transactions);

        // Kembalikan view dengan data transaksi
        // PASTIKAN BARIS INI SESUAI DENGAN STRUKTUR FOLDER ANDA
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('admin.transactions.show', compact('transaction'));
    }
}

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
            $query->whereDate('created_at', '>=', $request->input('start_date'));
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->input('end_date'));
        }

        // Urutkan dari yang terbaru dan paginasi hasilnya (10 data per halaman)
        $transactions = $query->orderBy('created_at', 'desc')->paginate(10);

        // Kembalikan view dengan data transaksi
        // PASTIKAN BARIS INI SESUAI DENGAN STRUKTUR FOLDER ANDA
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        // Anda bisa membuat view baru untuk ini, misalnya 'admin.transactions.show'
        return view('admin.transactions.show', compact('transaction'));
    }
}

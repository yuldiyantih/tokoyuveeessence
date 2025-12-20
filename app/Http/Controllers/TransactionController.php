<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaction::query();

        // 🔥 SEARCH (WAJIB DIBUNGKUS)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('product_name', 'like', '%' . $request->search . '%');
            });
        }

        // 🔥 FILTER STATUS
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 🔥 FILTER TANGGAL (FIX 1 HARI)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('created_at', $request->start_date);
        }

        // 🔥 PAGINATION
        $transactions = $query->orderBy('created_at', 'desc')->paginate(10);

        // ================= TOTAL KEUANGAN =================
        $totalKeuangan = Transaction::query();

        if ($request->filled('search')) {
            $totalKeuangan->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('product_name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $totalKeuangan->where('status', $request->status);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $totalKeuangan->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        } elseif ($request->filled('start_date')) {
            $totalKeuangan->whereDate('created_at', $request->start_date);
        }

        $totalKeuangan = $totalKeuangan->sum('total');

        return view('admin.transactions.index', compact('transactions', 'totalKeuangan'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('admin.transactions.show', compact('transaction'));
    }

    /**
     * PRINT PDF
     */
    /**
     * PRINT PDF (SESUIAI RIWAYAT TRANSAKSI)
     */
    public function print(Request $request)
    {
        $query = Transaction::query();

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('product_name', 'like', '%' . $request->search . '%');
            });
        }

        // 📦 FILTER STATUS
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 📅 FILTER TANGGAL
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('created_at', $request->start_date);
        }

        // 🔽 AMBIL DATA
        $transactions = $query->orderBy('created_at', 'desc')->get();

        // 📊 RINGKASAN
        $totalTransaksi = $transactions->count();
        $totalQty       = $transactions->sum('quantity');
        $totalHarga     = $transactions->sum('total');

        $pdf = Pdf::loadView(
            'admin.transactions.print',
            compact('transactions', 'totalTransaksi', 'totalQty', 'totalHarga')
        )->setPaper('A4', 'portrait');


        return $pdf->stream('laporan-transaksi.pdf');
    }

    public function proses($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('admin.transactions.proses', compact('transaction'));
    }

    public function terkirim($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('admin.transactions.terkirim', compact('transaction'));
    }


    /**
     * Update Status
     */
    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:proses,terkirim',
        ]);

        $transaction->status = $validated['status'];
        $transaction->save();

        // BALIK KE RIWAYAT TRANSAKSI (ADMIN)
        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Status transaksi berhasil diperbarui');
    }

    public function printSingle($id)
    {
        $transaction = Transaction::findOrFail($id);

        $pdf = Pdf::loadView(
            'admin.transactions.print_single',
            compact('transaction')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('detail-transaksi-' . $transaction->id . '.pdf');
    }
}

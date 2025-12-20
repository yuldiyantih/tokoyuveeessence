@extends('admin.layout')

@push('styles')
<link href="{{ asset('css/riwayat-transaksi.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container riwayat-transaksi mt-5">
    <h2 class="mb-4">Riwayat Transaksi</h2>

    <!-- FORM FILTER -->
    <form action="{{ route('admin.transactions.index') }}" method="GET" class="mb-4">
        <div class="row g-3 align-items-end">

            <!-- Pencarian -->
            <div class="col-md-4">
                <label class="form-label fw-semibold">Pencarian</label>
                <input type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari nama, email, produk, atau no. HP..."
                    value="{{ request('search') }}">
            </div>

            <!-- Dari Tanggal -->
            <div class="col-md-2">
                <label class="form-label fw-semibold">Dari Tanggal</label>
                <input type="date"
                    name="start_date"
                    class="form-control"
                    value="{{ request('start_date') }}">
            </div>

            <!-- Sampai Tanggal -->
            <div class="col-md-2">
                <label class="form-label fw-semibold">Sampai Tanggal</label>
                <input type="date"
                    name="end_date"
                    class="form-control"
                    value="{{ request('end_date') }}">
            </div>

            <!-- FILTER STATUS -->
            <div class="col-md-2">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="proses" {{ request('status') === 'proses' ? 'selected' : '' }}>
                        Dalam Proses
                    </option>
                    <option value="terkirim" {{ request('status') === 'terkirim' ? 'selected' : '' }}>
                        Terkirim
                    </option>
                </select>
            </div>

            <!-- TOMBOL -->
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Cari</button>

                <a href="{{ route('admin.transactions.print', request()->query()) }}"
                    target="_blank"
                    class="btn btn-outline-secondary w-100">
                    Cetak
                </a>
            </div>
        </div>
    </form>

    <!-- TOTAL KEUANGAN -->
    <div class="alert alert-info d-flex justify-content-between align-items-center mb-4">
        <span class="fw-semibold">Total Keuangan</span>
        <span class="fs-5 fw-bold">
            Rp {{ number_format($totalKeuangan ?? 0, 0, ',', '.') }}
        </span>
    </div>

    <!-- TABEL TRANSAKSI -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Produk</th>
                    <th class="text-center">Jumlah</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $transactions->firstItem() + $loop->index }}</td>
                    <td>{{ $transaction->name }}</td>
                    <td>{{ $transaction->product_name }}</td>
                    <td class="text-center">{{ $transaction->quantity }}</td>
                    <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                    <td>{{ $transaction->created_at->format('d M Y') }}</td>

                    <!-- STATUS ACTION -->
                    <td>
                        <div class="status-actions">

                            <a href="{{ route('admin.transactions.proses', $transaction->id) }}"
                                class="btn-status
                               {{ $transaction->status === 'proses' ? 'status-active' : 'status-inactive' }}">
                                Dalam Proses
                            </a>

                            <a href="{{ route('admin.transactions.terkirim', $transaction->id) }}"
                                class="btn-status
                               {{ $transaction->status === 'terkirim' ? 'status-active' : 'status-inactive' }}">
                                Terkirim
                            </a>

                        </div>
                    </td>

                    <!-- AKSI -->
                    <td>
                        <a href="{{ route('admin.transactions.show', $transaction->id) }}"
                            class="btn btn-info btn-sm">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        Tidak ada data transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    @if ($transactions->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $transactions->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
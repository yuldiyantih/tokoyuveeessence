@extends('admin.layout')

@push('styles')
<link href="{{ asset('css/riwayat-transaksi.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Riwayat Transaksi</h2>

    <!-- Form Pencarian dan Filter -->
    <form action="{{ route('admin.transactions.index') }}" method="GET">
        <div class="row g-3">
            <div class="col-md-5">
                <label for="search" class="form-label">Pencarian</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Cari nama, email, produk, atau no. HP..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label for="start_date" class="form-label">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label for="end_date" class="form-label">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Cari</button>
            </div>
        </div>
    </form>

    <!-- Tabel Data Transaksi -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
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
                    <td>{{ $transaction->quantity }}</td>
                    <td>Rp. {{ number_format($transaction->total, 0, ',', '.') }}</td>
                    <td>{{ $transaction->created_at->format('d M Y') }}</td>
                    <td>
                        @if ($transaction->status == 'Selesai')
                        <span class="badge bg-success">{{ $transaction->status }}</span>
                        @elseif ($transaction->status == 'Proses')
                        <span class="badge bg-warning text-dark">{{ $transaction->status }}</span>
                        @else
                        <span class="badge bg-secondary">{{ $transaction->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="btn btn-info">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data transaksi yang ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $transactions->links() }}
    </div>
</div>
@endsection
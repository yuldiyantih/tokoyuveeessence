@extends('admin.layout')

@section('title', 'Detail Transaksi')

@push('css')
<link rel="stylesheet" href="{{ asset('css/riwayat-transaksi-detail.css') }}">
@endpush

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <!-- CARD UTAMA -->
            <div class="rt-card">

                <!-- HEADER -->
                <div class="rt-card-header">
                    Detail Transaksi
                </div>

                <!-- BODY TABEL -->
                <div class="rt-card-body">
                    <table class="rt-table mb-0">
                        <tbody>
                            <tr>
                                <th>ID Transaksi</th>
                                <td>{{ $transaction->id ?? '-' }}</td>
                            </tr>

                            <tr>
                                <th>Nama</th>
                                <td>{{ $transaction->name ?: '-' }}</td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td>{{ $transaction->email ?: '-' }}</td>
                            </tr>

                            <tr>
                                <th>No. HP</th>
                                <td>{{ $transaction->phone ?: '-' }}</td>
                            </tr>

                            <tr>
                                <th>Alamat</th>
                                <td>{{ $transaction->address ?: '-' }}</td>
                            </tr>

                            <tr>
                                <th>Produk</th>
                                <td>{{ $transaction->product_name ?: '-' }}</td>
                            </tr>

                            <tr>
                                <th>Jumlah</th>
                                <td>{{ $transaction->quantity ?: '0' }}</td>
                            </tr>

                            <tr>
                                <th>Total</th>
                                <td class="rt-total">
                                    Rp {{ number_format($transaction->total ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($transaction->status === 'proses')
                                    <a href="{{ route('admin.transactions.proses', $transaction->id) }}" class="rt-status">
                                        Dalam Proses
                                    </a>
                                    @elseif ($transaction->status === 'terkirim')
                                    <a href="{{ route('admin.transactions.terkirim', $transaction->id) }}" class="rt-status">
                                        Terkirim
                                    </a>
                                    @else
                                    <span class="rt-status" style="background-color: #6c757d;">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- FOOTER TOMBOL -->
                <div class="rt-card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.transactions.printSingle', $transaction->id) }}" target="_blank" class="rt-btn-print">
                        Cetak
                    </a>
                    <a href="{{ route('admin.transactions.index') }}" class="rt-btn-back">
                        Kembali
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
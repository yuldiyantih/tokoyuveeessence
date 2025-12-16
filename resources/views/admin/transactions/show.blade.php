@extends('admin.layout')

@section('title', 'Detail Transaksi')

@push('css')
<link rel="stylesheet" href="{{ asset('css/riwayat-transaksi-detail.css') }}">
@endpush

@section('content')
<div class="container my-4">

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card rt-card">

                <div class="rt-card-header">
                    Detail Transaksi
                </div>

                <div class="card-body p-0">
                    <table class="table rt-table mb-0">
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
                                    <span class="rt-status">
                                        {{ $transaction->status ? ucfirst($transaction->status) : '-' }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer text-end">
                    <a href="{{ route('admin.transactions.index') }}" class="btn rt-btn-back">
                        Kembali
                    </a>
                </div>

                </a>
            </div>

        </div>

    </div>
</div>

</div>
@endsection
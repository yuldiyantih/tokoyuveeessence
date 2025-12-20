<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .logo {
            width: 80px;
        }

        .header-text {
            margin-left: 15px;
        }

        .header-text h2 {
            margin: 0;
            font-size: 18px;
        }

        .header-text p {
            margin: 2px 0;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        table th {
            background: #f2f2f2;
        }

        .summary {
            margin-top: 15px;
        }

        .summary p {
            margin: 4px 0;
            font-weight: bold;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <img
            src="{{ public_path('storage/products/logo.png') }}"
            class="logo">
        <div class="header-text">
            <h2>LAPORAN RIWAYAT TRANSAKSI</h2>
            <p>Admin : {{ auth()->user()->name }}</p>
            <p>Tanggal Cetak : {{ now()->format('d-m-Y H:i') }}</p>
        </div>
    </div>

    {{-- TABEL TRANSAKSI --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                <td>{{ ucfirst($item->status) }}</td>
                <td>{{ $item->created_at->format('d-m-Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center">
                    Data transaksi tidak ditemukan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- RINGKASAN --}}
    <div class="summary">
        <p>Total Transaksi : {{ $totalTransaksi }}</p>
        <p>Total Quantity : {{ $totalQty }}</p>
        <p>Total Harga : Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
    </div>

</body>

</html>
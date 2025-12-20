<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .container {
            max-width: 700px;
            margin: auto;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header img {
            width: 70px;
        }

        .header .info {
            margin-left: 15px;
        }

        .header h3 {
            margin: 0;
            font-size: 16px;
        }

        .header p {
            margin: 2px 0;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table td {
            border: 1px solid #000;
            padding: 6px;
        }

        table td.label {
            width: 30%;
            background: #f8f8f8;
            font-weight: bold;
        }

        .total {
            color: #c2185b;
            font-weight: bold;
        }

        .status {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            color: #fff;
            display: inline-block;
        }

        .proses {
            background: #28a745;
        }

        .terkirim {
            background: #dc3545;
        }

        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- HEADER --}}
        <div class="header">
            <img src="{{ public_path('storage/products/logo.png') }}" alt="Logo">
            <div class="info">
                <h3>DETAIL TRANSAKSI</h3>
                <p>Admin : {{ auth()->user()->name }}</p>
                <p>Tanggal Cetak : {{ now()->format('d-m-Y H:i') }}</p>
            </div>
        </div>

        {{-- DETAIL TRANSAKSI --}}
        <table>
            <tr>
                <td class="label">ID Transaksi</td>
                <td>{{ $transaction->id }}</td>
            </tr>
            <tr>
                <td class="label">Nama</td>
                <td>{{ $transaction->name }}</td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td>{{ $transaction->email }}</td>
            </tr>
            <tr>
                <td class="label">No. HP</td>
                <td>{{ $transaction->phone }}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td>{{ $transaction->address }}</td>
            </tr>
            <tr>
                <td class="label">Produk</td>
                <td>{{ $transaction->product_name }}</td>
            </tr>
            <tr>
                <td class="label">Jumlah</td>
                <td>{{ $transaction->quantity }}</td>
            </tr>
            <tr>
                <td class="label">Total</td>
                <td class="total">
                    Rp {{ number_format($transaction->total, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td>
                    <span class="status {{ $transaction->status }}">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </td>
            </tr>
        </table>

        <div class="footer">
            Dicetak oleh sistem Yuvee Essence
        </div>

    </div>

</body>

</html>
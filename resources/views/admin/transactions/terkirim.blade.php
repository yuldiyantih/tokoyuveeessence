<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Status Transaksi - Terkirim</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #e6fffa, #f0fff4);
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            max-width: 700px;
            margin: 80px auto;
            background: #ffffff;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(72, 187, 120, 0.2);
            text-align: center;
        }

        h2 {
            color: #2f855a;
            margin-bottom: 30px;
        }

        .status-icon {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #48bb78, #38a169);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 50px;
            margin: 0 auto 20px;
        }

        .note {
            background: #f0fff4;
            padding: 20px;
            border-radius: 12px;
            color: #276749;
            font-size: 15px;
            margin-bottom: 30px;
        }

        /* Tombol Kembali */
        .btn-back {
            display: inline-block;
            padding: 12px 26px;
            background: linear-gradient(135deg, #38a169, #2f855a);
            color: #ffffff;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.25s ease;
            box-shadow: 0 8px 20px rgba(56, 161, 105, 0.35);
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(56, 161, 105, 0.45);
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Status Transaksi: Terkirim</h2>

        <div class="status-icon">
            <i class="fas fa-check-circle"></i>
        </div>

        <div class="note">
            <p>Pesanan telah berhasil dikirim ke customer.</p>
            <p>Terima kasih telah berbelanja di toko kami 💚</p>
        </div>

        <!-- TOMBOL KEMBALI -->
        <a href="{{ route('admin.transactions.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Riwayat Transaksi
        </a>
    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Status Transaksi - Proses</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
        }

        .card {
            max-width: 900px;
            margin: 60px auto;
            background: #fff;
            border-radius: 24px;
            padding: 50px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .08);
            text-align: center;
        }

        h2 {
            margin-bottom: 40px;
            color: #1e293b;
        }

        .steps {
            display: flex;
            justify-content: center;
            gap: 60px;
            margin-bottom: 40px;
        }

        .step {
            cursor: pointer;
            transition: .3s;
        }

        .circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            color: #fff;
            margin-bottom: 10px;
        }

        .packing .circle {
            background: #fb923c;
        }

        .delivery .circle {
            background: #60a5fa;
        }

        .step.active {
            transform: scale(1.08);
        }

        .note {
            background: #f1f5f9;
            padding: 25px;
            border-radius: 16px;
            color: #334155;
            margin-bottom: 35px;
            font-size: 15px;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        button {
            padding: 12px 28px;
            border-radius: 12px;
            border: none;
            font-size: 15px;
            cursor: pointer;
        }

        .btn-save {
            background: #e5e7eb;
        }

        .btn-send {
            background: #22c55e;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="card">
        <h2>Status Transaksi: Dalam Proses</h2>

        <!-- STEP -->
        <div class="steps">
            <div class="step packing active" onclick="setStep('packing')">
                <div class="circle">📦</div>
                <strong>Packing</strong>
            </div>

            <div class="step delivery" onclick="setStep('delivery')">
                <div class="circle">🚚</div>
                <strong>Dalam Perjalanan</strong>
            </div>
        </div>

        <!-- NOTE -->
        <div class="note" id="noteText">
            Pesanan sedang dalam tahap <b>pengemasan</b>.
            Tim kami memastikan produk dikemas dengan aman sebelum dikirim ke customer.
        </div>

        <!-- FORM -->
        <form action="{{ route('admin.transactions.updateStatus', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- STATUS DB -->
            <input type="hidden" name="status" value="proses">

            <!-- STEP UNTUK FRONTEND -->
            <input type="hidden" name="step" id="stepInput" value="packing">

            <div class="actions">
                <button type="submit" class="btn-save">
                    Simpan Status
                </button>

                <button
                    type="submit"
                    name="status"
                    value="terkirim"
                    class="btn-send">
                    Tandai Terkirim
                </button>
            </div>
        </form>
    </div>

    <script>
        function setStep(step) {
            document.getElementById('stepInput').value = step;

            document.querySelector('.packing').classList.remove('active');
            document.querySelector('.delivery').classList.remove('active');

            if (step === 'packing') {
                document.querySelector('.packing').classList.add('active');
                document.getElementById('noteText').innerHTML =
                    'Pesanan sedang dalam tahap <b>pengemasan</b>. Tim kami memastikan produk dikemas dengan aman sebelum dikirim ke customer.';
            } else {
                document.querySelector('.delivery').classList.add('active');
                document.getElementById('noteText').innerHTML =
                    'Pesanan telah <b>dikirim</b> dan sedang dalam perjalanan menuju alamat customer.';
            }
        }
    </script>

</body>

</html>
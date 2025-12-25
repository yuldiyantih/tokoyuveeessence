@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/frontend-cart.css') }}">

<section class="cart-page">
    <div class="cart-container">
        <h2>Keranjang Belanja Kamu</h2>

        @if($cartItems->count() > 0)

        {{-- 🔥 FORM CHECKOUT --}}
        <form action="{{ route('customer.checkout.index') }}" method="GET" id="cart-form">

            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($cartItems as $item)
                    <tr class="cart-row"
                        data-id="{{ $item->id }}"
                        data-price="{{ $item->product->price }}">

                        {{-- CHECKBOX --}}
                        <td>
                            <input type="checkbox"
                                class="cart-check"
                                name="cart_ids[]"
                                value="{{ $item->id }}">
                        </td>

                        {{-- Gambar --}}
                        <td>
                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                alt="{{ $item->product->name }}"
                                class="cart-img">
                        </td>

                        {{-- Nama --}}
                        <td>{{ $item->product->name }}</td>

                        {{-- Harga --}}
                        <td>
                            Rp{{ number_format($item->product->price, 0, ',', '.') }}
                        </td>

                        {{-- Jumlah --}}
                        <td>
                            <div class="qty-form">
                                <button type="button"
                                    class="qty-btn"
                                    data-action="decrease">−</button>

                                <span class="qty-number">{{ $item->quantity }}</span>

                                <button type="button"
                                    class="qty-btn"
                                    data-action="increase">+</button>
                            </div>
                        </td>

                        {{-- Total per item --}}
                        <td class="item-total">
                            Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </td>

                        {{-- Hapus --}}
                        <td>
                            <form action="{{ route('customer.cart.remove', $item->id) }}" method="POST">
                                @csrf
                                <button class="qty-btn btn-remove">✕</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- TOTAL --}}
            <div class="cart-total">
                <h3>
                    Total Keseluruhan:
                    <span id="grand-total">
                        Rp{{ number_format($total, 0, ',', '.') }}
                    </span>
                </h3>
            </div>

            {{-- BUTTON DI BAWAH TOTAL --}}
            <div class="cart-buttons">
                <a href="{{ route('produk.index') }}" class="btn lanjut">
                    Continue Shopping
                </a>

                <button type="submit" class="btn checkout">
                    Checkout
                </button>
            </div>
        </form>

        @else

        <p class="empty-cart">😢 Keranjang kamu masih kosong</p>

        <a href="{{ route('produk.index') }}" class="btn lanjut">
            Continue Shopping
        </a>

        @endif
    </div>
</section>

{{-- 🔥 JS SMOOTH CART --}}
<script>
    const formatter = new Intl.NumberFormat('id-ID');

    function updateTotalUI() {
        let total = 0;

        document.querySelectorAll('.cart-row').forEach(row => {
            const checkbox = row.querySelector('.cart-check');
            if (!checkbox.checked) return;

            const price = parseInt(row.dataset.price);
            const qty = parseInt(row.querySelector('.qty-number').innerText);
            total += price * qty;
        });

        document.getElementById('grand-total').innerText =
            'Rp' + formatter.format(total);
    }

    // Checkbox update total
    document.querySelectorAll('.cart-check').forEach(cb => {
        cb.addEventListener('change', updateTotalUI);
    });

    // Qty button (AJAX)
    document.querySelectorAll('.qty-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('.cart-row');
            const cartId = row.dataset.id;
            const action = this.dataset.action;
            if (!action) return;

            fetch(`/customer/cart/update/${cartId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        action
                    })
                })
                .then(res => res.ok && res.json())
                .then(() => {
                    const qtyEl = row.querySelector('.qty-number');
                    let qty = parseInt(qtyEl.innerText);

                    if (action === 'increase') qty++;
                    if (action === 'decrease' && qty > 1) qty--;

                    qtyEl.innerText = qty;

                    const price = parseInt(row.dataset.price);
                    row.querySelector('.item-total').innerText =
                        'Rp' + formatter.format(price * qty);

                    updateTotalUI();
                });
        });
    });

    // Tombol Update Cart
    document.getElementById('update-cart')
        .addEventListener('click', updateTotalUI);
</script>
@endsection
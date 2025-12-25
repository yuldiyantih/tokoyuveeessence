@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/frontend-show.css') }}">

<section class="product-detail">
    <div class="container">

        {{-- Gambar produk --}}
        <div class="image-section">
            <img src="{{ asset('storage/' . $product->image) }}"
                alt="{{ $product->name }}">
        </div>

        {{-- Informasi produk --}}
        <div class="info-section">

            <h2>{{ $product->name }}</h2>
            <p class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="netto">Netto: <span>{{ $product->netto ?? '14 gram' }}</span></p>

            {{-- Qty --}}
            <div class="qty">
                <button type="button" class="minus">-</button>
                <input type="number" name="quantity" value="1" min="1" class="input-qty">
                <button type="button" class="plus">+</button>
            </div>

            {{-- Tombol Aksi --}}
            <div class="action-buttons">

                {{-- ✅ BUY NOW → langsung ke checkout --}}
                <form action="{{ route('customer.buy.now', $product->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-buy-now">Buy Now</button>
                </form>


                {{-- ✅ ADD TO CART --}}
                <form action="{{ route('customer.cart.add', $product->id) }}" method="POST" class="form-add-to-cart">
                    @csrf
                    <input type="hidden" name="quantity" value="1" class="qty-hidden cart-qty-hidden">
                    <button type="submit" class="btn-add-to-cart">
                        Add to Cart
                    </button>
                </form>

            </div>


            {{-- Deskripsi produk --}}
            <div class="desc">
                <h3>Product Details</h3>
                <p>{{ $product->description }}</p>

                <h3>Ingredients</h3>
                <p>{{ $product->ingredients ?? 'Mica, Talc, Silica, Dimethicone, Titanium Dioxide, Iron Oxides, Fragrance.' }}</p>

                <h3>Skin Type</h3>
                <p>{{ $product->skin_type ?? 'Cocok untuk semua jenis kulit.' }}</p>

                <h3>How to Use</h3>
                <p>{{ $product->how_to_use ?? 'Aplikasikan warna dasar di seluruh kelopak mata, tambahkan warna gelap di sudut mata, dan shimmer di tengah untuk hasil lebih hidup.' }}</p>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const minusBtn = document.querySelector('.minus');
        const plusBtn = document.querySelector('.plus');
        const qtyInput = document.querySelector('.input-qty');

        const buyQtyHidden = document.querySelector('.buy-qty-hidden');
        const cartQtyHidden = document.querySelector('.cart-qty-hidden');

        function syncQty() {
            const val = Math.max(parseInt(qtyInput.value), 1);
            qtyInput.value = val;
            buyQtyHidden.value = val;
            cartQtyHidden.value = val;
        }

        minusBtn.addEventListener('click', () => {
            qtyInput.value = Math.max(1, parseInt(qtyInput.value) - 1);
            syncQty();
        });

        plusBtn.addEventListener('click', () => {
            qtyInput.value = parseInt(qtyInput.value) + 1;
            syncQty();
        });

        qtyInput.addEventListener('input', syncQty);
    });
</script>


@endsection
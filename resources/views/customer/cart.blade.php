@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: auto;">
    <h2 style="margin-bottom: 20px;">🛒 Keranjang Belanja</h2>

    @if(session('success'))
        <div style="background: #d4edda; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #f8d7da; padding: 10px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
            {{ session('error') }}
        </div>
    @endif

    @if(!empty($cart) && count($cart) > 0)
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 10px; border: 1px solid #ccc;">Produk</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Jumlah</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Harga</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Subtotal</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($cart as $item)
                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            <strong>{{ $item['name'] }}</strong><br>
                            <img src="{{ asset('storage/uploads/' . $item['image']) }}" alt="{{ $item['name'] }}" width="80">
                        </td>
                        <td style="padding: 10px; border: 1px solid #ccc;">{{ $item['quantity'] }}</td>
                        <td style="padding: 10px; border: 1px solid #ccc;">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td style="padding: 10px; border: 1px solid #ccc;">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            <a href="{{ route('cart.remove', $item['product_id']) }}" onclick="return confirm('Hapus item ini?')"
                               style="color: red; text-decoration: none;">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            <p><strong>Total: Rp {{ number_format($total, 0, ',', '.') }}</strong></p>

            <form action="{{ route('checkout.process') }}" method="POST" style="margin-top: 10px;">
                @csrf
                <input type="text" name="name" placeholder="Nama Anda" required
                       style="padding: 8px; width: 100%; margin-bottom: 10px;">
                <input type="hidden" name="total" value="{{ $total }}">
                <button type="submit"
                        style="background-color: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer;">
                    Checkout via WhatsApp
                </button>
            </form>

            <a href="{{ route('cart.clear') }}" onclick="return confirm('Kosongkan semua item?')"
               style="display: inline-block; margin-top: 10px; color: #dc3545; text-decoration: none;">
                Kosongkan Keranjang
            </a>
        </div>
    @else
        <div style="background: #f8d7da; padding: 10px; border: 1px solid #f5c6cb;">
            Keranjang Anda kosong.
        </div>
    @endif
</div>
@endsection

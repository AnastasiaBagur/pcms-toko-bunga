@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div style="max-width: 1200px; margin: auto;">
        <h2 style="margin-bottom: 20px;">🛍️ Daftar Produk</h2>

        @if(session('success'))
            <div style="background: #d4edda; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        @if(count($products) > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px;">
                @foreach($products as $product)
                    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; background-color: #f9f9f9;">
                        <img src="{{ asset('storage/uploads/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 180px; object-fit: cover; border-radius: 6px;">
                        
                        <h4 style="margin-top: 10px;">{{ $product->name }}</h4>
                        <p style="margin: 5px 0;">Harga: <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>

                        {{-- Tombol Tambah ke Keranjang --}}
                        <form action="{{ route('cart.add') }}" method="POST" style="margin-bottom: 10px;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" style="background-color: #28a745; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; width: 100%;">
                                + Tambah ke Keranjang
                            </button>
                        </form>

                        {{-- Tombol Tanya via WhatsApp --}}
                        @php
                            $waText = "Halo Admin, saya tertarik dengan produk:\n\n*{$product->name}*\nHarga: Rp " . number_format($product->price, 0, ',', '.');
                            $waLink = 'https://wa.me/6281339344311?text=' . urlencode($waText);
                        @endphp
                        <a href="{{ $waLink }}" target="_blank" style="background-color: #25d366; color: white; display: block; text-align: center; padding: 8px 12px; border-radius: 4px; text-decoration: none; font-weight: bold;">
                            💬 Tanya via WhatsApp
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div style="background: #f8d7da; padding: 10px; border: 1px solid #f5c6cb;">
                Tidak ada produk tersedia saat ini.
            </div>
        @endif
    </div>
@endsection

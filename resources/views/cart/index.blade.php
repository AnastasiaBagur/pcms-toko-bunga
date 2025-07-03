@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            margin-top: 30px;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2e7d32;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        table th, table td {
            padding: 10px 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f0f0f0;
        }

        .total {
            font-weight: bold;
            text-align: right;
        }

        .btn-pesan {
            background-color: #25D366;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
            transition: 0.3s;
        }

        .btn-pesan:hover {
            background-color: #1ebd57;
        }
    </style>

    <div class="container">
        <h2>Keranjang Belanja</h2>

        @if(count($cartItems) > 0)
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $totalHarga = 0; 
                        $pesan = "Halo, saya ingin memesan:%0A"; 
                    @endphp
                    @foreach ($cartItems as $item)
                        @php
                            $subtotal = $item->product->price * $item->quantity;
                            $totalHarga += $subtotal;
                            $pesan .= "- " . $item->product->name . " (x" . $item->quantity . ") = Rp" . number_format($subtotal, 0, ',', '.') . "%0A";
                        @endphp
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    @php $pesan .= "Total: Rp" . number_format($totalHarga, 0, ',', '.') . "%0A"; @endphp
                </tbody>
            </table>

            <p class="total">Total Bayar: <strong>Rp{{ number_format($totalHarga, 0, ',', '.') }}</strong></p>

            @php
                $no_wa = '6281339344311'; // ← GANTI DENGAN NOMOR WHATSAPP ADMIN
                $wa_url = "https://wa.me/$no_wa?text=$pesan";
            @endphp

            <a href="{{ $wa_url }}" target="_blank" class="btn-pesan">📲 Pesan Sekarang via WhatsApp</a>
        @else
            <p>Keranjang Anda masih kosong.</p>
        @endif
    </div>
@endsection

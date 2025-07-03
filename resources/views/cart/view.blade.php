@extends('layouts.app')

@section('content')
<h2>Keranjang Belanja</h2>

@if(count($cart) > 0)
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
            @foreach($cart as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Keranjang kamu kosong.</p>
@endif
@endsection

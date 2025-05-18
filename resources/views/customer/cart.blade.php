@extends('layouts.app')

@section('content')
<h2>Keranjang Belanja</h2>
<table>
    <tr>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Harga</th>
    </tr>
    @php $total = 0; @endphp
    @foreach ($cart as $item)
        <tr>
            <td>{{ $item['product_id'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>Rp {{ $item['price'] }}</td>
            @php $total += $item['price'] * $item['quantity']; @endphp
        </tr>
    @endforeach
</table>

<form action="/checkout" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nama Anda" required>
    <input type="hidden" name="total" value="{{ $total }}">
    <button type="submit">Bayar Rp {{ $total }}</button>
</form>
@endsection

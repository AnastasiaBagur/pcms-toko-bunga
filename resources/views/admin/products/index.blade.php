@extends('layouts.app')

@section('content')
<h2>Daftar Produk</h2>
<a href="{{ route('admin.products.create') }}">+ Tambah Produk</a>
<table>
    <tr>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ $product->name }}</td>
        <td>Rp {{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td>
            <a href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf 
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection

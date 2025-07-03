@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        h2 {
            color: #2e7d32;
            margin-bottom: 20px;
        }

        .container {
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
            gap: 10px;
        }

        .btn-add {
            background-color: #2e7d32;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-form input[type="text"] {
            padding: 8px 12px;
            width: 220px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-form button {
            padding: 8px 15px;
            border-radius: 5px;
            border: none;
            background-color: #388e3c;
            color: white;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            background: white;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }

        th {
            background-color: #c8e6c9;
            color: #1b5e20;
        }

        img {
            width: 80px;
            height: auto;
            border-radius: 5px;
        }

        .btn-edit {
            color: #2e7d32;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-delete {
            background-color: #c62828;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-cart {
            background-color: #1b5e20;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .action-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        form {
            margin: 0;
        }

        .search-info {
            margin-bottom: 15px;
            color: #333;
        }
    </style>

    <div class="container">
        <h2>Daftar Produk</h2>

        <div class="top-bar">
            <a href="{{ route('admin.products.create') }}" class="btn-add">+ Tambah Produk</a>

            <form method="GET" action="{{ route('admin.products.index') }}" class="search-form">
                <input type="text" name="q" placeholder="Cari produk..." value="{{ request('q') }}">
                <button type="submit">Cari</button>
            </form>
        </div>

        @if(request('q'))
            <p class="search-info">Hasil pencarian untuk: <strong>{{ request('q') }}</strong></p>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('images/default.jpg') }}" alt="Tidak ada gambar">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td class="action-cell">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">Edit</a>

                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>

                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-cart">+ Keranjang</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Produk tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

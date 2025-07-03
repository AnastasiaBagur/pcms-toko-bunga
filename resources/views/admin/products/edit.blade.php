@extends('layouts.app')

@section('content')
    <style>
        form {
            max-width: 500px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #2e7d32;
        }

        form div {
            margin-bottom: 15px;
        }

        form input[type="text"],
        form input[type="number"],
        form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
        }

        form button {
            background-color: #2e7d32;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #1b5e20;
        }
    </style>

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
        @csrf 
        @method('PUT')
        <h2>Edit Produk</h2>

        <div>
            <input type="text" name="name" value="{{ $product->name }}" placeholder="Nama Produk" required>
        </div>

        <div>
            <textarea name="description" placeholder="Deskripsi">{{ $product->description }}</textarea>
        </div>

        <div>
            <input type="number" name="price" value="{{ $product->price }}" placeholder="Harga" required>
        </div>

        <div>
            <input type="number" name="stock" value="{{ $product->stock }}" placeholder="Stok" required>
        </div>

        <div>
            <input type="text" name="image" value="{{ $product->image }}" placeholder="URL Gambar atau Nama File">
        </div>

        <div>
            <button type="submit">Update</button>
        </div>
    </form>
@endsection

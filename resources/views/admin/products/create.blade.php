@extends('layouts.app')

@section('content')
<h2>Tambah Produk</h2>

<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Nama Produk" required>
    <textarea name="description" placeholder="Deskripsi"></textarea>
    <input type="number" name="price" placeholder="Harga" required>
    <input type="number" name="stock" placeholder="Stok" required>
    <input type="file" name="image">
    <button type="submit">Simpan</button>
</form>
@endsection

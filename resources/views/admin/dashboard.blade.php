@extends('layouts.app')

@section('content')
<h2>Dashboard Admin</h2>
<p>Selamat datang, Admin!</p>
<a href="{{ route('admin.products.index') }}">Kelola Produk</a> |
<a href="{{ url('/admin/transactions') }}">Lihat Transaksi</a>
<form action="{{ route('admin.logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
@endsection

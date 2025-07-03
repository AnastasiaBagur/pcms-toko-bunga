@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="admin-dashboard">
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, <strong>Admin</strong>! Silakan pilih menu di bawah ini untuk mengelola sistem.</p>

    <div class="dashboard-links">
        <a href="{{ route('admin.products.index') }}" class="dashboard-btn">🛒 Kelola Produk</a>
        <a href="{{ url('/admin/transactions') }}" class="dashboard-btn">📄 Lihat Transaksi</a>
    </div>

    <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit" class="logout-btn">🚪 Logout</button>
    </form>
</div>

<style>
    .admin-dashboard {
        max-width: 600px;
        margin: 40px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        text-align: center;
    }

    .admin-dashboard h2 {
        color: #1d61b9;
        margin-bottom: 10px;
    }

    .admin-dashboard p {
        color: #333;
        margin-bottom: 25px;
    }

    .dashboard-links {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 30px;
    }

    .dashboard-btn {
        display: block;
        padding: 12px 20px;
        background-color: #1d61b9;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .dashboard-btn:hover {
        background-color: #144c93;
    }

    .logout-form {
        margin-top: 20px;
    }

    .logout-btn {
        padding: 10px 20px;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .logout-btn:hover {
        background-color: #bb2d3b;
    }
</style>
@endsection

@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')
<div class="login-wrapper">
    <div class="login-box">
        <h2>Login Admin</h2>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Admin</label>
                <input type="email" name="email" id="email" placeholder="admin@domain.com" required>
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</div>

<style>
    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 60vh;
        padding: 30px 15px;
        background-color: #f8f9fa;
    }

    .login-box {
        background: #ffffff;
        padding: 35px 30px;
        max-width: 400px;
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    }

    .login-box h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #1d61b9;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #333;
    }

    .form-group input {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f1f5f9;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        border-color: #1d61b9;
        outline: none;
        background-color: #fff;
    }

    .login-btn {
        width: 100%;
        padding: 12px;
        background-color: #1d61b9;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .login-btn:hover {
        background-color: #144c93;
    }
</style>
@endsection

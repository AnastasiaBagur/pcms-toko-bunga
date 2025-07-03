<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Bunga Online')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color:rgb(40, 95, 179);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .navbar a {
            color: #ffffff;
            text-decoration: none;
            margin-right: 15px;
            font-weight: bold;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .navbar form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar input[type="text"] {
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .navbar button {
            padding: 6px 12px;
            background-color: #07196b;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            border-radius: 8px;
        }

        .alert {
            padding: 10px 15px;
            background-color: #d4edda;
            color: #155724;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* WhatsApp Chat Box Styles */
        #waChatBox {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 320px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            padding: 20px;
            z-index: 9999;
            display: none;
            animation: fadeInUp 0.3s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .wa-input, .wa-textarea {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-family: inherit;
            font-size: 14px;
        }

        .wa-textarea {
            min-height: 80px;
            resize: vertical;
        }

        .wa-button {
            background-color: #25d366;
            color: white;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .wa-button:hover {
            background-color: #1ebe57;
        }

        #waChatToggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #25d366;
            color: white;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            text-align: center;
            line-height: 55px;
            font-size: 28px;
            cursor: pointer;
            z-index: 9999;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div>
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ route('products.index') }}">Produk</a>
            <a href="{{ route('cart.view') }}">Keranjang</a>
            <a href="{{ route('admin.dashboard') }}">Admin</a>
        </div>

        <form action="{{ route('admin.products.index') }}" method="GET">
            <input type="text" name="q" placeholder="Cari produk..." value="{{ request('q') }}">
            <button type="submit">Cari</button>
        </form>
    </div>

    <div class="container">
        {{-- Notifikasi sukses --}}
        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        {{-- Notifikasi error --}}
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        {{-- Isi halaman dinamis --}}
        @yield('content')
    </div>

    <!-- WhatsApp Chat Box -->
    <div id="waChatBox">
        <div style="text-align:center; margin-bottom: 15px;">
            <img src="/logo.png" style="max-height:50px;" alt="Logo">
            <h4 style="margin: 10px 0;">Hubungi Kami</h4>
        </div>
        <input type="text" id="waName" placeholder="Nama Anda" class="wa-input" required>
        <input type="text" id="waNumber" placeholder="Nomor WhatsApp (+62...)" class="wa-input" required>
        <textarea id="waMessage" placeholder="Pesan Anda..." class="wa-textarea"></textarea>
        <button onclick="sendToWhatsapp()" class="wa-button">Kirim via WhatsApp</button>
    </div>

    <div id="waChatToggle" onclick="toggleWAChat()">💬</div>

    <script>
        function toggleWAChat() {
            const box = document.getElementById('waChatBox');
            box.style.display = (box.style.display === 'none' || box.style.display === '') ? 'block' : 'none';
        }

        function sendToWhatsapp() {
            const adminPhone = "6281352363661";
            const name = document.getElementById("waName").value.trim();
            const userPhone = document.getElementById("waNumber").value.trim();
            const message = document.getElementById("waMessage").value.trim();

            if (!name || !userPhone || !message) {
                alert("Harap isi semua kolom sebelum mengirim.");
                return;
            }

            const finalMessage = `Halo Admin, saya ${name} (${userPhone}). Saya ingin bertanya: ${message}`;
            const waUrl = `https://wa.me/${adminPhone}?text=${encodeURIComponent(finalMessage)}`;
            window.open(waUrl, "_blank");
        }
    </script>

</body>
</html>

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
            background-color: #007bff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            border-radius: 8px;
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        th {
            background-color: #e9ecef;
        }

        input, textarea, button {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            max-width: 500px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        h2 {
            color: #343a40;
        }

        .alert {
            padding: 10px 15px;
            background-color: #d4edda;
            color: #155724;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
        }

        /* WhatsApp Chat Box Styles */
        #waChatBox {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 300px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            padding: 20px;
            z-index: 9999;
            display: none;
        }
        #waChatToggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #25d366;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            text-align: center;
            line-height: 50px;
            font-size: 24px;
            cursor: pointer;
            z-index: 9999;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div>
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ route('products.index') }}">Produk</a>
            <a href="{{ url('/cart') }}">Keranjang</a>
            <a href="{{ route('admin.dashboard') }}">Admin</a>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- WhatsApp Chat Box -->
    <div id="waChatBox">
        <div style="text-align:center;">
            <img src="/logo.png" style="max-height:50px;" alt="Logo">
            <h4>Hubungi Kami</h4>
        </div>
        <input type="text" id="waName" placeholder="Nama" required style="width:100%;margin:5px 0;">
        <input type="text" id="waNumber" placeholder="Nomor WhatsApp" value="+62" required style="width:100%;margin:5px 0;">
        <textarea id="waMessage" placeholder="Pesan" style="width:100%;margin:5px 0;"></textarea>
        <button onclick="sendToWhatsapp()" style="width:100%;background:#25d366;color:white;border:none;padding:10px;margin-top:10px;">Kirim di WhatsApp</button>
    </div>

    <div id="waChatToggle" onclick="toggleWAChat()">💬</div>

    <script>
    function toggleWAChat() {
        const box = document.getElementById('waChatBox');
        box.style.display = box.style.display === 'none' ? 'block' : 'none';
    }
    function sendToWhatsapp() {
        const adminPhone = "081339344311"; // Ganti dengan nomor admin
        const name = document.getElementById("waName").value;
        const userPhone = document.getElementById("waNumber").value;
        const message = document.getElementById("waMessage").value;

        const finalMessage = `Halo Admin, saya ${name} (${userPhone}). Saya ingin bertanya: ${message}`;
        const waUrl = `https://wa.me/${adminPhone}?text=${encodeURIComponent(finalMessage)}`;
        window.open(waUrl, "_blank");
    }
    </script>
</body>
</html>

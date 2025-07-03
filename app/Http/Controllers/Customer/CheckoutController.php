<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->withErrors('Keranjang kosong.');
        }

        $name = $request->name;
        $total = 0;
        $message = "*Pesanan Bunga dari $name:*\n\n";

        foreach ($cart as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;

            $message .= "- {$item['name']} (x{$item['quantity']}) - Rp " . number_format($subtotal, 0, ',', '.') . "\n";
        }

        $message .= "\n*Total: Rp " . number_format($total, 0, ',', '.') . "*";

        // Nomor WhatsApp tujuan — ganti dengan nomor Anda (format internasional tanpa +)
        $whatsappNumber = "6281234567890"; // <-- ganti dengan nomor WA tujuan
        $whatsappLink = "https://wa.me/$whatsappNumber?text=" . urlencode($message);

        // Bersihkan keranjang setelah checkout
        session()->forget('cart');

        return redirect()->away($whatsappLink);
    }
}

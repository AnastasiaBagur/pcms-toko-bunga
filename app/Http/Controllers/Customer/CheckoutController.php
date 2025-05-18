<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total' => 'required|numeric',
        ]);

        $cart = session()->get('cart', []);
        if (!$cart) {
            return redirect('/cart')->withErrors('Keranjang kosong.');
        }

        // Buat transaksi baru
        $transaction = Transaction::create([
            'customer_name' => $request->name,
            'total_price' => $request->total,
            'payment_status' => 'Paid',
        ]);

        // Simpan detail transaksi
        foreach ($cart as $item) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Bersihkan keranjang
        session()->forget('cart');

        return redirect('/')->with('success', 'Pembayaran berhasil, terima kasih!');
    }
}

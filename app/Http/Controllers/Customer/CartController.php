<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Tambah produk ke keranjang (session)
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        // Cek produk sudah ada di cart, jika ada update qty
        $found = false;
        foreach ($cart as &$item) {
            if ($item['product_id'] == $request->product_id) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $cart[] = [
                'product_id' => $request->product_id,
                'quantity' => 1,
                'price' => $request->price,
            ];
        }

        session()->put('cart', $cart);

        return redirect('/cart')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    // Tampilkan halaman keranjang
    public function view()
    {
        $cart = session()->get('cart', []);
        return view('customer.cart', compact('cart'));
    }
}

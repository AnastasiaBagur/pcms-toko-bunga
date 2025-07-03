<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Tambahkan produk ke keranjang
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'image'      => $product->image,
                'price'      => $product->price,
                'quantity'   => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Tampilkan halaman keranjang
     */
    public function view()
    {
        $cart = session()->get('cart', []);
        return view('cart.view', compact('cart')); // ✅ GANTI INI agar sesuai dengan blade: resources/views/cart/view.blade.php
    }

    /**
     * Hapus item dari keranjang
     */
    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.view')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    /**
     * Kosongkan seluruh keranjang
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.view')->with('success', 'Keranjang berhasil dikosongkan.');
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Tampilkan semua produk kepada customer.
     */
    public function index()
    {
        $products = Product::all();
        return view('customer.products', compact('products'));
    }
}

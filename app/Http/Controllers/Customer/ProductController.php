<?php
namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    // Tampilkan semua produk untuk customer
    public function index()
    {
        $products = Product::all();
        return view('customer.products', compact('products'));
    }
}

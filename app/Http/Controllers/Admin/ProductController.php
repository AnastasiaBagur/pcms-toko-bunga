<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        // Jika ada parameter pencarian
        if ($query) {
            $products = Product::where('name', 'like', '%' . $query . '%')->get();
        } else {
            $products = Product::all();
        }

        return view('admin.products.index', compact('products', 'query'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('name', 'description', 'price', 'stock');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['image'] = $filename;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->only('name', 'description', 'price', 'stock');

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path('uploads/' . $product->image))) {
                unlink(public_path('uploads/' . $product->image));
            }

            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['image'] = $filename;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && file_exists(public_path('uploads/' . $product->image))) {
            unlink(public_path('uploads/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}

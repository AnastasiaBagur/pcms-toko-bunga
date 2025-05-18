@extends('layouts.app')

@section('content')
<h2>Edit Produk</h2>
<form method="POST" action="{{ route('admin.products.update', $product->id) }}">
    @csrf 
    @method('PUT')
    <input type="text" name="name" value="{{ $product->name }}">
    <textarea name="description">{{ $product->description }}</textarea>
    <input type="number" name="price" value="{{ $product->price }}">
    <input type="number" name="stock" value="{{ $product->stock }}">
    <input type="text" name="image" value="{{ $product->image }}">
    <button type="submit">Update</button>
</form>
@endsection

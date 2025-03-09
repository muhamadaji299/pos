@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Kategori</label>
            <select name="category_id" class="form-control">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control" value="{{ $product->nama }}">
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $product->harga }}">
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $product->stok }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection



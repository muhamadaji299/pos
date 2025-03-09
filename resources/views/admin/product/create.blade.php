@extends('admin.layout')
@section('content')
<h1>Tambah Produk</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
    <label>Kategori</label>
    <select name="category_id" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control">
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control">
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection

@extends('admin.layout')
 @section('header')
     <div class="container mt-4">
        <h2>Kelola Product</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
 @endsection
@section('content')
  <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->nama }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->harga }}</td>
                    <td>{{ $product->stok }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
@endsection

@extends('kasir.layout')

@section('header')
    <div class="container mt-4">
        <h1>Pilih Produk</h1>
        <p>Silakan pilih produk untuk ditambahkan ke transaksi.</p>
    </div>
@endsection    

@section('content')
    <div class="row">
        @foreach ($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nama }}</h5>
                        <p class="card-text">Kategori: {{ $product->category->name }}</p>
                        <p class="card-text fw-bold text-primary">Rp {{ number_format($product->harga) }}</p>
                        <p class="card-text">Stok: <span class="badge bg-primary">{{ $product->stok }}</span></p>

                        <form action="{{ route('kasir.add_to_transaction', $product->id) }}" method="POST">
                            @csrf
                            <!-- Input untuk jumlah produk -->
                            <div class="mb-2">
                                <label for="quantity_{{ $product->id }}" class="form-label">Jumlah</label>
                                <input type="number" name="quantity" id="quantity_{{ $product->id }}" class="form-control" min="1" max="{{ $product->stok }}" value="1" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Tambah ke Transaksi</button>
                        </form>
                      

                    </div>
               
                </div>
            </div>
        @endforeach 
              <a href="/kasir/products/transaksi_detail" class="btn btn-success btn-sm">Masuk Ke Halaman Detail Transaksi</a>
    </div>
@endsection

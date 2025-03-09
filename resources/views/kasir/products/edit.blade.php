@extends('kasir.layout')

@section('header')
    <div class="container mt-4">
        <h1>Edit Jumlah Produk</h1>
    </div>
@endsection    

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('kasir.products.update', $detail->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah Produk</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" 
                               value="{{ $detail->quantity }}" min="1" max="{{ $detail->quantity + $detail->product->stok }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('kasir.products.transaksi_detail') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection

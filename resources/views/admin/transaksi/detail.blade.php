@extends('admin.layout')
 @section('header')
 <div class="container mt-4">
    <h2 class="mb-4 text-center">Daftar Transaksi</h2>

 @endsection
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Detail Transaksi</h2>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Invoice: {{ $transaction->invoice_number }}</h5>
            <p><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
            <p><strong>Tanggal:</strong> {{ $transaction->created_at }}</p>
       
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
</div>
        <table class="table mt-3">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactionDetails as $detail)
            <tr>
                <td>{{ $detail->product->nama }}</td>
                <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    

  
</div>
@endsection
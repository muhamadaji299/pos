@extends('kasir.layout')
@section('header')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Detail Transaksi</h2>
    @endsection

    @section('content')
    <div class="card">
        <div class="card-body">
            <h5>Nomor Invoice: {{ $transaction->invoice_number }}</h5>
            <h5>Total Harga: Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</h5>
        </div>
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactionDetails as $detail)
            <tr>
                <td>{{ $detail->product->nama }}</td>
                <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('kasir.products.edit', $detail->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('kasir.remove_product', $detail->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>

                    <form action="{{ route('kasir.complete_transaction', $transaction->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin menyelesaikan transaksi ini?');">
                            Selesaikan
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
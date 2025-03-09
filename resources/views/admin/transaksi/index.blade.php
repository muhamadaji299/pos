@extends('admin.layout')

@section('header')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Daftar Transaksi</h2>
</div>
@endsection

@section('content')
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $index => $transaction)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaction->invoice_number }}</td>
                    <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>

                    <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('transactions.detail', $transaction->id) }}" class="btn btn-sm btn-info">Detail</a>

                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada transaksi yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

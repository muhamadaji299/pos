@extends('admin.layout')

@section('header')
<div class="container">
    <h2>Laporan Transaksi</h2>
@endsection

@section('content')


    <!-- Filter Laporan -->
    <form method="GET" action="{{ route('admin.laporan.index') }}">
        <div class="row mb-3">
            <!-- Filter Harian -->
            <div class="col-md-4">
                <label for="tanggal">Pilih Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}">
            </div>

            <!-- Filter Bulanan -->
            <div class="col-md-3">
                <label for="bulan">Pilih Bulan:</label>
                <select name="bulan" class="form-control">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $i, 10)) }}
                        </option>
                    @endfor
                </select>
            </div>

            <!-- Filter Tahun -->
            <div class="col-md-3">
                <label for="tahun">Pilih Tahun:</label>
                <input type="number" name="tahun" class="form-control" value="{{ $tahun }}">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary mt-4">Filter</button>
            </div>
        </div>
    </form>

    <!-- Laporan Harian -->
    <h4 class="mt-4">Laporan Harian ({{ $tanggal }})</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactionsHarian as $key => $transaction)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $transaction->invoice_number }}</td>
                    <td>Rp {{ number_format($transaction->total_price) }}</td>
                    <td>{{ $transaction->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada transaksi untuk hari ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Laporan Bulanan -->
    <h4 class="mt-4">Laporan Bulanan ({{ date('F', mktime(0, 0, 0, $bulan, 10)) }} {{ $tahun }})</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactionsBulanan as $key => $transaction)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $transaction->invoice_number }}</td>
                    <td>Rp {{ number_format($transaction->total_price) }}</td>
                    <td>{{ $transaction->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada transaksi untuk bulan ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal hari ini & bulan ini sebagai default
        $tanggal = $request->input('tanggal', Carbon::now()->toDateString());
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);

        // Ambil transaksi berdasarkan tanggal (harian)
        $transactionsHarian = Transaction::whereDate('created_at', $tanggal)->get();

        // Ambil transaksi berdasarkan bulan & tahun (bulanan)
        $transactionsBulanan = Transaction::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->get();

        return view('admin.laporan.index', compact('transactionsHarian', 'transactionsBulanan', 'tanggal', 'bulan', 'tahun'));
    }
}

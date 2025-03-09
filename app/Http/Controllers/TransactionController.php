<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->get();
        return view('admin.transaksi.index', compact('transactions'));
    }

    public function store(Request $request)
    {
        // Buat transaksi baru dengan nomor unik & status default 'pending'
        $transaction = Transaction::create([
            'user_id' => Auth::id(), 
            'invoice_number' => 'INV-' . date('Ymd') . '-' . Str::random(6),
            'total_price' => 0,
            'status' => 'pending'  // Tambahkan status default
        ]);

        return redirect()->route('transactions.show', $transaction->id)
                         ->with('success', 'Transaksi berhasil dibuat!');
    }

    public function show($id)
    {
        // Ambil transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Ambil detail transaksi yang berelasi dengan transaksi ini
        $transactionDetails = TransactionDetail::where('transaction_id', $id)->get();

        // Kirim data ke view
        return view('admin.transaksi.detail', compact('transaction', 'transactionDetails'));
    }

   
    public function destroy($id)
    {
        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Hapus semua detail transaksi terkait
        TransactionDetail::where('transaction_id', $transaction->id)->delete();

        // Hapus transaksi utama
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}

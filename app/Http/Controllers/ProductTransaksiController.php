<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class ProductTransaksiController extends Controller
{
    // Menampilkan daftar produk di halaman kasir
    public function index()
    {
        $products = Product::all();
        return view('kasir.products.index', compact('products'));
    }

    // Menambahkan produk ke transaksi detail dengan jumlah input
    public function addToTransaction(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Validasi input jumlah
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stok,
        ]);

        $quantity = $request->input('quantity');

        // Cek transaksi aktif
        $transaction = Transaction::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        // Jika belum ada transaksi, buat yang baru
        if (!$transaction) {
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'invoice_number' => 'INV-' . date('YmdHis'),
                'total_price' => 0,
                'status' => 'pending'
            ]);
        }

        // Cek apakah produk sudah ada di transaction_details
        $detail = TransactionDetail::where('transaction_id', $transaction->id)
            ->where('product_id', $product->id)
            ->first();

        if ($detail) {
            // Jika produk sudah ada, update jumlah dan subtotal
            $detail->increment('quantity', $quantity);
            $detail->increment('subtotal', $product->harga * $quantity);
        } else {
            // Jika produk belum ada, tambahkan baru
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->harga,
                'subtotal' => $product->harga * $quantity
            ]);
        }

        // Update total transaksi
        $transaction->increment('total_price', $product->harga * $quantity);

        // Kurangi stok produk
        $product->decrement('stok', $quantity);

        return redirect()->route('kasir.products.transaksi_detail')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function editProduct($detailId)
{
    // Ambil detail transaksi berdasarkan ID
    $detail = TransactionDetail::findOrFail($detailId);
    
    return view('kasir.products.edit', compact('detail'));
}

public function updateProduct(Request $request, $detailId)
{
    // Ambil detail transaksi dan produk terkait
    $detail = TransactionDetail::findOrFail($detailId);
    $product = Product::findOrFail($detail->product_id);
    $transaction = Transaction::findOrFail($detail->transaction_id);

    // Validasi input jumlah
    $request->validate([
        'quantity' => ['required', 'integer', 'min:1', 'max:' . ($detail->quantity + $product->stok)],
    ]);

    $newQuantity = $request->input('quantity');
    $oldQuantity = $detail->quantity;

    // Update stok produk
    if ($newQuantity > $oldQuantity) {
        // Jika jumlah ditambah, kurangi stok
        $product->decrement('stok', $newQuantity - $oldQuantity);
    } elseif ($newQuantity < $oldQuantity) {
        // Jika jumlah dikurangi, kembalikan stok
        $product->increment('stok', $oldQuantity - $newQuantity);
    }

    // Update detail transaksi
    $detail->update([
        'quantity' => $newQuantity,
        'subtotal' => $newQuantity * $product->harga
    ]);

    // Update total transaksi
    $newTotal = TransactionDetail::where('transaction_id', $transaction->id)->sum('subtotal');
    $transaction->update(['total_price' => $newTotal]);

    return redirect()->route('kasir.products.transaksi_detail')->with('success', 'Jumlah produk berhasil diperbarui!');
}


    // Menampilkan detail transaksi
    public function showTransaction()
    {
        $transaction = Transaction::where('user_id', Auth::id())->where('status', 'pending')->first();

        if (!$transaction) {
            return redirect()->route('kasir.products.index')->with('error', 'Belum ada transaksi!');
        }

        $transactionDetails = TransactionDetail::where('transaction_id', $transaction->id)->get();

        return view('kasir.products.transaksi_detail', compact('transaction', 'transactionDetails'));
    }

    // Menghapus produk dari transaksi detail
    public function removeProduct($detailId)
    {
        $detail = TransactionDetail::findOrFail($detailId);
        $transaction = Transaction::find($detail->transaction_id);

        // Kembalikan stok produk
        $product = Product::find($detail->product_id);
        if ($product) {
            $product->increment('stok', $detail->quantity);
        }

        // Kurangi total harga transaksi
        $transaction->decrement('total_price', $detail->subtotal);

        // Hapus produk dari transaksi
        $detail->delete();

        return redirect()->route('kasir.products.transaksi_detail')->with('success', 'Produk dihapus dari transaksi!');
    }
    public function completeTransaction($id)
{
    $transaction = Transaction::findOrFail($id);

    // Pastikan transaksi masih pending sebelum diubah
    if ($transaction->status === 'pending') {
        $transaction->update([
            'status' => 'completed',
            'completed_at' => now() // Menyimpan waktu selesai transaksi
        ]);
    }

    return redirect()->route('kasir.products.index')->with('success', 'Transaksi berhasil diselesaikan!');
}

}

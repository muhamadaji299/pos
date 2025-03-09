<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'invoice_number', 'total_price'];

    // Relasi ke TransactionDetail (One-to-Many)
    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }

    // Relasi ke User (Many-to-One)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

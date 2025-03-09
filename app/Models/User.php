<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kolom yang bisa diisi
    protected $fillable = ['name', 'email', 'password', 'role'];

    // Menyembunyikan password dari JSON response
    protected $hidden = ['password', 'remember_token'];

    // Cast untuk format data tertentu
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Fungsi untuk cek apakah user adalah admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Fungsi untuk cek apakah user adalah kasir
    public function isKasir()
    {
        return $this->role === 'kasir';
    }
}

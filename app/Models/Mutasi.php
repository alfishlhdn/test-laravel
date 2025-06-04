<?php

namespace App\Models;

use App\Models\User;
use App\Models\ProdukLokasi;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $fillable = ['produk_lokasi_id', 'user_id', 'tanggal', 'jenis_mutasi', 'jumlah', 'keterangan'];

    public function produkLokasi()
    {
        return $this->belongsTo(ProdukLokasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

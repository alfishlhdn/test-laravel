<?php

namespace App\Models;

use App\Models\Produk;
use App\Models\ProdukLokasi;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $fillable = ['kode_lokasi', 'nama_lokasi'];

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'produk_lokasis')
            ->withPivot('stok')
            ->withTimestamps();
    }

    public function produkLokasi()
    {
        return $this->hasMany(ProdukLokasi::class);
    }
}


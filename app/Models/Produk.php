<?php

namespace App\Models;

use App\Models\Lokasi;
use App\Models\ProdukLokasi;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama_produk', 'kode_produk', 'kategori', 'satuan'];

    public function lokasi()
    {
        return $this->belongsToMany(Lokasi::class, 'produk_lokasis')
            ->withPivot('stok')
            ->withTimestamps();
    }

    public function produkLokasi()
    {
        return $this->hasMany(ProdukLokasi::class);
    }
}

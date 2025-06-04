<?php

namespace App\Models;

use App\Models\Lokasi;
use App\Models\Mutasi;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;

class ProdukLokasi extends Model
{
    protected $table = 'produk_lokasis';
    protected $fillable = ['produk_id', 'lokasi_id', 'stok'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function mutasi()
    {
        return $this->hasMany(Mutasi::class);
    }
}

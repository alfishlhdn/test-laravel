<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdukLokasiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'produk_id' => $this->produk_id,
            'nama_produk' => $this->produk->nama_produk ?? null,
            'lokasi_id' => $this->lokasi_id,
            'nama_lokasi' => $this->lokasi->nama_lokasi ?? null,
            'stok' => $this->stok,
        ];
    }
}

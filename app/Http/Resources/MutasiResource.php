<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MutasiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'nama' => $this->user->name  ?? null,
            'produk_lokasi_id' => $this->produk_lokasi_id,
            'nama_lokasi' => $this->produkLokasi->lokasi->nama_lokasi ?? null,
            'nama_produk' => $this->produkLokasi->produk->nama_produk ?? null,
            'jumlah' => $this->jumlah,
            'tanggal' => $this->tanggal,
            'keterangan' => $this->keterangan,
            'jenis_mutas' => $this->jenis_mutasi,
        ];
    }
}

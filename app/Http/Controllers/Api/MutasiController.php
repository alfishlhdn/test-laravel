<?php

namespace App\Http\Controllers\Api;

use App\Models\Mutasi;
use App\Models\ProdukLokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MutasiResource;

class MutasiController extends Controller
{
    public function index()
    {
        $data = Mutasi::with(['user', 'produkLokasi.produk', 'produkLokasi.lokasi'])->get();

        return response()->json([
            'success' => true,
            'data' => MutasiResource::collection($data)
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'produk_lokasi_id' => 'required|exists:produk_lokasis,id',
        'jumlah' => 'required|integer|min:1',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable|string',
        'jenis_mutasi' => 'required|in:masuk,keluar',
    ]);

    $produkLokasi = ProdukLokasi::findOrFail($request->produk_lokasi_id);

    if ($request->jenis_mutasi === 'keluar') {
        if ($produkLokasi->stok < $request->jumlah) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak cukup untuk mutasi keluar'
            ], 400);
        }
        $produkLokasi->stok -= $request->jumlah;
    } else {
        $produkLokasi->stok += $request->jumlah;
    }

    $produkLokasi->save();

    $mutasi = Mutasi::create([
        'user_id' => $request->user_id,
        'produk_lokasi_id' => $request->produk_lokasi_id,
        'jumlah' => $request->jumlah,
        'tanggal' => $request->tanggal,
        'keterangan' => $request->keterangan,
        'jenis_mutasi' => $request->jenis_mutasi,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Mutasi berhasil disimpan dan stok diperbarui',
        'data' => new MutasiResource($mutasi->load(['user', 'produkLokasi.produk', 'produkLokasi.lokasi']))
    ]);
}

    public function show(string $id)
    {
        $mutasi = Mutasi::with(['user', 'produkLokasi.produk', 'produkLokasi.lokasi'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => new MutasiResource($mutasi)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'produk_lokasi_id' => 'required|exists:produk_lokasis,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'jenis_mutasi' => 'required|in:masuk,keluar',
        ]);

        $mutasi = Mutasi::findOrFail($id);
        $produkLokasi = ProdukLokasi::findOrFail($request->produk_lokasi_id);

        if ($mutasi->jenis_mutasi === 'keluar') {
            $produkLokasi->stok += $mutasi->jumlah;
        } else {
            $produkLokasi->stok -= $mutasi->jumlah;
        }

        if ($request->jenis_mutasi === 'keluar') {
            if ($produkLokasi->stok < $request->jumlah) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak cukup untuk mutasi keluar'
                ], 400);
            }
            $produkLokasi->stok -= $request->jumlah;
        } else {
            $produkLokasi->stok += $request->jumlah;
        }

        $produkLokasi->save();

        $mutasi->update([
            'user_id' => $request->user_id,
            'produk_lokasi_id' => $request->produk_lokasi_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'jenis_mutasi' => $request->jenis_mutasi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mutasi berhasil diperbarui dan stok disesuaikan',
            'data' => new MutasiResource($mutasi->load(['user', 'produkLokasi.produk', 'produkLokasi.lokasi']))
        ]);
    }


    /**
     * History mutasi berdasarkan produk
     */
    public function historyByProduk($produkId)
    {
        $data = Mutasi::with(['user', 'produkLokasi.lokasi', 'produkLokasi.produk'])
            ->whereHas('produkLokasi', function($query) use ($produkId) {
                $query->where('produk_id', $produkId);
            })->get();

        return response()->json([
            'success' => true,
            'data' => MutasiResource::collection($data),
        ]);
    }

    /**
     * History mutasi berdasarkan user
     */
    public function historyByUser($userId)
    {
        $data = Mutasi::with(['produkLokasi.lokasi', 'produkLokasi.produk'])
            ->where('user_id', $userId)
            ->get();

        return response()->json([
            'success' => true,
            'data' => MutasiResource::collection($data),
        ]);
    }
}

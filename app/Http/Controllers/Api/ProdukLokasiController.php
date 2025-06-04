<?php

namespace App\Http\Controllers\Api;

use App\Models\Lokasi;
use App\Models\Produk;
use App\Models\ProdukLokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukLokasiResource;

class ProdukLokasiController extends Controller
{
    /**
     * Tampilkan semua data relasi produk-lokasi lengkap dengan nama produk & lokasi.
     */
    public function index()
    {
        $data = ProdukLokasi::with(['produk', 'lokasi'])->get();

        return response()->json([
            'success' => true,
            'data' => ProdukLokasiResource::collection($data)
        ]);
    }

    /**
     * Tambahkan produk ke lokasi tertentu.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'stok' => 'nullable|integer'
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $produk->lokasi()->attach($request->lokasi_id, [
            'stok' => $request->stok ?? 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke lokasi'
        ]);
    }

    /**
     * Tampilkan semua produk di lokasi tertentu.
     */
    public function show(string $id)
    {
        $produklokasi = ProdukLokasi::find($id);

        if (!$produklokasi) {
            return response()->json([
                'success' => false,
                'message' => 'ProdukLokasi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $produklokasi
        ]);
    }

    /**
     * Update stok produk di lokasi tertentu.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'stok' => 'required|integer'
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->produks()->updateExistingPivot($request->produk_id, [
            'stok' => $request->stok
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Stok berhasil diperbarui di lokasi'
        ]);
    }

    /**
     * Hapus relasi produk dari lokasi.
     */
    public function destroy(Request $request, string $id)
    {
        $produklokasi = ProdukLokasi::find($id);

        if (!$produklokasi) {
            return response()->json([
                'success' => false,
                'message' => 'ProdukLokasi tidak ditemukan'
            ], 404);
        }

        $produklokasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'ProdukLokasi berhasil dihapus'
        ]);
    }
}

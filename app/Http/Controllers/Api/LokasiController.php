<?php

namespace App\Http\Controllers\Api;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasi = Lokasi::all();
        return response()->json([
            'success' => true,
            'data' => $lokasi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_lokasi' => 'required|string|max:255',
        ]);

        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ],422);
        }

        $namaKota = trim($request->nama_lokasi);
        $namaKotaClean = preg_replace('/[^A-Za-z0-9]+/', '-', strtolower($namaKota));
        $kodeLokasi = 'LOC-' . strtoupper($namaKotaClean);

        $lokasi = Lokasi::create([
            'kode_lokasi' => $kodeLokasi,
            'nama_lokasi' => $namaKota,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lokasi berhasil dibuat',
            'data' => $lokasi
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lokasi = Lokasi::find($id);

        if (!$lokasi) {
            return response()->json([
                'success' => false,
                'message' => 'Lokasi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $lokasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lokasi = Lokasi::find($id);

        if (!$lokasi) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(),[
            'nama_lokasi' => 'required|string|max:255',
        ]);

        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ],422);
        }

        $namaKota = trim($request->nama_lokasi);
        $namaKotaClean = preg_replace('/[^A-Za-z0-9]+/', '-', strtolower($namaKota));
        $kodeLokasi = 'LOC-' . strtoupper($namaKotaClean);

        $lokasi->update([
            'kode_lokasi' => $kodeLokasi,
            'nama_lokasi' => $namaKota,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lokasi berhasil dibuat',
            'data' => $lokasi
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lokasi = Lokasi::find($id);

        if (!$lokasi) {
            return response()->json([
                'success' => false,
                'message' => 'Lokasi tidak ditemukan'
            ], 404);
        }

        $lokasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lokasi berhasil dihapus'
        ]);
    }
}

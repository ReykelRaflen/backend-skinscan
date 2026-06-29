<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Riwayat;
use App\Models\Rekomendasi;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $riwayat = Riwayat::with('rekomendasi')
            ->where('user_id', $request->user()->id)
            ->orderBy('tgl_analisis', 'desc')
            ->get();

        return response()->json(['success' => true, 'data' => $riwayat]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'hasil_label' => 'required|string',
            'skor_akurasi' => 'required|numeric',
            'path_gambar' => 'required|image|max:4096',
            'all_scores' => 'nullable',
            'catatan' => 'nullable|string',
        ]);

        $rekomendasi = Rekomendasi::where('label_kulit', $request->hasil_label)->first();

        $path_gambar = null;
        if ($request->hasFile('path_gambar')) {
            $path = $request->file('path_gambar')->store('riwayats', 'public');
            $path_gambar = asset('storage/' . $path);
        }

        $riwayat = Riwayat::create([
            'user_id' => $request->user()->id,
            'rekomendasi_id' => $rekomendasi?->id,
            'tgl_analisis' => now(),
            'hasil_label' => $request->hasil_label,
            'skor_akurasi' => $request->skor_akurasi,
            'path_gambar' => $path_gambar,
            'all_scores' => is_string($request->all_scores) ? json_decode($request->all_scores, true) : $request->all_scores,
            'catatan' => $request->catatan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Riwayat berhasil disimpan',
            'data' => $riwayat->load('rekomendasi')
        ], 201);
    }

    public function destroy(Request $request, $id)
    {
        $riwayat = Riwayat::where('id', $id)->where('user_id', $request->user()->id)->first();

        if (!$riwayat) {
            return response()->json(['success' => false, 'message' => 'Riwayat tidak ditemukan'], 404);
        }

        $riwayat->delete();
        return response()->json(['success' => true, 'message' => 'Riwayat berhasil dihapus']);
    }
}

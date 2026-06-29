<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class AdminRiwayatController extends Controller
{
    public function index()
    {
        // Mengambil semua riwayat analisis pengguna dengan pagination (15 data per halaman)
        $riwayats = Riwayat::with(['user', 'rekomendasi'])
            ->orderBy('tgl_analisis', 'desc')
            ->paginate(15);

        return view('admin.riwayat.index', compact('riwayats'));
    }

    public function destroy($id)
    {
        $riwayat = Riwayat::findOrFail($id);
        $riwayat->delete();

        return redirect()->route('admin.riwayat.index')->with('success', 'Laporan analisis berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Riwayat;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalScan = Riwayat::count();

        // Mencari kondisi kulit yang paling sering terdeteksi
        $kondisiSering = Riwayat::select('hasil_label')
            ->groupBy('hasil_label')
            ->orderByRaw('COUNT(*) DESC')
            ->first()?->hasil_label ?? '-';

        // Mengambil 10 data scan wajah terbaru
        $riwayats = Riwayat::with(['user', 'rekomendasi'])
            ->orderBy('tgl_analisis', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('totalUsers', 'totalScan', 'kondisiSering', 'riwayats'));
    }
}

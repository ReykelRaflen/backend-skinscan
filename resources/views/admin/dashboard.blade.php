@extends('layouts.admin')

@section('page_title', 'Dashboard Ringkasan')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-navy/5 rounded-xl flex items-center justify-center">
                <span class="text-2xl text-navy">👥</span>
            </div>
            <div>
                <p class="text-sm text-slate-400 font-medium">Total Pengguna</p>
                <h2 class="text-2xl font-bold text-navy mt-1">{{ $totalUsers }}</h2>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-gold/10 text-gold rounded-xl flex items-center justify-center text-2xl">📸</div>
            <div>
                <span class="text-sm text-slate-400 font-medium">Total Analisis Scan</span>
                <h2 class="text-2xl font-bold text-navy mt-1">{{ $totalScan }}</h2>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-2xl">✨</div>
            <div>
                <span class="text-sm text-slate-400 font-medium">Kondisi Sering Terdeteksi</span>
                <h2 class="text-2xl font-bold text-navy mt-1">{{ $kondisiSering }}</h2>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
        <h3 class="text-lg font-bold text-navy mb-6">10 Analisis Scan Terbaru</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="pb-3">Pengguna</th>
                        <th class="pb-3">Hasil Diagnosis</th>
                        <th class="pb-3">Skor Akurasi</th>
                        <th class="pb-3">Tanggal Analisis</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-sm">
                    @forelse ($riwayats as $r)
                    <tr>
                        <td class="py-4 font-semibold text-slate-700">{{ $r->user->nama ?? 'Pengguna Dihapus' }}</td>
                        <td class="py-4 text-navy">
                            <span class="px-3 py-1 bg-navy/5 text-navy font-bold rounded-lg">{{ $r->hasil_label }}</span>
                        </td>
                        <td class="py-4 text-gold font-bold">{{ number_format($r->skor_akurasi * 100, 1) }}%</td>
                        <td class="py-4 text-slate-400">{{ $r->tgl_analisis->format('d M Y, H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-slate-400">Belum ada riwayat analisis wajah.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
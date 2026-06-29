@extends('layouts.admin')

@section('page_title', 'Rekomendasi & Tips Kondisi Kulit')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <p class="text-sm text-slate-500">Kelola daftar kondisi kulit dan tips penanganan untuk pengguna.</p>
    <a href="{{ route('admin.rekomendasi.create') }}" class="px-5 py-3 bg-navy hover:bg-navy/90 text-white rounded-xl text-sm font-bold transition flex items-center gap-2 shadow-lg shadow-navy/10">
        + Tambah Rekomendasi
    </a>
</div>

@if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl text-sm mb-6 border border-emerald-100">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                    <th class="pb-3">Kondisi Kulit (Label)</th>
                    <th class="pb-3">Tingkat Urgensi</th>
                    <th class="pb-3">Tips Perawatan</th>
                    <th class="pb-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-sm">
                @foreach ($rekomendasi as $rek)
                <tr>
                    <td class="py-4 font-bold text-navy">{{ $rek->label_kulit }}</td>
                    <td class="py-4">
                        <span class="px-3 py-1 font-bold rounded-lg text-xs 
                            {{ $rek->tingkat_urgensi === 'Tinggi' ? 'bg-rose-50 text-rose-600' : ($rek->tingkat_urgensi === 'Sedang' ? 'bg-amber-50 text-amber-600' : 'bg-emerald-50 text-emerald-600') }}">
                            {{ $rek->tingkat_urgensi }}
                        </span>
                    </td>
                    <td class="py-4 text-slate-500 max-w-sm truncate">{{ $rek->tips_perawatan }}</td>
                    <td class="py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.rekomendasi.edit', $rek->id) }}" class="px-4 py-2 bg-navy hover:bg-navy/90 text-white rounded-lg text-xs font-bold transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.rekomendasi.destroy', $rek->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rekomendasi untuk kulit {{ $rek->label_kulit }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg text-xs font-bold transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
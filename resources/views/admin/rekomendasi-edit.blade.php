@extends('layouts.admin')

@section('page_title', 'Edit Tips Rekomendasi: ' . $rekomendasi->label_kulit)

@section('content')
<div class="max-w-2xl bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
    <form action="{{ route('admin.rekomendasi.update', $rekomendasi->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-xs font-bold text-navy uppercase tracking-wider mb-2">Tingkat Urgensi</label>
            <select name="tingkat_urgensi" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-navy">
                <option value="Tinggi" {{ $rekomendasi->tingkat_urgensi === 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                <option value="Sedang" {{ $rekomendasi->tingkat_urgensi === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                <option value="Rendah" {{ $rekomendasi->tingkat_urgensi === 'Rendah' ? 'selected' : '' }}>Rendah</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-navy uppercase tracking-wider mb-2">Tips Perawatan</label>
            <textarea name="tips_perawatan" rows="5" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-navy" required>{{ $rekomendasi->tips_perawatan }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 bg-navy hover:bg-navy/95 text-white font-bold rounded-xl text-sm transition">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.rekomendasi') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-sm transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
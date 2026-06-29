@extends('layouts.admin')

@section('page_title', 'Tambah Rekomendasi Baru')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
    @if ($errors->any())
        <div class="bg-rose-50 text-rose-600 p-4 rounded-xl text-sm mb-6 border border-rose-100">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.rekomendasi.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-xs font-bold text-navy uppercase tracking-wider mb-2">Nama Kondisi Kulit (Label AI)</label>
            <input type="text" name="label_kulit" value="{{ old('label_kulit') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-navy" placeholder="Contoh: Normal, Oily, Dry, Acne" required>
            <p class="text-xs text-slate-400 mt-2">Pastikan nama label ini sama persis dengan klasifikasi keluaran model AI di Flutter.</p>
        </div>
        <div>
            <label class="block text-xs font-bold text-navy uppercase tracking-wider mb-2">Tingkat Urgensi</label>
            <select name="tingkat_urgensi" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-navy">
                <option value="Rendah" {{ old('tingkat_urgensi') === 'Rendah' ? 'selected' : '' }}>Rendah (Hijau)</option>
                <option value="Sedang" {{ old('tingkat_urgensi') === 'Sedang' ? 'selected' : '' }}>Sedang (Kuning)</option>
                <option value="Tinggi" {{ old('tingkat_urgensi') === 'Tinggi' ? 'selected' : '' }}>Tinggi (Merah)</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-bold text-navy uppercase tracking-wider mb-2">Tips Perawatan</label>
            <textarea name="tips_perawatan" rows="5" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-navy" placeholder="Tuliskan tips penanganan kulit di sini..." required>{{ old('tips_perawatan') }}</textarea>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 bg-navy text-white font-bold rounded-xl text-sm transition hover:bg-opacity-95">
                Tambah Rekomendasi
            </button>
            <a href="{{ route('admin.rekomendasi.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-sm transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
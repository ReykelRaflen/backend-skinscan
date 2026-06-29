@extends('layouts.admin')

@section('page_title', 'Edit Pengguna: ' . $user->nama)

@section('content')
<div class="max-w-2xl bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
    @if ($errors->any())
        <div class="bg-rose-50 text-rose-600 p-4 rounded-xl text-sm mb-6 border border-rose-100">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-xs font-bold text-navy uppercase tracking-wider mb-2">Nama Lengkap</label>
            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-navy" required>
        </div>
        <div>
            <label class="block text-xs font-bold text-navy uppercase tracking-wider mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-navy" required>
        </div>
        <div>
            <label class="block text-xs font-bold text-navy uppercase tracking-wider mb-2">Password Baru (Kosongkan jika tidak ingin diubah)</label>
            <input type="password" name="password" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-navy">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-navy uppercase tracking-wider mb-2">Usia</label>
                <input type="number" name="usia" value="{{ old('usia', $user->usia) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-navy">
            </div>
            <div>
                <label class="block text-xs font-bold text-navy uppercase tracking-wider mb-2">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-navy">
                    <option value="">Pilih</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>
        <div>
            <label class="block text-xs font-bold text-navy uppercase tracking-wider mb-2">Hak Akses (Role)</label>
            <select name="role" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-navy">
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User (Aplikasi Mobile)</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin (Web Dashboard)</option>
            </select>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 bg-navy text-white font-bold rounded-xl text-sm transition hover:bg-opacity-95">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-sm transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
@extends('layouts.admin')

@section('page_title', 'Manajemen Pengguna')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <p class="text-sm text-slate-500">Kelola data administrator dan pengguna aplikasi SkinScan AI.</p>
        <a href="{{ route('admin.users.create') }}"
            class="px-5 py-3 bg-navy hover:bg-navy/90 text-white rounded-xl text-sm font-bold transition flex items-center gap-2 shadow-lg shadow-navy/10">
            + Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl text-sm mb-6 border border-emerald-100">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-rose-50 text-rose-600 p-4 rounded-xl text-sm mb-6 border border-rose-100">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="pb-3">Foto</th>
                        <th class="pb-3">Nama</th>
                        <th class="pb-3">Email</th>
                        <th class="pb-3">Jenis Kelamin</th>
                        <th class="pb-3">Role</th>
                        <th class="pb-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-sm">
                    @foreach ($users as $u)
                        <tr>
                            <td class="py-4">
                                <img src="{{ $u->foto_profile ?? 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}"
                                    class="w-10 h-10 rounded-full object-cover border border-slate-200" alt="Avatar">
                            </td>
                            <td class="py-4 font-semibold text-navy">
                                {{ $u->nama }}
                                @if($u->usia > 0) <span class="text-xs text-slate-400 font-normal">({{ $u->usia }} th)</span>
                                @endif
                            </td>
                            <td class="py-4 text-slate-500">{{ $u->email }}</td>
                            <td class="py-4 text-slate-500">{{ $u->jenis_kelamin ?? '-' }}</td>
                            <td class="py-4">
                                <span
                                    class="px-3 py-1 font-bold rounded-lg text-xs {{ $u->role === 'admin' ? 'bg-gold/10 text-navy border border-gold/20' : 'bg-slate-100 text-slate-600' }}">
                                    {{ ucfirst($u->role) }}
                                </span>
                            </td>
                            <td class="py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $u->id) }}"
                                        class="px-4 py-2 bg-navy hover:bg-navy/90 text-white rounded-lg text-xs font-bold transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $u->nama }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg text-xs font-bold transition">
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
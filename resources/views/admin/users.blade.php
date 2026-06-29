@extends('layouts.admin')

@section('page_title', 'Daftar Pengguna Aktif')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                    <th class="pb-3">Foto</th>
                    <th class="pb-3">Nama</th>
                    <th class="pb-3">Email</th>
                    <th class="pb-3">Usia</th>
                    <th class="pb-3">Jenis Kelamin</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-sm">
                @foreach ($users as $u)
                <tr>
                    <td class="py-4">
                        <img src="{{ $u->foto_profile ?? asset('storage/default-avatar.png') }}" class="w-10 h-10 rounded-full object-cover border border-slate-200" alt="Avatar">
                    </td>
                    <td class="py-4 font-semibold text-navy">{{ $u->nama }}</td>
                    <td class="py-4 text-slate-500">{{ $u->email }}</td>
                    <td class="py-4 text-slate-500">{{ $u->usia > 0 ? $u->usia . ' tahun' : '-' }}</td>
                    <td class="py-4 text-slate-500">{{ $u->jenis_kelamin ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
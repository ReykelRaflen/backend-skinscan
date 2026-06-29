<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rekomendasi;
use Illuminate\Http\Request;

class AdminRekomendasiController extends Controller
{
    public function index()
    {
        $rekomendasi = Rekomendasi::all();
        return view('admin.rekomendasi.index', compact('rekomendasi'));
    }

    public function create()
    {
        return view('admin.rekomendasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label_kulit' => 'required|string|unique:rekomendasis,label_kulit|max:100',
            'tingkat_urgensi' => 'required|in:Tinggi,Sedang,Rendah',
            'tips_perawatan' => 'required|string'
        ], [
            'label_kulit.unique' => 'Kondisi kulit dengan label tersebut sudah ada.'
        ]);

        Rekomendasi::create([
            'label_kulit' => $request->label_kulit,
            'tingkat_urgensi' => $request->tingkat_urgensi,
            'tips_perawatan' => $request->tips_perawatan
        ]);

        return redirect()->route('admin.rekomendasi.index')->with('success', 'Rekomendasi berhasil dibuat.');
    }

    public function edit($id)
    {
        $rekomendasi = Rekomendasi::findOrFail($id);
        return view('admin.rekomendasi.edit', compact('rekomendasi'));
    }

    public function update(Request $request, $id)
    {
        $rekomendasi = Rekomendasi::findOrFail($id);

        $request->validate([
            'tingkat_urgensi' => 'required|in:Tinggi,Sedang,Rendah',
            'tips_perawatan' => 'required|string'
        ]);

        $rekomendasi->update([
            'tingkat_urgensi' => $request->tingkat_urgensi,
            'tips_perawatan' => $request->tips_perawatan
        ]);

        return redirect()->route('admin.rekomendasi.index')->with('success', 'Rekomendasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rekomendasi = Rekomendasi::findOrFail($id);
        $rekomendasi->delete();

        return redirect()->route('admin.rekomendasi.index')->with('success', 'Rekomendasi berhasil dihapus.');
    }
}
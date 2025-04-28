<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('content.kelas', compact('kelas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'lokasi' => 'required|string',
        ]);

        Kelas::create($request->all());

        return redirect()->back()->with('success', 'Ruang kuliah berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->back()->with('success', 'Ruang kuliah berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->back()->with('success', 'Ruang kuliah berhasil dihapus.');
    }



}

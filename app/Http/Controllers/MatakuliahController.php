<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makul;
use App\Models\Dosen;

class MatakuliahController extends Controller
{
    public function index()
    {
        $makul = Makul::with('dosen')->orderBy('semester', 'asc')->paginate(10);
        $dosen = Dosen::all();

        return view('content.makul', compact('makul', 'dosen'));
    }
    public function edit($id)
    {
        $makul = Makul::findOrFail($id);

        return view('makul.edit', compact('makul', 'dosen'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'jurusan' => 'required|in:TID,TIF,GAB',
            'semester' => 'required|integer',
            'id_dosen' => 'required|exists:dosen,id',
        ]);

        $makul = Makul::findOrFail($id);
        $makul->update([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'jurusan' => $request->jurusan,
            'semester' => $request->semester,
            'id_dosen' => $request->id_dosen,
        ]);

        return redirect()->back()->with('success', 'Mata kuliah berhasil diupdate.');

    }
    public function destroy($id)
    {
        $makul = Makul::findOrFail($id);
        $makul->delete();

        return redirect()->back()->with('success', 'Mata kuliah berhasil dihapus.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kode' => 'required|string',
            'jurusan' => 'required|in:TID,TIF,GAB',
            'semester' => 'required|numeric',
            'id_dosen' => 'required|exists:dosen,id',
        ]);

        Makul::create($request->all());

        return redirect()->back()->with('success', 'Mata kuliah berhasil ditambahkan.');
    }



}

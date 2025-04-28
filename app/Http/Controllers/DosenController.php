<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::orderBy('name', 'asc')->paginate(10);
        return view('content.dosen', compact('dosens'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nidn' => 'required|string|max:255',
            'email' => 'required|email|unique:dosen,email',
            'password' => 'required|string|min:6',
        ]);

        Dosen::create([
            'name' => $request->name,
            'nidn' => $request->nidn,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dosen')->with('success', 'Dosen berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nidn' => 'required|string|max:255',
            'email' => 'required|email|unique:dosen,email,' . $id, 
            'password' => 'nullable|string|min:6',
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->name = $request->name;
        $dosen->nidn = $request->nidn;
        $dosen->email = $request->email;

        if ($request->password) {
            $dosen->password = Hash::make($request->password);
        }

        $dosen->save();

        return redirect()->route('dosen')->with('success', 'Dosen berhasil diupdate');
    }
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect()->route('dosen')->with('success', 'Dosen berhasil dihapus');
    }
}

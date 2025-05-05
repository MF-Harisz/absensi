<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Makul;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with(['kelas', 'makul.dosen'])->paginate(10);
        $kelas = Kelas::all();
        $makul = Makul::with('dosen')->get();
        $dosen = Dosen::all();

        return view('content.jadwal', compact('jadwals', 'kelas', 'makul', 'dosen'));
    }
    public function dashboard()
    {
        $carbonNow = Carbon::now()->locale('id');
        $hariIni = $carbonNow->isoFormat('dddd');
        $tanggalIni = $carbonNow->isoFormat('D MMMM Y');

        $user = Auth::user();

        $jadwalsQuery = Jadwal::with(['kelas', 'makul.dosen'])->where('hari', $hariIni);

        if (Auth::guard('admin')->check() || Auth::guard('dosen')->check()) {
            $jadwals = $jadwalsQuery->get();
        } elseif (Auth::guard('web')->check()) {
            $semesterUser = Auth::guard('web')->user()->semester;
            $jadwals = $jadwalsQuery
                ->whereHas('makul', function ($query) use ($semesterUser) {
                    $query->where('semester', $semesterUser);
                })->get();
        } else {
            $jadwals = collect();
        }

        return view('dashboard', compact('jadwals', 'hariIni', 'tanggalIni'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'id_makul' => 'required',
            'hari' => 'required',
            'jam_in' => 'required',
            'jam_out' => 'required',
        ]);

        $makul = Makul::findOrFail($request->id_makul);

        Jadwal::create([
            'id_kelas' => $request->id_kelas,
            'id_makul' => $request->id_makul,
            'id_dosen' => $request->id_dosen,
            'hari'     => $request->hari,
            'jam_in'      => $request->jam_in,
            'jam_out'      => $request->jam_out,
        ]);

        return redirect()->back()->with('success', 'Jadwal kuliah berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required',
            'jam_in' => 'required',
            'jam_out' => 'required',
            'id_kelas' => 'required',
            'id_makul' => 'required',
            'id_dosen' => 'required',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
            'hari' => $request->hari,
            'jam_in' => $request->jam_in,
            'jam_out' => $request->jam_out,
            'id_kelas' => $request->id_kelas,
            'id_makul' => $request->id_makul,
            'id_dosen' => $request->id_dosen,
        ]);

        return redirect()->back()->with('success', 'Jadwal kuliah berhasil diubah.');
    }
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }




}

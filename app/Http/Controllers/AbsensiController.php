<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Jadwal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::with('user', 'jadwal')->get();
        return view('content.absensi', compact('absensi'));
    }
    public function dataAbsensi()
{
    $absensi = Absensi::with('user', 'jadwal')->get();

    $user = auth()->user();
    $semester = $user->semester;

    $makul = DB::table('makul')
        ->where('semester', $semester)
        ->paginate(4);

    return view('content.dataAbsensi', compact('absensi', 'makul'));
}


    public function create($id_jadwal)
    {
        $jadwal = Jadwal::with(['makul', 'dosen', 'kelas'])->findOrFail($id_jadwal);

        $user = auth()->user();

        return view('content.absensi', compact('jadwal', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_users'     => 'required|exists:users,id',
            'id_jadwal'    => 'required|exists:jadwal,id',
            'id_makul'     => 'required|exists:makul,id',
            'jam'          => 'required',
            'tanggal'      => 'required',
            'foto_base64'  => 'required',
            'lokasi'       => 'required',
        ]);

        try {
            $tanggal = trim(preg_replace('/^[^,]+,\s*/', '', $request->tanggal));
            $tanggalCarbon = Carbon::createFromFormat('d F Y', $tanggal);
            $tanggalMysql = $tanggalCarbon->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['tanggal' => 'Format tanggal tidak valid.']);
        }

        $foto = $request->foto_base64;
        $fotoName = 'absensi_' . time() . '.png';
        $fotoPath = public_path('uploads/absensi/' . $fotoName);

        if (!file_exists(public_path('uploads/absensi'))) {
            mkdir(public_path('uploads/absensi'), 0755, true);
        }

        $foto = str_replace('data:image/png;base64,', '', $foto);
        $foto = str_replace(' ', '+', $foto);
        file_put_contents($fotoPath, base64_decode($foto));

        $lokasi = explode(',', $request->lokasi);
        if (count($lokasi) != 2) {
            return back()->withErrors(['lokasi' => 'Format lokasi tidak valid.']);
        }
        $latitude = trim($lokasi[0]);
        $longitude = trim($lokasi[1]);

        Absensi::create([
            'id_users'  => $request->id_users,
            'id_jadwal' => $request->id_jadwal,
            'id_makul'  => $request->id_makul,
            'jam'       => $request->jam,
            'tanggal'   => $tanggalMysql,
            'foto'      => 'uploads/absensi/' . $fotoName,
            'lokasi'    => DB::raw("ST_GeomFromText('POINT($longitude $latitude)')"),
        ]);

        return redirect()->route('dataAbsensi')->with('success', 'Absensi berhasil dikirim.');
    }



}

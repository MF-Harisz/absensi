<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Makul;
use App\Models\Dosen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::with('user', 'jadwal')->get();
        return view('content.absensi', compact('absensi'));
    }
    public function dataAbsensi(Request $request)
    {
        $auth = auth();

        $query = Absensi::with(['user', 'jadwal', 'makul'])
            ->select('*')
            ->selectRaw('ST_X(lokasi) as longitude, ST_Y(lokasi) as latitude');

        $dosen = null;
        $makul = collect();

        if ($auth->guard('admin')->check() || $auth->guard('dosen')->check()) {
            $makul = Makul::all();
            
            if ($request->filled('id_makul')) {
                $query->where('id_makul', $request->id_makul);
                $selectedMakul = Makul::with('dosen')->find($request->id_makul);
                $dosen = $selectedMakul?->dosen;
            }
        } 
        else if ($auth->check()) {
            $user = $auth->user();
            $semester = $user->semester;
            $makul = Makul::where('semester', $semester)->get();
            
            if ($request->filled('id_makul')) {
                $query->where('id_makul', $request->id_makul);
                $selectedMakul = Makul::with('dosen')->find($request->id_makul);
                $dosen = $selectedMakul?->dosen;
            } else {
                $query->whereIn('id_makul', $makul->pluck('id'));
            }
        }

        $absensi = $query->get();

        return view('content.dataAbsensi', compact('absensi', 'makul', 'dosen'));
    }            

    public function table(Request $request)
    {
        $auth = auth();
        $query = Absensi::with(['user', 'jadwal', 'makul'])
            ->select('*')
            ->selectRaw('ST_X(lokasi) as longitude, ST_Y(lokasi) as latitude');

        if ($auth->guard('admin')->check() || $auth->guard('dosen')->check()) {
            if ($request->filled('id_makul')) {
                $query->where('id_makul', $request->id_makul);
            }
        } else if ($auth->check()) {
            $user = $auth->user();
            $semester = $user->semester;
            $makul = Makul::where('semester', $semester)->get();
            
            if ($request->filled('id_makul')) {
                $query->where('id_makul', $request->id_makul);
            } else {
                $query->whereIn('id_makul', $makul->pluck('id'));
            }
        }

        $this->applyTimeFilters($query, $request);

        $absensi = $query->get();
        $selectedMakul = null;
    if ($request->filled('id_makul')) {
        $selectedMakul = Makul::find($request->id_makul);
    }

    return view('content.absensiTable', compact('absensi', 'selectedMakul'));
    }

    private function applyTimeFilters($query, $request)
    {
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('minggu')) {
            $query->whereRaw('WEEK(tanggal, 1) - WEEK(DATE_SUB(tanggal, INTERVAL DAYOFMONTH(tanggal)-1 DAY), 1) + 1 = ?', [$request->minggu]);
        }
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

        $bulanMap = [
            'Januari' => 'January', 'Februari' => 'February', 'Maret' => 'March',
            'April' => 'April', 'Mei' => 'May', 'Juni' => 'June',
            'Juli' => 'July', 'Agustus' => 'August', 'September' => 'September',
            'Oktober' => 'October', 'November' => 'November', 'Desember' => 'December',
        ];
        
        $tanggal = trim(preg_replace('/^[^,]+,\s*/', '', $request->tanggal));
        
        foreach ($bulanMap as $indo => $eng) {
            if (strpos($tanggal, $indo) !== false) {
                $tanggal = str_replace($indo, $eng, $tanggal);
                break;
            }
        }
        
        try {
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

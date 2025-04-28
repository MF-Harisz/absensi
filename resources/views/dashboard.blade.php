@extends('layout.master')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@endpush
@section('contents')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

</div>

<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                Jadwal Hari {{ ucfirst($hariIni) }}, {{ $tanggalIni }}
            </h6>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('jadwals') }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-list-ul me-1"></i> Lihat Semua Jadwal
                </a>
            </div>
            </div>
            <div class="card-body">
                <div class="table-responsive d-flex justify-content-center">
                    <table class="table table-sm table-striped text-center small">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Prodi</th>
                                <th>Sem</th>
                                <th>Mata Kuliah</th>
                                <th>Jam</th>
                                <th>Ruang</th>
                                <th>Pengampu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwals as $i => $jadwal)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $jadwal->makul->jurusan ?? '-' }}</td>
                                    <td>{{ $jadwal->makul->semester ?? '-' }}</td>
                                    <td>{{ $jadwal->makul->nama ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->jam_in)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_out)->format('H:i') }}</td>
                                    <td>{{ $jadwal->kelas->nama ?? '-' }}</td>
                                    <td>{{ $jadwal->dosen->name ?? '-' }}</td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">
                                            <i class="bi bi-calendar-x" style="font-size: 1.2rem;"></i>
                                            <br>
                                            Tidak ada jadwal perkuliahan hari ini
                                        </td>
                                    </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Absensi</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive d-flex justify-content-center">
                        <table class="table table-sm table-striped text-center small">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Mata Kuliah</th>
                                    <th>Absensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwals as $i => $jadwal)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $jadwal->makul->nama ?? '-' }}</td>
                                        <td>
                                        <a href="{{ route('absensi.create', ['id_jadwal' => $jadwal->id]) }}" class="btn btn-sm btn-primary">Absen</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>

            </div>
        </div>
    </div>
 
</div>

@endsection

@section('scripts')

@endsection

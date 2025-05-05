<div class="col-12 mt-3" id="absensiTableWrapper">
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title mb-0">
                    @if(request('id_makul'))
                        @if(request('tahun') || request('bulan') || request('minggu'))
                        <small class="text-muted">
                            (Mata Kuliah  
                            {{ $selectedMakul->nama ?? '' }}
                            @if(request('tahun')) | Tahun {{ request('tahun') }} @endif
                            @php
                                $bulanIndo = [
                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                ];
                            @endphp
                            @if(request('bulan')) | Bulan {{ $bulanIndo[request('bulan')] ?? '' }} @endif
                            @if(request('minggu')) | Minggu ke-{{ request('minggu') }} @endif
                            )
                        </small>
                        @endif
                    @else
                        <span class="text-muted">Pilih mata kuliah terlebih dahulu</span>
                    @endif
                </h4>
                @if(count($absensi) > 0)
                    <div class="badge bg-primary text-white">
                        Total: {{ count($absensi) }} Data
                    </div>
                @endif
            </div>
            <div class="table-responsive d-flex justify-content-center"></div>
            <table class="table table-striped text-center small">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nim</th>
                        <th>Jurusan</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Foto</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($absensi as $a)
                        <tr data-latitude="{{ $a->latitude ?? '' }}" 
                            data-longitude="{{ $a->longitude ?? '' }}"
                            data-student="{{ $a->user->name ?? 'Unknown' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $a->user->name ?? '-' }}</td>
                            <td>{{ $a->user->nim ?? '-' }}</td>
                            <td>{{ $a->user->jurusan ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($a->tanggal)->translatedFormat('d F Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($a->jam)->format('H:i') }}</td>
                            <td>
                                <img src="{{ asset($a->foto) }}" alt="Foto Absensi" width="50" class="foto-absensi" data-src="{{ asset($a->foto) }}">
                            </td>
                            <td class="lokasi-cell">
                                @if(isset($a->latitude) && isset($a->longitude))
                                    <span class="btn btn-primary btn-icon-split btn-sm view-location">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <span class="text">Lihat Lokasi</span>
                                    </span>
                                @else
                                    <span class="text-muted">Tidak ada data lokasi</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center">Belum ada data absensi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


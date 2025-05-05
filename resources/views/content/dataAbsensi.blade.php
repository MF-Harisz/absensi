@extends('layout.master')

@push('css')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('dataAbsensi')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Absensi</h1>
    </div>

    <div class="row">

        <div class="col-lg-6 mb-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pilih Mata Kuliah</h6>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('dataAbsensi') }}">
                        <select name="id_makul" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Mata Kuliah --</option>
                            @forelse($makul as $m)
                                <option value="{{ $m->id }}" {{ request('id_makul') == $m->id ? 'selected' : '' }}>
                                    {{ $m->nama }}
                                </option>
                            @empty
                                <option disabled>Belum ada mata kuliah</option>
                            @endforelse
                        </select>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dosen / Pengampu</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $dosen->name ?? '-' }}" readonly >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nidn</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $dosen->nidn ?? '-' }}" readonly >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $dosen->email ?? '-' }}" readonly >
                        </div>
                    </div>
            </div>
            </div>

        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="h3 mb-0 text-gray-800">Data Absensi Mahasiswa</h1>
    <div class="col-12 mt-3">
    <form id="filterForm" action="{{ route('dataAbsensi.table') }}" method="GET" class="row mb-4">
    <input type="hidden" name="id_makul" value="{{ request('id_makul') }}">
    
    <div class="col-md-2">
        <select name="tahun" class="form-control">
            <option value="">Tahun</option>
            @for ($y = date('Y'); $y >= 2022; $y--)
                <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
    </div>
    
    <div class="col-md-2">
        <select name="bulan" class="form-control">
            <option value="">Bulan</option>
            @php
                $bulanIndo = [
                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                ];
            @endphp
            @for ($b = 1; $b <= 12; $b++)
                <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                    {{ $bulanIndo[$b] }}
                </option>
            @endfor
        </select>
    </div>
    <div class="col-md-2">
        <select name="minggu" class="form-control">
            <option value="">Minggu</option>
            @for ($w = 1; $w <= 5; $w++)
                <option value="{{ $w }}" {{ request('minggu') == $w ? 'selected' : '' }}>Minggu {{ $w }}</option>
            @endfor
        </select>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('dataAbsensi.table', ['id_makul' => request('id_makul')]) }}" class="btn btn-secondary">Reset</a>
    </div>
</form>
    </div>
    
    @if(request('id_makul'))
        @include('content.absensiTable', ['absensi' => $absensi])
    @endif


</div>
            

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" style="max-height: 80vh;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="mapModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lokasi Absensi: <span id="modalStudentName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <p class="font-weight-bold mb-1">Alamat:</p>
                    <p id="modalAddress" class="text-muted">Memuat alamat...</p>
                </div>
                <div id="map" style="height: 500px; width: 100%;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.foto-absensi', function() {
                const src = $(this).data('src');
                $('#modalImage').attr('src', src);
                $('#imageModal').modal('show');
            });

            $(document).on('click', '.view-location', function() {
                const row = $(this).closest('tr');
                const latitude = parseFloat(row.data('latitude'));
                const longitude = parseFloat(row.data('longitude'));
                const studentName = row.data('student');

                if (!isNaN(latitude) && !isNaN(longitude)) {
                    showMapModal(latitude, longitude, studentName);
                } else {
                    console.error('Koordinat tidak valid:', latitude, longitude);
                }
            });

            function showImageModal(src) {
                document.getElementById('modalImage').src = src;
                document.getElementById('imageModal').style.display = 'block';
            }

            function closeImageModal() {
                document.getElementById('imageModal').style.display = 'none';
            }

            let map;
            let marker;

            function showMapModal(latitude, longitude, studentName) {
                document.getElementById('modalStudentName').textContent = studentName || 'Tidak Diketahui';
                
                $('#mapModal').modal('show');

                $('#mapModal').on('shown.bs.modal', function() {
                    if (map) {
                        map.remove();
                    }

                    map = L.map('map').setView([latitude, longitude], 16);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    marker = L.marker([latitude, longitude]).addTo(map)
                        .bindPopup(`Lokasi absensi: ${studentName}`)
                        .openPopup();

                    getAddress(latitude, longitude);
                });
            }

            function getAddress(lat, lng) {
                const addressElement = document.getElementById('modalAddress');
                addressElement.innerHTML = `
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Memuat alamat...</span>
                    </div>
                    <span>Memuat alamat...</span>
                `;

                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        const address = data.address || {};
                        addressElement.innerHTML = formatAddress(address);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        addressElement.innerHTML = `
                            <div class="alert alert-warning py-1">
                                Gagal memuat alamat. Koordinat: ${lat}, ${lng}
                            </div>
                        `;
                    });
            }

            function formatAddress(address) {
                let html = '<table class="table table-sm table-borderless small">';
                
                const addressComponents = [
                    { key: 'road', label: 'Jalan', prepend: '', append: address.house_number ? ' No. ' + address.house_number : '' },
                    { key: 'neighbourhood', label: 'Lingkungan' },
                    { key: 'village', label: 'Desa/Kelurahan' },
                    { key: 'suburb', label: 'Kecamatan' },
                    { key: 'city', label: 'Kota/Kabupaten' },
                    { key: 'state', label: 'Provinsi' },
                    { key: 'postcode', label: 'Kode Pos' },
                    { key: 'country', label: 'Negara' }
                ];

                addressComponents.forEach(comp => {
                    if (address[comp.key]) {
                        html += `
                            <tr>
                                <th width="30%">${comp.label}</th>
                                <td>${comp.prepend || ''}${address[comp.key]}${comp.append || ''}</td>
                            </tr>
                        `;
                    }
                });

                html += '</table>';
                return html || '<em>Detail alamat tidak tersedia</em>';
            }
        });

        $('#filterForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = $(this).serialize();
            const idMakul = $('select[name="id_makul"]').val();
            
            let url = "{{ route('dataAbsensi.table') }}";
            if (idMakul) {
                url += '?id_makul=' + idMakul;
            }
            
            $.get(url, formData, function(response) {
                $('#absensiTableWrapper').html(response);
            });
        });

        $('select[name="id_makul"]').on('change', function() {
            const idMakul = $(this).val();
            let url = "{{ route('dataAbsensi.table') }}";
            
            if (idMakul) {
                url += '?id_makul=' + idMakul;

                const tahun = $('select[name="tahun"]').val();
                const bulan = $('select[name="bulan"]').val();
                const minggu = $('select[name="minggu"]').val();
                
                if (tahun) url += '&tahun=' + tahun;
                if (bulan) url += '&bulan=' + bulan;
                if (minggu) url += '&minggu=' + minggu;
            }
            
            $.get(url, function(response) {
                $('#absensiTableWrapper').html(response);
            });
        });
    </script>

@endpush
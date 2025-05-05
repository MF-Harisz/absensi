@extends('layout.master')

@push('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

@endpush

@section('absensi')


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Absensi</h1>
            <h6 class="font-weight-bold text-primary">
                Mata Kuliah {{ $jadwal->makul->nama }}
            </h6>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                <h4 class="card-title">Absensi Mahasiswa</h4>
                <form class="form-sample" method="POST" action="{{ route('absensi.store') }}" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description"> Data Absensi </p>
                    <input type="hidden" name="id_users" value="{{ $user->id }}">
                    <input type="hidden" name="id_jadwal" value="{{ $jadwal->id }}">
                    <input type="hidden" name="id_makul" value="{{ $jadwal->makul->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $user->name }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nim</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $user->nim }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Prodi</label>
                                <div class="col-sm-9">
                                    <input type="text"class="form-control" value="{{ $user->jurusan }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Semester</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $user->semester }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mata Kuliah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $jadwal->makul->nama }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dosen</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $jadwal->dosen->name }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jam mulai</label>
                                <div class="col-sm-9">
                                    <div class="input-group col-xs-12">
                                    <input type="text" name="jam" class="form-control" id="jamInput" placeholder="Atur Jam" readonly required>
                                        <span class="input-group-append">
                                            <button class="btn btn-dark" type="button" id="setJamButton">
                                                <i class="fas fa-clock"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hari & Tanggal</label>
                                <div class="col-sm-9">
                                    <div class="input-group col-xs-12">
                                        <input type="text" name="tanggal" id="tanggalInput" class="form-control" placeholder="Atur Hari & Tanggal" readonly required>
                                        <span class="input-group-append">
                                            <button class="btn btn-dark" type="button" onclick="setTanggal()">
                                                <i class="fas fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ambil Selfie</label>
                                <div class="col-sm-9">
                                    <div class="input-group col-xs-12">
                                        <input type="text" name="foto" class="form-control" placeholder="Ambil Foto" readonly id="photoInput" required>
                                        <input type="hidden" name="foto_base64" id="fotoBase64">
                                        <span class="input-group-append">
                                            <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#cameraModal">
                                                <i class="fas fa-camera"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="mt-2" id="photoResult" style="display: none;">
                                        <img id="imageResult" src="" alt="Foto Anda" style="width: 200px; height: 200px; object-fit: cover; border: 1px solid #ccc;">
                                        <button class="btn btn-danger ml-2" type="button" onclick="resetCamera()">
                                            <i class="fas fa-trash-alt"></i> Hapus Foto
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">lokasi</label>
                                <div class="col-sm-9">
                                    <div class="input-group col-xs-12">
                                    <input type="text" class="form-control" placeholder="Ambil lokasi Anda" id="lokasiDisplay" readonly required>
                                        <input type="hidden" name="lokasi" id="lokasi"> 
                                        <span class="input-group-append">
                                            <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#mapModal">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Absensi</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cameraModal" tabindex="-1" role="dialog" aria-labelledby="cameraModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="cameraModalLabel">Ambil Foto Selfie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="stopCamera()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <video id="cameraPreview" autoplay playsinline width="100%" style="border: 1px solid #ccc; object-fit: cover;"></video>
                <button class="btn btn-primary mt-3" type="button" onclick="takePhoto()">Ambil Foto</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mapModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pilih Lokasi</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div id="map" style="height: 400px;"></div>
      </div>
      <div class="modal-footer">
        <button id="saveLocation" class="btn btn-success" data-dismiss="modal">Simpan Lokasi</button>
      </div>
    </div>
  </div>
</div>




@endsection
@push('scripts')

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
     document.getElementById('setJamButton').addEventListener('click', function() {
        const now = new Date();
        const jam = now.getHours().toString().padStart(2, '0');
        const menit = now.getMinutes().toString().padStart(2, '0');
        const waktuSekarang = `${jam}:${menit}`;
        document.getElementById('jamInput').value = waktuSekarang;
    });

    const video = document.getElementById('cameraPreview');
    const image = document.getElementById('imageResult');
    const photoInput = document.getElementById('photoInput');
    const photoResult = document.getElementById('photoResult');
    let cameraStream = null;

    function startCamera() {
        navigator.mediaDevices.getUserMedia({
            video: { facingMode: "user" },
            audio: false
        }).then(stream => {
            cameraStream = stream;
            video.srcObject = stream;
        }).catch(err => {
            alert("Gagal mengakses kamera: " + err.message);
        });
    }

    function takePhoto() {
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        const dataURL = canvas.toDataURL('image/png');
        image.src = dataURL;

        document.getElementById('fotoBase64').value = dataURL;

        image.style.display = 'block';
        photoInput.value = 'Foto telah diambil';
        photoResult.style.display = 'block';

        $('#cameraModal').modal('hide');
        stopCamera();
    }


    function stopCamera() {
        if (cameraStream) {
            const tracks = cameraStream.getTracks();
            tracks.forEach(track => track.stop());
            cameraStream = null;
        }
    }

    function resetCamera() {
        image.src = "";
        image.style.display = 'none';
        photoResult.style.display = 'none';
        photoInput.value = '';
        stopCamera();
    }

    $('#cameraModal').on('shown.bs.modal', function () {
        startCamera();
    });

    $('#cameraModal').on('hidden.bs.modal', function () {
        stopCamera();
    });

    let selectedLatLng = null;
    let map, marker;

    function reverseGeocode(lat, lon) {
        const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`;

        return fetch(url, {
            headers: {
                'User-Agent': 'AbsensiSTT/1.0 (your@email.com)' 
            }
        })
        .then(response => response.json())
        .then(data => data.display_name)
        .catch(error => {
            console.error("Gagal reverse geocode:", error);
            return null;
        });
    }

    $('#mapModal').on('shown.bs.modal', function () {
        if (!map) {
            map = L.map('map').setView([-7.607874, 111.903437], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        const userLatLng = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        map.setView(userLatLng, 15);
                        marker = L.marker(userLatLng).addTo(map);
                        selectedLatLng = userLatLng;

                        reverseGeocode(userLatLng.lat, userLatLng.lng).then(address => {
                            document.querySelector('input[placeholder="Ambil lokasi Anda"]').value =
                                address || `${userLatLng.lat.toFixed(6)}, ${userLatLng.lng.toFixed(6)}`;
                        });
                    },
                    function (error) {
                        console.warn("Gagal mengambil lokasi pengguna, pakai default.");
                    }
                );
            }

            map.on('click', function(e) {
                if (marker) {
                    marker.setLatLng(e.latlng);
                } else {
                    marker = L.marker(e.latlng).addTo(map);
                }
                selectedLatLng = e.latlng;

                reverseGeocode(e.latlng.lat, e.latlng.lng).then(address => {
                    document.querySelector('input[placeholder="Ambil lokasi Anda"]').value =
                        address || `${e.latlng.lat.toFixed(6)}, ${e.latlng.lng.toFixed(6)}`;
                });
            });
        }

        setTimeout(() => map.invalidateSize(), 100);
    });

    document.getElementById('saveLocation').addEventListener('click', function () {
        if (selectedLatLng) {

            document.getElementById('lokasi').value = `${selectedLatLng.lat.toFixed(6)}, ${selectedLatLng.lng.toFixed(6)}`;
        }
    });

  
    
    function setTanggal() {
        const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        const tanggal = new Date();
        const namaHari = hari[tanggal.getDay()];
        const tanggalAngka = String(tanggal.getDate()).padStart(2, '0');
        const namaBulan = bulan[tanggal.getMonth()];
        const tahun = tanggal.getFullYear();

        const formatTanggal = `${namaHari}, ${tanggalAngka} ${namaBulan} ${tahun}`;
        document.getElementById('tanggalInput').value = formatTanggal;
    }

</script>

@endpush
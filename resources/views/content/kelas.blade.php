@extends('layout.master')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@endpush

@section('kelas')


<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Ruang kuliah </h3>
    </div>
    @if(session('success'))
        <div class="alert alert-primary alert-sm" role="alert" id="successAlert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title m-0">Data Ruang Kuliah</h4>
                        @auth('admin')
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                Tambah Ruang Kuliah
                            </button>
                        @endauth
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Lokasi</th>
                                    @auth('admin')
                                        <th scope="col">Action</th>
                                    @endauth
                                </tr>
                            </thead>
                            <tbody>
                                @if($kelas->isEmpty())
                                    <tr class="text-center">
                                        <td colspan="4">Belum ada data ruang kuliah.</td>
                                    </tr>
                                @else
                                    @foreach($kelas as $index => $item)
                                        <tr class="text-center">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->nama}}</td>
                                            <td>{{ $item->lokasi }}</td>
                                            @auth('admin')
                                            <td>
                                                <button 
                                                    class="btn btn-sm btn-primary edit-btn"
                                                    data-id="{{ $item->id }}"
                                                    data-nama="{{ $item->nama }}"
                                                    data-lokasi="{{ $item->lokasi }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal">
                                                    Edit
                                                </button>
                                                <button 
                                                    class="btn btn-sm btn-danger delete-btn" 
                                                    data-id="{{ $item->id }}" 
                                                    data-nama="{{ $item->nama_ruang }}"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal">
                                                    Hapus
                                                </button>
                                            </td>
                                            @endauth
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
           
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('kelas.store') }}" method="POST">
        @csrf
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Ruang Kuliah</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Ruang Kuliah</label>
            <input type="text" class="form-control" name="nama" required>
          </div>

          <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" name="lokasi" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="editModalLabel">Edit Ruang Kuliah</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="editNama" class="form-label">Nama Ruang Kuliah</label>
            <input type="text" class="form-control" id="editNama" name="nama" required>
          </div>

          <div class="mb-3">
            <label for="editLokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="editLokasi" name="lokasi" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <p>Apakah kamu yakin ingin menghapus ruang kuliah <strong id="deleteNama"></strong>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>



@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alert = document.getElementById('successAlert');
        if (alert) {
            setTimeout(() => {
                let bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            }, 3000); 
        }
    });
        document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');
        const editForm = document.getElementById('editForm');
        const namaInput = document.getElementById('editNama');
        const lokasiInput = document.getElementById('editLokasi');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const lokasi = this.getAttribute('data-lokasi');

                namaInput.value = nama;
                lokasiInput.value = lokasi;

                editForm.action = `/kelas/${id}`;
            });
        });
    });
        document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const deleteForm = document.getElementById('deleteForm');
        const deleteNama = document.getElementById('deleteNama');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                deleteForm.action = `/kelas/${id}`;
                deleteNama.textContent = nama;
            });
        });
    });


</script>
<style>
    .alert-sm {
        font-size: 14px;
        padding: 5px 10px;
    }
</style>
@endpush
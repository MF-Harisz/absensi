@extends('layout.master')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@endpush

@section('makul')


<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Mata Kuliah </h3>
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
                        <h4 class="card-title m-0">Data Mata Kuliah</h4>
                        @auth('admin')
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                Tambah Mata Kuliah
                            </button>
                        @endauth
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Dosen</th>
                                    @auth('admin')
                                        <th scope="col">Action</th>
                                    @endauth
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($makul as $index => $item)
                                <tr class="text-center align-middle">
                                    <td>{{ $makul->firstItem() + $index }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->jurusan }}</td>
                                    <td>{{ $item->semester }}</td>
                                    <td>{{ $item->dosen->name ?? '-' }}</td>
                                    @auth('admin')
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                Edit
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                                Delete
                                            </button>
                                        </td>
                                    @endauth
                                </tr>

                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                        <form action="{{ route('makul.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Mata Kuliah</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama Mata Kuliah</label>
                                                    <input type="text" class="form-control" name="nama" value="{{ $item->nama }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="kode" class="form-label">Kode</label>
                                                    <input type="text" class="form-control" name="kode" value="{{ $item->kode }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jurusan{{ $item->id }}" class="form-label">Jurusan</label>
                                                    <select class="form-control" id="jurusan{{ $item->id }}" name="jurusan" required>
                                                        <option value="TID" {{ $item->jurusan == 'TID' ? 'selected' : '' }}>TID</option>
                                                        <option value="TIF" {{ $item->jurusan == 'TIF' ? 'selected' : '' }}>TIF</option>
                                                        <option value="TIF" {{ $item->jurusan == 'GAB' ? 'selected' : '' }}>GAB</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="semester" class="form-label">Semester</label>
                                                    <input type="number" class="form-control" name="semester" value="{{ $item->semester }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="id_dosen" class="form-label">Dosen Pengampu</label>
                                                    <select class="form-select" name="id_dosen" required>
                                                        @foreach($dosen as $d)
                                                            <option value="{{ $d->id }}" {{ $d->id == $item->id_dosen ? 'selected' : '' }}>
                                                            {{ $d->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah kamu yakin ingin menghapus mata kuliah <strong>{{ $item->nama }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('makul.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Pagination" class="mt-4 d-flex justify-content-center">
                        <ul class="pagination">
                            <li class="page-item {{ $makul->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $makul->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $makul->onFirstPage() ? 'true' : 'false' }}">Previous</a>
                            </li>
                            @foreach ($makul->getUrlRange(1, $makul->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $makul->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ $makul->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $makul->nextPageUrl() }}" aria-disabled="{{ $makul->hasMorePages() ? 'false' : 'true' }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('makul.store') }}" method="POST">
        @csrf
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Mata Kuliah</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Mata Kuliah</label>
            <input type="text" class="form-control" name="nama" required>
          </div>

          <div class="mb-3">
            <label for="kode" class="form-label">Kode</label>
            <input type="text" class="form-control" name="kode" required>
          </div>
          <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <select class="form-control" name="jurusan" required>
                    <option value="" disabled selected>Pilih Jurusan</option>
                    <option value="TID">TID</option>
                    <option value="TIF">TIF</option>
                    <option value="GAB">TIF</option>
                </select>
            </div>

          <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="number" class="form-control" name="semester" required>
          </div>

          <div class="mb-3">
            <label for="id_dosen" class="form-label">Dosen Pengampu</label>
            <select class="form-select" name="id_dosen" required>
              <option value="">Pilih Pengampu</option>
              @foreach($dosen as $d)
                <option value="{{ $d->id }}">{{ $d->name }}</option>
              @endforeach
            </select>
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
</script>
<style>
    .alert-sm {
        font-size: 14px;
        padding: 5px 10px;
    }
</style>
@endpush
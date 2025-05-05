@extends('layout.master')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


@endpush

@section('jadwal')


<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Jadwal Perkuliahan STT POMOSDA</h3>
        <h4 class="page-title"> Semester Ganjil Tahun Akademik 2024-2025</h4>
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
                        <h4 class="card-title m-0">Jadwal Perkuliahan</h4>
                        @auth('admin')
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                Tambah Jadwal Kuliah
                            </button>
                        @endauth
                    </div>
                    <div class="table-responsive d-flex justify-content-center">
                      <table class="table table-sm table-striped text-center small">
                            <thead class="text-center">
                                <tr>
                                    <th>Hari</th>
                                    <th>Prodi</th>
                                    <th>Sem</th>
                                    <th>Mata Kuliah</th>
                                    <th>Jam</th>
                                    <th>Ruang</th>
                                    <th>Pengampu</th>
                                    @auth('admin')
                                        <th scope="col">Action</th>
                                    @endauth
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwals as $jadwal)
                                    <tr>
                                        <td>{{ $jadwal->hari }}</td>
                                        <td>{{ $jadwal->makul->jurusan ?? '-' }}</td>
                                        <td>{{ $jadwal->makul->semester ?? '-' }}</td>
                                        <td>{{ $jadwal->makul->nama ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($jadwal->jam_in)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_out)->format('H:i') }}</td>
                                        <td>{{ $jadwal->kelas->nama ?? '-' }}</td>
                                        <td>{{ $jadwal->dosen->name ?? '-' }}</td>
                                        @auth('admin')
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" 
                                                  data-id="{{ $jadwal->id }}" data-hari="{{ $jadwal->hari }}" 
                                                  data-jam-in="{{ $jadwal->jam_in }}" data-jam-out="{{ $jadwal->jam_out }}" 
                                                  data-id_kelas="{{ $jadwal->id_kelas }}" data-id_makul="{{ $jadwal->id_makul }}" 
                                                  data-id_dosen="{{ $jadwal->id_dosen }}">
                                                    Edit
                                                </button>
                                                <button type="button"
                                                        class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        data-id="{{ $jadwal->id }}">
                                                    Delete
                                                </button>
                                            </td>
                                        @endauth
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Pagination" class="mt-4 d-flex justify-content-center">
                      <ul class="pagination">
                          <li class="page-item {{ $jadwals->onFirstPage() ? 'disabled' : '' }}">
                              <a class="page-link" href="{{ $jadwals->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $jadwals->onFirstPage() ? 'true' : 'false' }}">Previous</a>
                          </li>

                          @foreach ($jadwals->getUrlRange(1, $jadwals->lastPage()) as $page => $url)
                              <li class="page-item {{ $page == $jadwals->currentPage() ? 'active' : '' }}">
                                  <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                              </li>
                          @endforeach

                          <li class="page-item {{ $jadwals->hasMorePages() ? '' : 'disabled' }}">
                              <a class="page-link" href="{{ $jadwals->nextPageUrl() }}" aria-disabled="{{ $jadwals->hasMorePages() ? 'false' : 'true' }}">Next</a>
                          </li>
                      </ul>
                  </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Jadwal Kuliah</h5>
          <button type="button" class="btn-close" aria-label="Close" onclick="closeModal()"
            style="transition: none; box-shadow: none; background-color: transparent !important;"></button>
        </div>

        <div class="modal-body">
          <div class="row mb-3">
            <div class="col">
              <label for="hari" class="form-label">Hari</label>
              <select name="hari" class="form-control" required>
                <option value="">-- Pilih Hari --</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
              </select>
            </div>
            <div class="col">
              <label for="jam_in" class="form-label">Jam Mulai</label>
              <input type="text" name="jam_in" class="form-control" id="jamInTambah" placeholder="Atur Jam" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="id_kelas" class="form-label">Kelas</label>
              <select name="id_kelas" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelas as $k)
                  <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="col">
              <label for="jam_out" class="form-label">Jam Selesai</label>
              <input type="text" name="jam_out" class="form-control" id="jamOutTambah" placeholder="Atur Jam" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="id_makul" class="form-label">Mata Kuliah</label>
            <select name="id_makul" class="form-control" required>
              <option value="">-- Pilih Mata Kuliah --</option>
              @foreach($makul as $m)
                <option value="{{ $m->id }}">{{ $m->nama }} ({{ $m->prodi }} - Sem {{ $m->semester }})</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="id_dosen" class="form-label">Dosen</label>
            <select name="id_dosen" class="form-control" required>
              <option value="">-- Pilih Pengampu --</option>
                @foreach($dosen as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('jadwal.update', ':id') }}" method="POST" id="editForm">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Jadwal Kuliah</h5>
          <button type="button" class="btn-close" aria-label="Close" onclick="closeModal()"
            style="transition: none; box-shadow: none; background-color: transparent !important;"></button>
        </div>

        <div class="modal-body">
          <div class="row mb-3">
            <div class="col">
              <label for="hari" class="form-label">Hari</label>
              <select name="hari" class="form-control" id="editHari" required>
                <option value="">-- Pilih Hari --</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
              </select>
            </div>
            <div class="col">
              <label for="jam_in" class="form-label">Jam Mulai</label>
              <input type="text" name="jam_in" class="form-control" id="editJamMulai" placeholder="Atur Jam" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="id_kelas" class="form-label">Kelas</label>
                <select name="id_kelas" class="form-control" id="editKelas" required>
                  <option value="">-- Pilih Kelas --</option>
                  @foreach($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col">
              <label for="jam_out" class="form-label">Jam Mulai</label>
              <input type="text" name="jam_out" class="form-control" id="editJamSelesai" placeholder="Atur Jam" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="id_makul" class="form-label">Mata Kuliah</label>
            <select name="id_makul" class="form-control" id="editMakul" required>
              <option value="">-- Pilih Mata Kuliah --</option>
              @foreach($makul as $m)
                <option value="{{ $m->id }}">{{ $m->nama }} ({{ $m->prodi }} - Sem {{ $m->semester }})</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="id_dosen" class="form-label">Dosen</label>
            <select name="id_dosen" class="form-control" id="editDosen" required>
              <option value="">-- Pilih Pengampu --</option>
                @foreach($dosen as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
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

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form method="POST" id="deleteForm">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Hapus Jadwal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah kamu yakin ingin menghapus jadwal ini?
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {

    const initTimePickers = () => {
      ['#jamInTambah', '#jamOutTambah', '#editJamMulai', '#editJamSelesai'].forEach(selector => {
        flatpickr(selector, {
          enableTime: true,
          noCalendar: true,
          dateFormat: "H:i",
          time_24hr: true,
          allowInput: true,
          clickOpens: true,
          onOpen: function(selectedDates, dateStr, instance) {

            const modal = instance._input.closest('.modal');
            if (modal) {
              modal.classList.add('keep-open');
            }
          },
          onClose: function(selectedDates, dateStr, instance) {
            const modal = instance._input.closest('.modal');
            if (modal) {
              modal.classList.remove('keep-open');
            }
          }
        });
      });
    };

    initTimePickers();

    document.addEventListener('mousedown', function (e) {
      if (e.target.closest('.flatpickr-calendar')) {
        e.stopImmediatePropagation();
      }
    }, true);

    document.addEventListener('keydown', function (e) {
      if (e.key === "Escape") {
        const modals = document.querySelectorAll('.modal.show:not(.keep-open)');
        modals.forEach(modal => {
          bootstrap.Modal.getInstance(modal)?.hide();
        });
      }
    });

    const alert = document.getElementById('successAlert');
    if (alert) {
      setTimeout(() => {
        let bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
        bsAlert.close();
      }, 3000);
    }

    const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const hari = button.getAttribute('data-hari');
      const jamIn = button.getAttribute('data-jam-in');
      const jamOut = button.getAttribute('data-jam-out');
      const idKelas = button.getAttribute('data-id_kelas');
      const idMakul = button.getAttribute('data-id_makul');
      const idDosen = button.getAttribute('data-id_dosen');

      const form = document.getElementById('editForm');
      form.action = `{{ route('jadwal.update', ':id') }}`.replace(':id', id);

      document.getElementById('editHari').value = hari;
      document.getElementById('editJamMulai').value = jamIn;
      document.getElementById('editJamSelesai').value = jamOut;
      document.getElementById('editKelas').value = idKelas;
      document.getElementById('editMakul').value = idMakul;
      document.getElementById('editDosen').value = idDosen;
    });

    editModal.addEventListener('hidden.bs.modal', function () {
      const form = document.getElementById('editForm');
      form.action = `{{ route('jadwal.update', ':id') }}`;
    });

    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const form = document.getElementById('deleteForm');
      form.action = `/jadwal/${id}`;
    });
  });

  function closeModal() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('tambahModal'));
        modal.hide();
    }
</script>
@endpush

@extends('layout.master')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endpush

@section('user')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Daftar Mahasiswa </h3>
        @if(session('success'))
        <div class="alert alert-primary alert-sm" role="alert" id="successAlert">
            {{ session('success') }}
        </div>
    @endif

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title m-0">Data User Mahasiswa</h4>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
                            Tambah Mahasiswa
                        </button>
                        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('user.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah Mahasiswa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama</label>
                                                        <input type="text" class="form-control" name="name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nim" class="form-label">NIM</label>
                                                        <input type="text" class="form-control" name="nim" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="semester" class="form-label">Semester</label>
                                                        <input type="number" class="form-control" name="semester" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="jurusan" class="form-label">Jurusan</label>
                                                        <select class="form-control" name="jurusan" required>
                                                            <option value="" disabled selected>Pilih Jurusan</option>
                                                            <option value="TID">TID</option>
                                                            <option value="TIF">TIF</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="email" required>
                                                    </div>
                                                    <div class="mb-3 position-relative">
                                                        <label for="password" class="form-label">Password</label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" name="password" id="passwordInput" required minlength="6">
                                                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                                                <i class="fas fa-eye" id="eyeIcon"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nim</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $index => $user)
                                <tr class="text-center">
                                    <td>{{ $users->firstItem() + $index }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->nim }}</td>
                                    <td>{{ $user->semester }}</td>
                                    <td>{{ $user->jurusan }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                            Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit Mahasiswa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="name{{ $user->id }}" class="form-label">Nama</label>
                                                                <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="nim{{ $user->id }}" class="form-label">NIM</label>
                                                                <input type="text" class="form-control" id="nim{{ $user->id }}" name="nim" value="{{ $user->nim }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="semester{{ $user->id }}" class="form-label">Semester</label>
                                                                <input type="number" class="form-control" id="semester{{ $user->id }}" name="semester" value="{{ $user->semester }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="jurusan{{ $user->id }}" class="form-label">Jurusan</label>
                                                                <select class="form-control" id="jurusan{{ $user->id }}" name="jurusan" required>
                                                                    <option value="TID" {{ $user->jurusan == 'TID' ? 'selected' : '' }}>TID</option>
                                                                    <option value="TIF" {{ $user->jurusan == 'TIF' ? 'selected' : '' }}>TIF</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email{{ $user->id }}" class="form-label">Email</label>
                                                                <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                                            </div>
                                                            <div class="mb-3 position-relative">
                                                                <label for="password{{ $user->id }}" class="form-label">Password (opsional)</label>
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control" id="passwordEditInput{{ $user->id }}" name="password" minlength="6">
                                                                    <button type="button" class="btn btn-outline-secondary toggle-edit-password" data-target="{{ $user->id }}">
                                                                        <i class="fas fa-eye" id="eyeEditIcon{{ $user->id }}"></i>
                                                                    </button>
                                                                </div>
                                                                <small class="text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
 
                                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Hapus Mahasiswa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus data mahasiswa <strong>{{ $user->name }}</strong>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        const eyeIcon = document.getElementById('eyeIcon');

        toggleBtn.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-edit-password').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-target');
                const input = document.getElementById('passwordEditInput' + id);
                const icon = document.getElementById('eyeEditIcon' + id);

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    });
</script>

@endpush
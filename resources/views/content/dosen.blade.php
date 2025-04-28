@extends('layout.master')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@endpush

@section('dosen')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Daftar Dosen </h3>
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
                        <h4 class="card-title m-0">Data User Dosen</h4>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
                            Tambah Dosen
                        </button>
                        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('dosen.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah Dosen</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nidn" class="form-label">Nidn</label>
                                                <input type="text" class="form-control" name="nidn" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" required minlength="6">
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
                                    <th scope="col">Nidn</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($dosens as $index => $dosen)
                                <tr class="text-center">
                                    <td>{{ $dosens->firstItem() + $index }}</td>
                                    <td>{{ $dosen->name }}</td>
                                    <td>{{ $dosen->nidn }}</td>
                                    <td>{{ $dosen->email }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $dosen->id }}">
                                            Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $dosen->id }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editModal{{ $dosen->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $dosen->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('dosen.update', $dosen->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $dosen->id }}">Edit dosen</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama</label>
                                                            <input type="text" class="form-control" name="name" value="{{ $dosen->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Nidn</label>
                                                            <input type="text" class="form-control" name="nidn" value="{{ $dosen->nidn }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" class="form-control" name="email" value="{{ $dosen->email }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                                                            <input type="password" class="form-control" name="password" minlength="6">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="deleteModal{{ $dosen->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $dosen->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $dosen->id }}">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Yakin ingin menghapus dosen <strong>{{ $dosen->name }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Pagination" class="mt-4 d-flex justify-content-center">
                        <ul class="pagination">
                            <li class="page-item {{ $dosens->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $dosens->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $dosens->onFirstPage() ? 'true' : 'false' }}">Previous</a>
                            </li>
                            @foreach ($dosens->getUrlRange(1, $dosens->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $dosens->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ $dosens->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $dosens->nextPageUrl() }}" aria-disabled="{{ $dosens->hasMorePages() ? 'false' : 'true' }}">Next</a>
                            </li>
                        </ul>
                    </nav>
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
@endpush
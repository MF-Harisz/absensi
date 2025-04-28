@extends('layout.master')

@push('css')

@endpush

@section('dataAbsensi')


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Absensi</h1>
    </div>


    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Dosen Pengampu</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  value="{{ $dosen->name ?? '-' }}" readonly >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nidn</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text"class="form-control"readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Mata Kuliah</h6>
                </div>
                <div class="card-body">
    <ul class="list-group">
        @forelse($makul as $m)
            <li class="list-group-item">{{ $m->nama }}</li>
        @empty
            <li class="list-group-item text-center">Belum ada mata kuliah</li>
        @endforelse
    </ul>

    <nav aria-label="Pagination" class="mt-4 d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item {{ $makul->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $makul->previousPageUrl() ?? '#' }}" tabindex="-1" aria-disabled="{{ $makul->onFirstPage() ? 'true' : 'false' }}">
                    Previous
                </a>
            </li>
            @foreach ($makul->getUrlRange(1, $makul->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $makul->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
            <li class="page-item {{ $makul->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $makul->nextPageUrl() ?? '#' }}" aria-disabled="{{ $makul->hasMorePages() ? 'false' : 'true' }}">
                    Next
                </a>
            </li>
        </ul>
    </nav>
</div>



            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="col-12 mt-3">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title">Data Mahasiswa</h4>
                <div class="table-responsive d-flex justify-content-center">
                    <table class="table table-striped text-center small">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>Jurusan</th>
                                <th>Jam Absensi</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($absensi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->user->name ?? '-' }}</td>
                                    <td>{{ $item->user->nim ?? '-' }}</td>
                                    <td>{{ $item->user->jurusan ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Belum ada data absensi</td>
                                </tr>
                            @endforelse
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



@endpush
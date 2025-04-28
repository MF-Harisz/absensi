<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <i class="fas fa-layer-group"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Web Absensi</div>
    </a>
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    @auth('admin')
    <li class="nav-item {{ request()->routeIs('admin', 'dosen', 'mahasiswa') ? 'active' : '' }}">
        <a class="nav-link collapsed {{ request()->routeIs('admin', 'dosen', 'mahasiswa') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="{{ request()->routeIs('admin', 'dosen', 'mahasiswa') ? 'true' : 'false' }}" aria-controls="collapseUtilities">
            <i class="fas fa-user-cog"></i>
            <span>Pengaturan User</span>
        </a>
        <div id="collapseUtilities" class="collapse {{ request()->routeIs('admin', 'dosen', 'mahasiswa') ? 'show' : '' }}" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User:</h6>
                <a class="collapse-item {{ request()->routeIs('admin') ? 'active' : '' }}" href="{{ route('admin') }}">Admin</a>
                <a class="collapse-item {{ request()->routeIs('dosen') ? 'active' : '' }}" href="{{ route('dosen') }}">Dosen</a>
                <a class="collapse-item {{ request()->routeIs('user') ? 'active' : '' }}" href="{{ route('user') }}">Mahasiswa</a>
            </div>
        </div>
    </li>
    @endauth

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Menu
    </div>

    <li class="nav-item {{ request()->routeIs('jadwals') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('jadwals') }}">
            <i class="fas fa-calendar-alt"></i>
            <span>Jadwal</span></a>
    </li>

    <li class="nav-item {{ request()->routeIs('matakuliah') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('matakuliah') }}">
            <i class="fas fa-book"></i>
            <span>MataKuliah</span></a>
    </li>

    <li class="nav-item {{ request()->routeIs('kelas') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kelas') }}">
            <i class="fas fa-building"></i>
            <span>Kelas</span></a>
    </li>
    
    <li class="nav-item {{ request()->routeIs('dataAbsensi') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dataAbsensi') }}">
            <i class="fas fa-id-card"></i>
            <span>Data Absensi</span></a>
    </li>


    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route(auth()->user()->role . '.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BeritaIN</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs(auth()->user()->role . '.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route(auth()->user()->role . '.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Utama
    </div>

    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editor')
    <li class="nav-item {{ request()->routeIs('berita.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('berita.index') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Kelola Berita</span>
        </a>
    </li>
    @endif

    @if(auth()->user()->role === 'admin')
    <li class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kategori.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Kelola Kategori</span>
        </a>
    </li>
    @endif

    @if(auth()->user()->role === 'admin')
    <li class="nav-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Kelola User</span>
        </a>
    </li>
    @endif

    @if(auth()->user()->role === 'wartawan')
    <li class="nav-item {{ request()->routeIs('news.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('news.index') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Berita Saya</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('news.create') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('news.create') }}">
            <i class="fas fa-fw fa-plus-circle"></i>
            <span>Buat Berita Baru</span>
        </a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->

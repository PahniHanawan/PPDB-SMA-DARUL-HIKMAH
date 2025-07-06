<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand text-center py-3">
        <a href="{{ route('admin.dashboard') }}" class="brand-link d-flex align-items-center justify-content-center">
            <img src="{{ asset('adminLTE/dist/assets/img/logo.png') }}" alt="SMA Darul Hikmah Logo"
                class="brand-image opacity-75 shadow me-2" />
            <span class="brand-text fw-bold">SMA Darul Hikmah</span>
        </a>
    </div>

    <!-- Sidebar Wrapper -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!-- Sidebar Menu -->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-house-door"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Master Data -->
                <li class="nav-header">Master Data</li>
                <li class="nav-item">
                    <a href="{{ route('pendaftaran.index') }}"
                        class="nav-link {{ request()->routeIs('pendaftaran.index') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-clipboard-check"></i>
                        <p>Pendaftar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pendaftaran.diterima') }}"
                        class="nav-link {{ request()->routeIs('pendaftaran.diterima') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-clipboard-check"></i>
                        <p>Pendaftar Diterima</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users') }}"
                        class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>User Management</p>
                    </a>
                </li>

                <!-- Utilities -->
                <li class="nav-header">Utilities</li>
                <li class="nav-item">
                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="#" onclick="confirmLogout(event);" class="nav-link">
                            <i class="nav-icon bi bi-box-arrow-right"></i>
                            <p>Log Out</p>
                        </a>
                    </form>
                </li>
            </ul>
            <!-- End Sidebar Menu -->
        </nav>
    </div>
</aside>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout(event) {
        event.preventDefault();
        Swal.fire({
            title: "Konfirmasi Logout",
            text: "Apakah Anda yakin ingin logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Logout",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>

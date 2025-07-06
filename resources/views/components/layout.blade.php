<!doctype html>
<html lang="en">
<!--begin::Head-->
<x-header>{{ $title }}</x-header>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <x-navbar></x-navbar>
        <!--end::Header-->

        <!--begin::Sidebar-->
        <x-sidebar></x-sidebar>
        <!--end::Sidebar-->

        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Judul Halaman -->
                        <div class="col-sm-6">
                            <h3 class="mb-0">Dashboard</h3>
                        </div>
                        <!-- Breadcrumb -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                @if (request()->routeIs('pendaftaran.index'))
                                    <li class="breadcrumb-item active">Pendaftaran</li>
                                @elseif(request()->routeIs('pendaftaran.show'))
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('pendaftaran.index') }}">Pendaftaran</a>
                                    </li>
                                    <li class="breadcrumb-item active">Detail Pendaftar</li>
                                @elseif(request()->routeIs('admin.users'))
                                    <li class="breadcrumb-item active">Managemen Pengguna</li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::App Content Header-->

            <!--begin::App Content-->
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->

        <!--begin::Footer-->
        <x-footer></x-footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
</body>

</html>

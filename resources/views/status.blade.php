<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Status Pendaftaran</title>
    <link rel="icon" type="image/png" href="{{ asset('adminLTE/dist/assets/img/logo.png') }}" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="{{ asset('adminLTE/dist/assets/img/logo.png') }}" />
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="m-0"><i class="bi bi-clipboard-check"></i> Status Pendaftaran</h3>
            </div>
            <div class="card-body">
                <h5 class="mb-3">Halo, <strong>{{ $pendaftaran->nama }}</strong>!</h5>
                <p>Terima kasih telah mendaftar di <strong>SMA Darul Hikmah</strong>. Berikut adalah status pendaftaran
                    Anda:</p>

                <!-- Status Pendaftaran -->
                <div
                    class="alert d-flex align-items-center
                    @if ($pendaftaran->status_pendaftaran == 'Pending') alert-warning
                    @elseif($pendaftaran->status_pendaftaran == 'Diterima') alert-success
                    @else alert-danger @endif">
                    <i
                        class="bi me-2
                        @if ($pendaftaran->status_pendaftaran == 'Pending') bi-hourglass-split
                        @elseif($pendaftaran->status_pendaftaran == 'Diterima') bi-check-circle-fill
                        @else bi-x-circle-fill @endif"></i>
                    <strong>Status Pendaftaran: </strong>
                    <span class="ms-1">{{ ucfirst($pendaftaran->status_pendaftaran) }}</span>
                </div>

                <!-- Alur Pendaftaran -->
                <h5 class="mt-4"><i class="bi bi-map"></i> Alur Pendaftaran</h5>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success">
                        <i class="bi bi-pencil-square me-2"></i> 1. Mengisi Formulir Pendaftaran ✅
                    </li>
                    <li
                        class="list-group-item
                        @if (in_array($pendaftaran->status_pendaftaran, ['Diterima', 'Ditolak'])) list-group-item-success
                        @else list-group-item-warning @endif">
                        <i class="bi bi-file-earmark-text me-2"></i> 2. Verifikasi Dokumen & Data 🕒
                    </li>
                    <li
                        class="list-group-item
                        @if ($pendaftaran->status_pendaftaran == 'Diterima') list-group-item-success
                        @else list-group-item-secondary @endif">
                        <i class="bi bi-megaphone me-2"></i> 3. Pengumuman Hasil Seleksi 🎉
                    </li>
                    <li class="list-group-item list-group-item-secondary">
                        <i class="bi bi-clipboard-data me-2"></i> 4. Daftar Ulang (Jika Diterima) 📄
                    </li>
                </ul>

                <!-- Pesan Tambahan -->
                @if ($pendaftaran->status_pendaftaran == 'Pending')
                    <p class="mt-3 text-muted">
                        <i class="bi bi-hourglass me-1"></i> Pendaftaran Anda sedang dalam proses verifikasi. Silakan
                        tunggu informasi lebih lanjut.
                    </p>
                @elseif($pendaftaran->status_pendaftaran == 'Diterima')
                    <p class="mt-3 text-success">
                        <i class="bi bi-check-circle me-1"></i> Selamat! Anda telah diterima. Silakan lanjut ke tahap
                        daftar ulang. <br>Persyaratan yang harus dibawa:
                        <br> 1. Pas Foto 3x4 cm : 4 Lembar (berwarna / hitam putih)
                        <br> 2. Fotocopy Ijazah (jika belum dilampirkan pada pendaftaran)
                    </p>
                    <a href="{{ route('download.pdf', $pendaftaran->id) }}" class="btn btn-success">
                        <i class="bi bi-file-earmark-pdf"></i> Download PDF Pendaftaran
                    </a>
                @else
                    <p class="mt-3 text-danger">
                        <i class="bi bi-x-circle me-1"></i> Mohon maaf, pendaftaran Anda tidak diterima. Silakan hubungi
                        panitia untuk informasi lebih lanjut atau silahkan langsung datang ke sekolah.
                    </p>
                @endif

                <!-- Tombol Kembali -->
                <a href="/" class="btn btn-secondary mt-3">
                    <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

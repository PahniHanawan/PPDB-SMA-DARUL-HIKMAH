<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA Darul Hikmah</title>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Teko:wght@300..700&display=swap"
        rel="stylesheet">
    <!-- Font & Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('adminLTE/dist/assets/img/logo.png') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/lib/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}">
    <!-- Bootstrap & Custom Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<script>
    setTimeout(function() {
        let alert = document.querySelector(".alert");
        if (alert) {
            let fadeEffect = setInterval(function() {
                if (!alert.style.opacity) {
                    alert.style.opacity = 1;
                }
                if (alert.style.opacity > 0) {
                    alert.style.opacity -= 0.1;
                } else {
                    clearInterval(fadeEffect);
                    alert.remove();
                }
            }, 100);
        }
    }, 4000); // Alert akan hilang setelah 4 detik
</script>

<body>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
            role="alert" style="z-index: 1050; width: 50%;">
            <strong>✅ Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
            role="alert" style="z-index: 1050; width: 50%;">
            <strong>⚠️ Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed top-50 start-50 translate-middle w-100 vh-100 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    <nav class="custom-navbar">
        <div class="container navbar-container">
            <!-- Logo -->
            <a href="/" class="navbar-brand">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Sekolah">
                SMA Darul Hikmah
            </a>

            <!-- Tombol Menu Mobile -->
            <button class="navbar-toggler" onclick="toggleMenu()">☰</button>

            <!-- Menu Navigasi -->
            <div class="navbar-menu" id="navbarMenu">
                <a href="/">Beranda</a>
                <a href="#fasilitas">Fasilitas</a>
                <a href="{{ route('ekstrakurikuler') }}">Ekstrakurikuler</a>
                @if (auth()->check())
                    @if (auth()->user()->pendaftaran)
                        <!-- Jika user sudah mendaftar, tampilkan tombol Status Pendaftaran -->
                        <a href="{{ route('status.pendaftaran') }}" class="btn-status">Status Pendaftaran</a>
                    @else
                        <!-- Jika user belum mendaftar, tampilkan tombol Daftar Sekarang -->
                        <a href="{{ route('ppdb.step1') }}" class="btn-daftar">Daftar Sekarang</a>
                    @endif
                @else
                    <!-- Jika user belum login, bisa diarahkan ke halaman login -->
                    <a href="{{ route('login') }}" class="btn-login">Login</a>
                    <a href="{{ route('register') }}" class="btn-register">Register</a>

                @endif
                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="button" class="btn-logout" onclick="confirmLogout()">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>
    <!-- Carousel Start -->
    <section id="beranda">
        <div class="header-carousel owl-carousel overflow-hidden position-relative">
            <div class="header-carousel-item position-relative"
                style="background: linear-gradient(to right, #4CAF50, #2E7D32); min-height: 80vh;">
                <div class="container h-100 d-flex align-items-center">
                    <div class="row g-4 align-items-center w-100">
                        <div class="col-lg-6 text-white animated fadeInLeft">
                            <h1 class="text-uppercase fw-bold mb-4">Selamat Datang di Situs Resmi <span
                                    class="text-warning">SMA Darul Hikmah</span></h1>
                            <p class="mb-4 fs-5">Sekolah Pusat Keunggulan yang siap mencetak generasi unggul dan
                                berkarakter.</p>
                        </div>
                        <div class="col-lg-6 text-center animated fadeInRight">
                            <img src="{{ asset('assets/img/edu2.png') }}" class="img-fluid"
                                alt="Education Illustration" style="max-height: 400px;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-carousel-item position-relative"
                style="background: linear-gradient(to right, #1976D2, #0D47A1); min-height: 80vh;">
                <div class="container h-100 d-flex align-items-center">
                    <div class="row g-4 align-items-center w-100">
                        <div class="col-lg-6 text-white animated fadeInLeft">
                            <h1 class="text-uppercase fw-bold mb-4">PSPDB <span class="text-warning">SMA Darul
                                    Hikmah</span>
                            </h1>
                            <p class="mb-4 fs-5">SMA Darul Hikmah menerima pendaftaran siswa/siswi baru. Bergabunglah
                                bersama kami!</p>
                            <a href="{{ route('ppdb.step1') }}"
                                class="btn btn-warning btn-lg rounded-pill px-4 py-2">Daftar Sekarang</a>
                        </div>
                        <div class="col-lg-6 text-center animated fadeInRight">
                            <img src="{{ asset('assets/img/Admission.png') }}" class="img-fluid"
                                alt="Admission Illustration" style="max-height: 400px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Carousel End -->
    <!-- About Start -->
    <section id="fasilitas">
        <div class="about pt-5 bg-secondary">
            <div class="container pt-5">
                <div class="row g-5">
                    <!-- Bagian Kiri (Teks) -->
                    <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="about-content h-100">
                            <h4 class="text-success">Tentang SMA Darul Hikmah</h4>
                            <h1 class="display-4 text-primary mb-4">Fasilitas dan Program Unggulan</h1>
                            <p class="mb-4 text-dark">
                                SMA Darul Hikmah menyediakan berbagai fasilitas dan program unggulan untuk menunjang
                                kualitas pendidikan
                                dan pengembangan karakter siswa.
                            </p>
                            <!-- Tab Pilihan -->
                            <div class="tab-class pb-4">
                                <ul class="nav d-flex mb-2">
                                    <li class="nav-item mb-3">
                                        <a class="d-flex py-2 active text-white bg-success rounded"
                                            data-bs-toggle="pill" href="#fasilitas2">
                                            <span style="width: 180px;">Fasilitas Sekolah</span>
                                        </a>
                                    </li>
                                    <li class="nav-item mb-3">
                                        <a class="d-flex py-2 mx-3 text-white rounded"
                                            style="background-color: #0d6efd;" data-bs-toggle="pill" href="#program">
                                            <span style="width: 180px;">Program Unggulan</span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Isi Tab -->
                                <div class="tab-content">
                                    <!-- Tab Fasilitas -->
                                    <div id="fasilitas2" class="tab-pane fade show active p-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="border-top border-bottom py-3">
                                                    <ul class="list-unstyled text-dark">
                                                        <li><i class="fas fa-school text-success me-2"></i> Gedung
                                                            Sekolah
                                                        </li>
                                                        <li><i class="fas fa-chalkboard text-success me-2"></i>
                                                            Ruang
                                                            Kelas
                                                        </li>
                                                        <li><i class="fas fa-laptop text-success me-2"></i> LABKOM
                                                            &
                                                            PERPUS
                                                            Digital</li>
                                                        <li><i class="fas fa-mosque text-success me-2"></i> Masjid
                                                        </li>
                                                        <li><i class="fas fa-users text-success me-2"></i> Student
                                                            Center
                                                        </li>
                                                        <li><i class="fas fa-futbol text-success me-2"></i>
                                                            Fasilitas
                                                            Ekstrakurikuler</li>
                                                        <li><i class="fas fa-utensils text-success me-2"></i>
                                                            Kantin
                                                        </li>
                                                        <li><i class="fas fa-briefcase-medical text-success me-2"></i>
                                                            UKS
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tab Program Unggulan -->
                                    <div id="program" class="tab-pane fade p-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="border-top border-bottom py-3">
                                                    <ul class="list-unstyled text-dark">
                                                        <li><i class="fas fa-praying-hands text-primary me-2"></i>
                                                            Pembiasaan Ibadah Dhuha, Shadaqah</li>
                                                        <li><i class="fas fa-book-reader text-primary me-2"></i>
                                                            Tilawah
                                                            Al-Qur'an</li>
                                                        <li><i class="fas fa-mosque text-primary me-2"></i> Shalat
                                                            Berjama'ah di Masjid</li>
                                                        <li><i class="fas fa-running text-primary me-2"></i>
                                                            Olahraga
                                                            dan
                                                            Seni Beladiri</li>
                                                        <li><i class="fas fa-quran text-primary me-2"></i> 3T
                                                            (Tahsin,
                                                            Tafhim & Tahfidz) Al-Qur'an</li>
                                                        <li><i class="fas fa-microphone text-primary me-2"></i>
                                                            Pidato
                                                            4
                                                            Bahasa (Indonesia, Arab, Inggris & Sunda)</li>
                                                        <li><i class="fas fa-laptop text-primary me-2"></i>
                                                            Organisasi
                                                            &
                                                            Kewirausahaan Berbasis Digital</li>
                                                        <li><i class="fas fa-book text-primary me-2"></i>
                                                            Pengkajian
                                                            Ilmu
                                                            Agama Islam Berbasis Kitab</li>
                                                        <li><i class="fas fa-bullhorn text-primary me-2"></i>
                                                            Praktek
                                                            Dakwah Lapangan</li>
                                                        <li><i class="fas fa-hand-holding-heart text-primary me-2"></i>
                                                            Pengabdian Kepada Orangtua & Masyarakat</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian Kanan (Gambar) -->
                    <div class="col-xl-6 wow fadeInUp d-flex justify-content-center align-items-center"
                        data-wow-delay="0.2s">
                        <div class="about-img">
                            <img src="{{ asset('assets/img/gdsekolah.png') }}"
                                class="img-fluid rounded shadow img-custom" alt="Gedung SMA Darul Hikmah">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="ekstrakurikuler">
        <div class="container-fluid overflow-hidden py-5" style="background-color: #f8f9fa;">
            <div class="container py-5">
                <div class="row d-flex align-items-stretch">
                    <!-- Kolom Kiri: Konten Ekstrakurikuler -->
                    <div class="col-lg-7 d-flex flex-column justify-content-between">
                        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s"
                            style="max-width: 800px;">
                            <h4 class="text-success">Ekstrakurikuler</h4>
                            <h1 class="display-4 text-dark mb-4">Mengembangkan Potensi, Menyalurkan Bakat</h1>
                            <p class="text-secondary mb-0">
                                Kami menyediakan berbagai kegiatan ekstrakurikuler yang dirancang untuk mengasah
                                keterampilan,
                                menumbuhkan kreativitas, dan membentuk karakter siswa yang unggul.
                            </p>
                        </div>

                        <div class="row gy-4 flex-grow-1">
                            <!-- Pramuka -->
                            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                                <div class="card border-1 shadow-sm rounded-3">
                                    <div class="card-body text-center">
                                        <i class="fas fa-campground fa-3x mb-3" style="color: #8B4513;"></i>

                                        <h5 class="card-title">Pramuka</h5>
                                        <p class="text-muted">Mengembangkan keterampilan kepemimpinan dan kemandirian.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Language Club -->
                            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.6s">
                                <div class="card border-1 shadow-sm rounded-3">
                                    <div class="card-body text-center">
                                        <i class="fas fa-language fa-3x text-primary mb-3"></i>
                                        <h5 class="card-title">Language Club</h5>
                                        <p class="text-muted">Meningkatkan keterampilan bahasa asing siswa.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- TIK -->
                            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                                <div class="card border-1 shadow-sm rounded-3">
                                    <div class="card-body text-center">
                                        <i class="fas fa-laptop-code fa-3x text-info mb-3"></i>
                                        <h5 class="card-title">Teknologi Informasi dan Komunikasi (TIK)</h5>
                                        <p class="text-muted">Mengajarkan pemrograman dan desain digital.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Karate -->
                            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.4s">
                                <div class="card border-1 shadow-sm rounded-3">
                                    <div class="card-body text-center">
                                        <i class="fas fa-fist-raised fa-3x text-warning mb-3"></i>
                                        <h5 class="card-title">Karate</h5>
                                        <p class="text-muted">Melatih kedisiplinan dan sportivitas.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Pencak Silat -->
                            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.6s">
                                <div class="card border-1 shadow-sm rounded-3">
                                    <div class="card-body text-center">
                                        <i class="fas fa-user-ninja fa-3x text-dark mb-3"></i>
                                        <h5 class="card-title">Pencak Silat</h5>
                                        <p class="text-muted"> Seni bela diri tradisional Indonesia yang mengajarkan
                                            ketangkasan, ketahanan fisik, dan kedisiplinan.
                                        </p>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                                <div class="card border-1 shadow-sm rounded-3">
                                    <div class="card-body text-center">
                                        <i class="fas fa-mosque fa-3x text-success mb-3"></i>
                                        <a href="{{ route('ekstrakurikuler') }}"></a>
                                        <h5 class="card-title">Komunitas Pendidikan Agama Islam (KPAI)</h5>
                                        <p class="text-muted">
                                            Wadah pembinaan bagi pelajar dalam memperdalam ilmu agama Islam.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Kolom Kanan: Gambar -->
                    <div class="col-lg-5 d-flex align-items-stretch wow fadeInUp" data-wow-delay="0.3s">
                        <img src="{{ asset('assets/img/eduu.png') }}" alt="Ekstrakurikuler"
                            class="img-fluid rounded-3 shadow h-100 align-self-stretch" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="tentang-kami">
        <footer class="container-fluids bg-success text-light py-5">
            <div class="container">
                <div class="row g-5">
                    <!-- Logo & Sekolah Info -->
                    <div class="col-md-6 col-lg-4">
                        <h4 class="fw-bold text-white">SMA Darul Hikmah</h4>
                        <p>SMA Darul Hikmah berkomitmen menciptakan siswa yang berprestasi dan berakhlak mulia.</p>
                        <div class="d-flex">
                            <a class="btn btn-light btn-md-square me-2"
                                href="https://web.facebook.com/profile.php?id=100078963725811">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="btn btn-light btn-md-square me-2"
                                href="https://www.instagram.com/smadarulhikmahbandung">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-md-6 col-lg-4">
                        <h4 class="fw-bold text-white">Navigasi Cepat</h4>
                        <ul class="list-unstyled">
                            <li><a href="#beranda" class="text-light text-decoration-none">Beranda</a></li>
                            <li><a href="#fasilitas" class="text-light text-decoration-none">Fasilitas</a></li>
                            <li><a href="{{ route('ekstrakurikuler') }}"
                                    class="text-light text-decoration-none">Ekstrakurikuler</a>
                            </li>
                            <li><a href="#tentang-kami" class="text-light text-decoration-none">Tentang Kami</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-md-6 col-lg-4">
                        <h4 class="fw-bold text-white">Kontak Kami</h4>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-map-marker-alt me-2"></i> Jln Cikoneng No 99 Rt 05 Rw 08
                                Desa/Kecamatan Bojongsoang Kab Bandung, Bandung 40288
                            </li>
                            <li><i class="fas fa-envelope me-2"></i> Email</li>
                            <li><i class="fas fa-phone-alt me-2"></i>0838-6695-0699</li>
                        </ul>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="text-center pt-4 mt-4">
                    <hr>
                    <p class="mb-0">&copy; 2025 SMA Darul Hikmah. All rights reserved.</p>
                    <hr>
                </div>
            </div>
        </footer>
    </section>
    <script>
        function toggleMenu() {
            document.getElementById("navbarMenu").classList.toggle("active");
        }

        function confirmLogout() {
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
                    document.getElementById("logout-form").submit();
                }
            });
        }
    </script>
    <!-- Back to Top -->
    <div class="back-to-top">
        <a href="#" class="btn"><i class="fa fa-arrow-up"></i></a>
    </div>
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>

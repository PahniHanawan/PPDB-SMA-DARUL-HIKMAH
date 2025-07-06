<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekstrakurikuler</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Teko:wght@300..700&display=swap"
        rel="stylesheet">

    <!-- Font & Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('adminLTE/dist/assets/img/logo.png') }}" />

    <!-- Bootstrap & Custom Styles -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styleskul.css') }}">
</head>

<body>
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
    <div class="container mx-auto px-4 py-10">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Ekstrakurikuler</h2>

        <!-- Filter Buttons -->
        <div class="flex flex-wrap justify-center gap-3 mb-6">
            @php
                $categories = [
                    'all' => 'ALL',
                    'pramuka' => 'Pramuka',
                    'language-club' => 'Language Club',
                    'tik' => 'TIK',
                    'karate' => 'Karate',
                    'pencak-silat' => 'Pencak Silat',
                    'kpai' => 'KPAI',
                ];
            @endphp
            @foreach ($categories as $key => $value)
                <button
                    class="px-4 py-2 rounded-lg filter-btn {{ $key === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}"
                    data-filter="{{ $key }}">{{ $value }}
                </button>
            @endforeach
        </div>

        <!-- Deskripsi Ekstrakurikuler -->
        <div class="mt-6">
            <div id="info-all"
                class="info-card hidden bg-white p-6 rounded-xl shadow-lg border border-gray-200 text-center">
                <h2 class="text-xl font-semibold text-gray-700">Pilih kategori ekstrakurikuler</h2>
                <p class="text-gray-500">Klik salah satu tombol di atas untuk melihat informasi.</p>
            </div>

            <div id="info-pramuka"
                class="info-card hidden bg-yellow-100 p-6 rounded-xl shadow-lg border border-yellow-300">
                <h2 class="text-2xl font-bold text-yellow-700 flex items-center">
                    🏕️ Pramuka
                </h2>
                <p class="text-yellow-700 mt-2">Melatih kemandirian, kepemimpinan, dan keterampilan bertahan hidup.</p>

                <div class="mt-4">
                    <h4 class="font-semibold">🏕️ Kegiatan Utama</h4>
                    <ul class="list-disc pl-5 text-yellow-700">
                        <li>Perkemahan tahunan dan latihan survival di alam</li>
                        <li>Kegiatan bakti sosial dan peduli lingkungan</li>
                        <li>Pembelajaran sandi morse, semaphore, dan navigasi</li>
                        <li>Peningkatan keterampilan P3K (Pertolongan Pertama)</li>
                    </ul>
                </div>

                <div class="mt-4">
                    <h4 class="font-semibold">🎖️ Manfaat Bergabung</h4>
                    <ul class="list-disc pl-5 text-yellow-700">
                        <li>Meningkatkan keterampilan kepemimpinan</li>
                        <li>Melatih kemandirian dan tanggung jawab</li>
                        <li>Membangun jiwa sosial dan kerja sama tim</li>
                        <li>Menanamkan disiplin dan semangat gotong royong</li>
                    </ul>
                </div>
            </div>
            <div id="info-language-club"
                class="info-card hidden bg-blue-100 p-6 rounded-xl shadow-lg border border-blue-300">
                <h2 class="text-2xl font-bold text-blue-700 flex items-center">
                    🌍 Language Club
                </h2>
                <p class="text-blue-700 mt-2">Mengasah keterampilan berbahasa asing dan mengenal budaya dunia.</p>

                <div class="mt-4">
                    <h4 class="font-semibold">🗣️ Kegiatan Utama</h4>
                    <ul class="list-disc pl-5 text-blue-700">
                        <li>Kelas percakapan bahasa asing (Arab, Inggris)</li>
                        <li>Debat dan diskusi dalam berbagai bahasa</li>
                        <li>Pengenalan budaya dari berbagai negara</li>
                        <li>Menulis dan menerjemahkan artikel berbahasa asing</li>
                        <li>Simulasi TOEFL & IELTS untuk persiapan ujian</li>
                    </ul>
                </div>

                <div class="mt-4">
                    <h4 class="font-semibold">🌟 Manfaat Bergabung</h4>
                    <ul class="list-disc pl-5 text-blue-700">
                        <li>Meningkatkan kemampuan berbicara dan menulis dalam bahasa asing</li>
                        <li>Memperluas wawasan tentang budaya dunia</li>
                        <li>Mempermudah peluang beasiswa dan studi di luar negeri</li>
                        <li>Meningkatkan kepercayaan diri dalam berkomunikasi</li>
                    </ul>
                </div>
            </div>


            <div id="info-tik" class="info-card hidden bg-green-100 p-6 rounded-xl shadow-lg border border-green-300">
                <h2 class="text-2xl font-bold text-green-700 flex items-center">
                    💻 TIK (Teknologi Informasi dan Komunikasi)
                </h2>
                <p class="text-green-700 mt-2">Mempelajari teknologi informasi dan inovasi digital.</p>

                <div class="mt-4">
                    <h4 class="font-semibold">🖥️ Kegiatan Utama</h4>
                    <ul class="list-disc pl-5 text-green-700">
                        <li>Membuat pamflet hari besar atau peringatan penting</li>
                        <li>Membuat vlog kegiatan OSIS</li>
                        <li>Menampilkan pengumuman di media sosial OSIS</li>
                        <li>Menjadi tim multimedia saat ada seminar</li>
                        <li>Menjadikan TIK sebagai wahana kreativitas dan inovasi</li>
                    </ul>
                </div>

                <div class="mt-4">
                    <h4 class="font-semibold">🚀 Manfaat Bergabung</h4>
                    <ul class="list-disc pl-5 text-green-700">
                        <li>Meningkatkan keterampilan digital</li>
                        <li>Persiapan karir di bidang teknologi</li>
                        <li>Mengembangkan kreativitas dalam desain dan inovasi digital</li>
                        <li>Membangun portofolio untuk masa depan</li>
                    </ul>
                </div>
            </div>


            <div id="info-karate"
                class="info-card hidden bg-orange-100 p-6 rounded-xl shadow-lg border border-orange-300">
                <h2 class="text-2xl font-bold text-orange-700 flex items-center">
                    🥋 Karate
                </h2>
                <p class="text-orange-700 mt-2">Mengembangkan keterampilan bela diri, disiplin, dan ketahanan fisik.
                </p>

                <div class="mt-4">
                    <h4 class="font-semibold">🥋 Kegiatan Utama</h4>
                    <ul class="list-disc pl-5 text-orange-700">
                        <li>Latihan teknik dasar (Kihon, Kata, dan Kumite)</li>
                        <li>Peningkatan kekuatan, keseimbangan, dan fleksibilitas</li>
                        <li>Pelatihan pertahanan diri dan teknik sparring</li>
                        <li>Pemahaman filosofi dan nilai-nilai karate</li>
                        <li>Persiapan dan partisipasi dalam kompetisi</li>
                        <li>Ujian kenaikan sabuk secara berkala</li>
                    </ul>
                </div>

                <div class="mt-4">
                    <h4 class="font-semibold">🔥 Manfaat Bergabung</h4>
                    <ul class="list-disc pl-5 text-orange-700">
                        <li>Meningkatkan disiplin dan kepercayaan diri</li>
                        <li>Memperkuat fisik dan mental melalui latihan rutin</li>
                        <li>Menjadi lebih tangguh dan siap menghadapi tantangan</li>
                        <li>Berpeluang mengikuti turnamen karate</li>
                        <li>Mendapatkan sertifikasi dan kenaikan sabuk</li>
                    </ul>
                </div>
            </div>


            <div id="info-pencak-silat"
                class="info-card hidden bg-purple-100 p-6 rounded-xl shadow-lg border border-purple-300">
                <h2 class="text-2xl font-bold text-purple-700 flex items-center">
                    🏆 Pencak Silat
                </h2>
                <p class="text-purple-700 mt-2">Mempelajari seni bela diri tradisional Indonesia untuk kesehatan dan
                    prestasi.</p>

                <div class="mt-4">
                    <h4 class="font-semibold">🥋 Kegiatan Utama</h4>
                    <ul class="list-disc pl-5 text-purple-700">
                        <li>Latihan teknik dasar serangan dan pertahanan</li>
                        <li>Pemahaman jurus-jurus tradisional</li>
                        <li>Latihan kekuatan, kelincahan, dan refleks</li>
                        <li>Simulasi pertandingan (sparring)</li>
                        <li>Penguasaan teknik kuncian dan bantingan</li>
                        <li>Persiapan mengikuti kompetisi pencak silat</li>
                    </ul>
                </div>

                <div class="mt-4">
                    <h4 class="font-semibold">🔥 Manfaat Bergabung</h4>
                    <ul class="list-disc pl-5 text-purple-700">
                        <li>Meningkatkan ketahanan fisik dan mental</li>
                        <li>Melatih fokus, keseimbangan, dan kepercayaan diri</li>
                        <li>Mempelajari budaya dan nilai-nilai luhur bangsa</li>
                        <li>Berpeluang meraih prestasi di tingkat daerah hingga nasional</li>
                        <li>Mendapatkan sertifikasi dan kenaikan tingkat sabuk</li>
                    </ul>
                </div>
            </div>
            <div id="info-kpai"
                class="info-card hidden bg-blue-100 p-6 rounded-xl shadow-md border border-blue-300 hover:shadow-lg transition-all duration-300">
                <h2 class="text-2xl font-bold text-blue-700 flex items-center">📖 Komunitas Pendidikan Agama Islam
                    (KPAI)</h2>
                <p class="text-blue-700 mt-2">Bersama KPAI, mari tingkatkan keimanan dan ketakwaan dengan ilmu yang
                    bermanfaat!</p>

                <div class="mt-4">
                    <h4 class="font-semibold">📖 Pembelajaran Al-Qur'an</h4>
                    <ul class="list-disc pl-5 text-blue-700">
                        <li>Mengaji dengan bimbingan tajwid yang benar</li>
                        <li>Memahami tafsir ayat-ayat Al-Qur'an</li>
                        <li>Menghafal surat-surat pilihan</li>
                    </ul>
                </div>

                <div class="mt-4">
                    <h4 class="font-semibold">📜 Pembelajaran Hadits & Fiqih</h4>
                    <ul class="list-disc pl-5 text-blue-700">
                        <li>Memahami dan menghafal hadits-hadits pilihan</li>
                        <li>Menerapkan hadits dalam kehidupan sehari-hari</li>
                        <li>Memahami fiqih untuk meningkatkan ketakwaan</li>
                    </ul>
                </div>

                <div class="mt-4">
                    <h4 class="font-semibold">📚 Pematerian Nahwu & Tafsir</h4>
                    <ul class="list-disc pl-5 text-blue-700">
                        <li>Mempelajari ilmu nahwu untuk memahami bahasa Arab lebih dalam</li>
                        <li>Mengkaji tafsir sebagai bekal dalam memahami Al-Qur'an</li>
                    </ul>
                </div>

                <div class="mt-4">
                    <h4 class="font-semibold">🌟 Manfaat Bergabung</h4>
                    <ul class="list-disc pl-5 text-blue-700">
                        <li>Menambah pemahaman agama secara mendalam</li>
                        <li>Memperkuat ukhuwah Islamiyah dengan sesama anggota</li>
                        <li>Meningkatkan keterampilan public speaking dalam dakwah</li>
                        <li>Kesempatan mendapatkan sertifikasi dalam bidang keagamaan</li>
                    </ul>
                </div>
            </div>

        </div>
        <br>

        <!-- Ekstrakurikuler Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @php
                $ekstrakurikuler = [
                    [
                        'name' => 'Pramuka',
                        'images' => ['assets/img/pramuka1.jpeg', 'assets/img/pramuka2.jpeg'],
                        'category' => 'pramuka',
                    ],
                    [
                        'name' => 'Language Club',
                        'images' => [],
                        'category' => 'language-club',
                    ],
                    [
                        'name' => 'TIK',
                        'images' => [],
                        'category' => 'tik',
                    ],
                    [
                        'name' => 'Karate',
                        'images' => [],
                        'category' => 'karate',
                    ],
                    [
                        'name' => 'Pencak Silat',
                        'images' => [],
                        'category' => 'pencak-silat',
                    ],
                    [
                        'name' => 'KPAI',
                        'images' => [],
                        'category' => 'kpai',
                    ],
                ];
            @endphp

            @foreach ($ekstrakurikuler as $item)
                @foreach ($item['images'] as $image)
                    <div
                        class="card bg-white rounded-lg shadow-lg overflow-hidden hover-zoom {{ $item['category'] }}">
                        <div class="relative group">
                            <img src="{{ asset($image) }}" alt="{{ $item['name'] }}"
                                class="w-full h-56 object-cover group-hover:opacity-75 transition duration-300">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                <button class="bg-white text-black px-4 py-2 rounded-lg text-sm font-semibold"
                                    onclick="openModal('{{ asset($image) }}')">🔍 Lihat</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

    <!-- Modal Popup -->
    <div id="imageModal" class="modal fixed inset-0 bg-black bg-opacity-70 hidden">
        <div class="relative bg-white rounded-lg shadow-lg p-4 max-w-md sm:max-w-lg md:max-w-2xl w-full">
            <button class="modal-close" onclick="closeModal()">✖</button>
            <img id="modalImage" class="w-full h-auto max-h-[80vh] rounded-lg">
        </div>
    </div>

    <section id="tentang-kami">
        <footer class="container-fluids bg-success text-light py-5">
            <div class="container">
                <div class="row g-5">
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
                    <div class="col-md-6 col-lg-4">
                        <h4 class="fw-bold text-white">Navigasi Cepat</h4>
                        <ul class="list-unstyled">
                            <li><a href="/" class="text-light text-decoration-none">Beranda</a></li>
                            </li>
                            <li><a href="#tentang-kami" class="text-light text-decoration-none">Tentang Kami</a>
                            </li>
                        </ul>
                    </div>
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
                <div class="text-center pt-4 mt-4">
                    <hr>
                    <p class="mb-0">&copy; 2025 SMA Darul Hikmah. All rights reserved.</p>
                    <hr>
                </div>
            </div>
        </footer>
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
    </section>
</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".filter-btn");
        const infoCards = document.querySelectorAll(".info-card");
        const cards = document.querySelectorAll(".card");
        const modal = document.getElementById("imageModal");
        const modalImage = document.getElementById("modalImage");

        // Ambil kategori terakhir dari localStorage jika ada
        let selectedCategory = localStorage.getItem("selectedCategory") || "all";
        filterCards(selectedCategory);

        buttons.forEach(button => {
            button.addEventListener("click", function() {
                const filter = this.getAttribute("data-filter");

                // Simpan kategori yang dipilih ke localStorage
                localStorage.setItem("selectedCategory", filter);
                filterCards(filter);
                // Sembunyikan semua info-card
                infoCards.forEach(card => card.classList.add("hidden"));

                // Tampilkan info sesuai filter
                const selectedInfo = document.getElementById(`info-${filter}`);
                if (selectedInfo) {
                    selectedInfo.classList.remove("hidden");
                }
            });
        });

        function filterCards(filter) {
            // Update button styling
            buttons.forEach(btn => btn.classList.remove("bg-blue-500", "text-white"));
            const activeButton = document.querySelector(`.filter-btn[data-filter="${filter}"]`);
            if (activeButton) {
                activeButton.classList.add("bg-blue-500", "text-white");
            }

            // Filter cards
            cards.forEach(card => {
                if (filter === "all" || card.classList.contains(filter)) {
                    card.classList.remove("hidden");
                } else {
                    card.classList.add("hidden");
                }
            });
        }

        // Modal Image Functionality
        window.openModal = function(imageSrc) {
            modalImage.src = imageSrc;
            modal.classList.add("show");
        };

        window.closeModal = function() {
            modal.classList.remove("show");
        };

        // Klik di luar gambar untuk menutup modal tanpa refresh
        modal.addEventListener("click", function(e) {
            if (e.target === modal) closeModal();
        });
    });

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

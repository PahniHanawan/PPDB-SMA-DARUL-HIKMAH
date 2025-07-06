<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="card-title m-0">Data Pendaftar</h3>
            </div>
            <div class="card-body">
                <!-- Alert Success (Dapatkan dari Session Laravel) -->
                @if (session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: "{{ session('success') }}",
                                timer: 3000,
                                showConfirmButton: false
                            });
                        });
                    </script>
                @endif
                <a href="{{ route('export.diterima.excel') }}" class="btn btn-success btn-sm mb-2">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </a>

                <!-- Tabel Data (Dengan DataTables) -->
                <div class="table-responsive">
                    <table id="pendaftarTable" class="table table-striped table-bordered align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>NISN</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>No. Telepon</th>
                                <th>Rata-Rata Nilai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendaftaran as $key => $pendaftaran)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-start fw-bold">{{ $pendaftaran->nama }}</td>
                                    <td>{{ $pendaftaran->nik }}</td>
                                    <td>{{ $pendaftaran->nisn }}</td>
                                    <td>{{ ucfirst($pendaftaran->jenis_kelamin) }}</td>
                                    <td>{{ ucfirst($pendaftaran->agama) }}</td>
                                    <td>{{ $pendaftaran->notelp }}</td>
                                    <td class="fw-bold text-primary">
                                        {{ number_format($pendaftaran->nilai_rata_rata, 2) }}</td>
                                    <td>
                                        <span
                                            class="badge
                                            @if ($pendaftaran->status_pendaftaran == 'Pending') bg-warning text-dark
                                            @elseif ($pendaftaran->status_pendaftaran == 'Diterima') bg-success
                                            @elseif ($pendaftaran->status_pendaftaran == 'Ditolak') bg-danger
                                            @else bg-secondary @endif">
                                            {{ ucfirst($pendaftaran->status_pendaftaran) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($pendaftaran->status_pendaftaran == 'Diterima')
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bi bi-gear"></i> Aksi
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('pendaftaran.show', $pendaftaran->id) }}"
                                                            class="dropdown-item">
                                                            <i class="bi bi-eye"></i> Detail
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item text-danger"
                                                            onclick="confirmDelete({{ $pendaftaran->id }})">
                                                            <i class="bi bi-trash-fill"></i> Hapus
                                                        </button>
                                                        <form id="delete-form-{{ $pendaftaran->id }}"
                                                            action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- DataTables & SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#pendaftarTable').DataTable({
                "order": [
                    [7, "desc"]
                ], // Urut berdasarkan rata-rata nilai terbesar
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data",
                    "zeroRecords": "Data tidak ditemukan",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "→",
                        "previous": "←"
                    }
                }
            });
        });

        function confirmDelete(id) {
            Swal.fire({
                title: "Konfirmasi Hapus",
                text: "Apakah Anda yakin ingin menghapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</x-layout>

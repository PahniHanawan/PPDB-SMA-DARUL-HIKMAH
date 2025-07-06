<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h3 class="m-0">Detail Pendaftar</h3>
            </div>
            <div class="card-body">
                <!-- Data Pendaftar -->
                <h5 class="mb-3">Informasi Pendaftar</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $pendaftaran->nama }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>{{ $pendaftaran->nik }}</td>
                    </tr>
                    <tr>
                        <th>NISN</th>
                        <td>{{ $pendaftaran->nisn }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $pendaftaran->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <td>{{ $pendaftaran->agama }}</td>
                    </tr>
                    <tr>
                        <th>Tempat, Tanggal Lahir</th>
                        <td>{{ $pendaftaran->tempat_lahir }},
                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $pendaftaran->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Asal Sekolah</th>
                        <td>{{ $pendaftaran->asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>{{ $pendaftaran->notelp }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Rata-rata</th>
                        <td>{{ number_format($pendaftaran->nilai_rata_rata, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Status Pendaftaran</th>
                        <td>
                            <select id="statusPendaftaran" class="form-select">
                                <option value="Pending" @if ($pendaftaran->status_pendaftaran == 'Pending') selected @endif>Pending
                                </option>
                                <option value="Diterima" @if ($pendaftaran->status_pendaftaran == 'Diterima') selected @endif>Diterima
                                </option>
                                <option value="Ditolak" @if ($pendaftaran->status_pendaftaran == 'Ditolak') selected @endif>Ditolak
                                </option>
                            </select>
                        </td>
                    </tr>
                </table>

                <!-- Data Orang Tua -->
                <h5 class="mt-4">Informasi Orang Tua</h5>
                <table class="table table-bordered">
                    <tr class="table-primary">
                        <th colspan="2" class="text-center">Data Ayah</th>
                        <th colspan="2" class="text-center">Data Ibu</th>
                    </tr>
                    <tr>
                        <th>Nama Ayah</th>
                        <td>{{ $orangtua->nama_ayah ?? 'Tidak Ada Data' }}</td>
                        <th>Nama Ibu</th>
                        <td>{{ $orangtua->nama_ibu ?? 'Tidak Ada Data' }}</td>
                    </tr>
                    <tr>
                        <th>NIK Ayah</th>
                        <td>{{ $orangtua->nik_ayah ?? '-' }}</td>
                        <th>NIK Ibu</th>
                        <td>{{ $orangtua->nik_ibu ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status Ayah</th>
                        <td>{{ $orangtua->status_ayah ?? '-' }}</td>
                        <th>Status Ibu</th>
                        <td>{{ $orangtua->status_ibu ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>No. HP Ayah</th>
                        <td>{{ $orangtua->no_ayah ?? '-' }}</td>
                        <th>No. HP Ibu</th>
                        <td>{{ $orangtua->no_ibu ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tempat, Tgl Lahir Ayah</th>
                        <td>{{ $orangtua->tempat_lahir_ayah ?? '-' }},
                            {{ $orangtua->tgl_lahir_ayah ? \Carbon\Carbon::parse($orangtua->tgl_lahir_ayah)->format('d M Y') : '-' }}
                        </td>
                        <th>Tempat, Tgl Lahir Ibu</th>
                        <td>{{ $orangtua->tempat_lahir_ibu ?? '-' }},
                            {{ $orangtua->tgl_lahir_ibu ? \Carbon\Carbon::parse($orangtua->tgl_lahir_ibu)->format('d M Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Agama Ayah</th>
                        <td>{{ $orangtua->agama_ayah ?? '-' }}</td>
                        <th>Agama Ibu</th>
                        <td>{{ $orangtua->agama_ibu ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Pekerjaan Ayah</th>
                        <td>{{ $orangtua->pekerjaan_ayah ?? '-' }}</td>
                        <th>Pekerjaan Ibu</th>
                        <td>{{ $orangtua->pekerjaan_ibu ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Penghasilan Ayah</th>
                        <td>{{ $orangtua->penghasilan_ayah ?? '-' }}</td>
                        <th>Penghasilan Ibu</th>
                        <td>{{ $orangtua->penghasilan_ibu ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Orang Tua</th>
                        <td colspan="3">{{ $orangtua->alamat_orangtua ?? 'Tidak Ada Data' }}</td>
                    </tr>
                </table>

                <!-- Data Dokumen -->
                <h5 class="mt-4">Dokumen yang Diupload</h5>
                <div class="row">
                    @forelse ($dokumens as $dokumen)
                        @php
                            $fileExtension = pathinfo($dokumen->file_path, PATHINFO_EXTENSION);
                        @endphp
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header bg-secondary text-white">
                                    <strong>{{ ucfirst($dokumen->kategori_dokumen) }}</strong>
                                </div>
                                <div class="card-body text-center">
                                    @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ asset('laravel/public/' . $dokumen->file_path) }}"
                                            class="img-fluid rounded" alt="{{ $dokumen->nama_dokumen }}">
                                    @elseif ($fileExtension === 'pdf')
                                        <iframe src="{{ asset('laravel/public/' . $dokumen->file_path) }}"
                                            width="100%" height="250px"></iframe>
                                    @else
                                        <i class="fas fa-file-alt fa-5x text-muted"></i>
                                    @endif
                                    <a href="{{ asset('laravel/public/' . $dokumen->file_path) }}" target="_blank"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Lihat Dokumen
                                    </a>
                                    <a href="{{ asset('laravel/public/' . $dokumen->file_path) }}" download
                                        class="btn btn-sm btn-success">
                                        <i class="fas fa-download"></i> Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">Belum ada dokumen yang diunggah.</p>
                    @endforelse
                </div>

                <!-- Tombol Kembali -->
                <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('statusPendaftaran').addEventListener('change', function() {
            let status = this.value;
            let pendaftaranId = {{ $pendaftaran->id }};

            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah Anda yakin ingin mengubah status pendaftaran?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Ubah",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/pendaftaran/${pendaftaranId}/update-status`, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                status: status
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire("Sukses!", "Status berhasil diperbarui.", "success");
                            } else {
                                Swal.fire("Gagal!", "Terjadi kesalahan saat memperbarui status.",
                                    "error");
                            }
                        })
                        .catch(error => {
                            Swal.fire("Error!", "Terjadi kesalahan saat memperbarui status.", "error");
                        });
                }
            });
        });
    </script>
</x-layout>

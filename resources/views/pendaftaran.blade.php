<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .action-buttons {
            text-align: right;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <h2 class="text-center mb-4">Pendaftaran PSPDB SMA Darul Hikmah</h2>
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h5>STEP 1/3 - Data Pribadi</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('ppdb.storeStep1') }}">
                            @csrf
                            <input type="hidden" name="id_user" value="{{ auth()->id() }}">

                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama', $form_data['nama'] ?? '') }}"
                                    required placeholder="Masukkan nama lengkap Anda">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- NIK -->
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                    id="nik" name="nik" value="{{ old('nik', $form_data['nik'] ?? '') }}"
                                    required maxlength="16" pattern="[0-9]{16}" placeholder="Masukkan NIK (16 digit)">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- NISN -->
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                    id="nisn" name="nisn" value="{{ old('nisn', $form_data['nisn'] ?? '') }}"
                                    required maxlength="10" pattern="[0-9]{1,10}"
                                    placeholder="Masukkan NISN (maksimal 10 digit)">
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                    id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki"
                                        {{ old('jenis_kelamin', $form_data['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="Perempuan"
                                        {{ old('jenis_kelamin', $form_data['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Agama -->
                            <div class="mb-3">
                                <label for="agama" class="form-label">Agama <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('agama') is-invalid @enderror"
                                    id="agama" name="agama" value="{{ old('agama', $form_data['agama'] ?? '') }}"
                                    required placeholder="Masukkan agama Anda">
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tempat & Tanggal Lahir -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" name="tempat_lahir"
                                            value="{{ old('tempat_lahir', $form_data['tempat_lahir'] ?? '') }}"
                                            required placeholder="Masukkan tempat lahir Anda">
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                                class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir" name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir', $form_data['tanggal_lahir'] ?? '') }}"
                                            required>
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat <span
                                        class="text-danger">*</span></label>
                                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3"
                                    required placeholder="Masukkan alamat lengkap Anda">{{ old('alamat', $form_data['alamat'] ?? '') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Asal Sekolah & Nilai Rata-rata -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="asal_sekolah" class="form-label">Asal Sekolah <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('asal_sekolah') is-invalid @enderror"
                                            id="asal_sekolah"
                                            name="asal_sekolah"value="{{ old('asal_sekolah', $form_data['asal_sekolah'] ?? '') }}"
                                            required placeholder="Masukkan nama asal sekolah Anda">
                                        @error('asal_sekolah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nilai_rata_rata" class="form-label">Nilai Rata-rata <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('nilai_rata_rata') is-invalid @enderror"
                                            id="nilai_rata_rata" name="nilai_rata_rata"
                                            value="{{ old('nilai_rata_rata', $form_data['nilai_rata_rata'] ?? '') }}"
                                            required placeholder="Masukkan nilai rata-rata">
                                        @error('nilai_rata_rata')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- No. Telepon -->
                            <div class="mb-3">
                                <label for="notelp" class="form-label">No. Telepon <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('notelp') is-invalid @enderror"
                                    id="notelp" name="notelp"
                                    value="{{ old('notelp', $form_data['notelp'] ?? '') }}" required
                                    pattern="(\+62|62|0)8[1-9][0-9]{7,10}"
                                    placeholder="Masukkan No. Telepon (08xx atau +62xx)">
                                @error('notelp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-between mt-3">
                                <a href="/" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Selanjutnya</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('notelp').addEventListener('input', function(e) {
            let value = e.target.value;
            let regex = /^(\+62|62|0)8[1-9][0-9]{7,10}$/; // Format nomor Indonesia
            if (!regex.test(value)) {
                e.target.setCustomValidity(
                    "Nomor telepon harus dimulai dengan 08xx atau +62xx dan memiliki 9-12 digit.");
            } else {
                e.target.setCustomValidity("");
            }
        });
    </script>

</body>

</html>

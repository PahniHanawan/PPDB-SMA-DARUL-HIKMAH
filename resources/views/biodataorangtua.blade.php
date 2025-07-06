<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Pendaftaran PSPDB SMA Darul Hikmah</h2>
                <form method="POST" action="{{ route('ppdb.storeStep2') }}">
                    @csrf
                    <input type="hidden" name="id_user" value="{{ auth()->id() }}">

                    <div class="card shadow">
                        <div class="card-header bg-primary text-white text-center">
                            <h5>STEP 2/3 - Data Orang Tua</h5>
                        </div>
                        <div class="card-body">
                            <!-- Data Ayah -->
                            <h4 class="text-primary">Data Ayah / Wali</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_ayah" class="form-label">Nama Ayah / Wali <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required
                                        value="{{ old('nama_ayah', $form_data['nama_ayah'] ?? '') }}"
                                        placeholder="Masukkan nama lengkap ayah / wali">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nik_ayah" class="form-label">NIK Ayah / Wali <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="nik_ayah" name="nik_ayah" required
                                        maxlength="16" oninput="validasiNIK(this)"
                                        title="NIK harus terdiri dari 16 digit angka"
                                        value="{{ old('nik_ayah', $form_data['nik_ayah'] ?? '') }}"
                                        placeholder="Masukkan 16 digit NIK">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status_ayah" class="form-label">Status Ayah / Wali <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="status_ayah" name="status_ayah" required>
                                        <option value="Hidup"
                                            {{ old('status_ayah', $form_data['status_ayah'] ?? '') == 'Hidup' ? 'selected' : '' }}>
                                            Hidup</option>
                                        <option value="Meninggal"
                                            {{ old('status_ayah', $form_data['status_ayah'] ?? '') == 'Meninggal' ? 'selected' : '' }}>
                                            Meninggal</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_ayah" class="form-label">No. Telepon Ayah / Wali <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_ayah" name="no_ayah" required
                                        pattern="(\+62|62|0)8[1-9][0-9]{7,10}"
                                        title="Nomor telepon harus dimulai dengan 08xx atau +62xx dan memiliki 9-12 digit."
                                        value="{{ old('no_ayah', $form_data['no_ayah'] ?? '') }}"
                                        placeholder="Masukkan no telepon aktif">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tempat_lahir_ayah" class="form-label">Tempat Lahir Ayah / Wali <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tempat_lahir_ayah"
                                        name="tempat_lahir_ayah" required
                                        value="{{ old('tempat_lahir_ayah', $form_data['tempat_lahir_ayah'] ?? '') }}"
                                        placeholder="Masukkan kota/tempat lahir">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tgl_lahir_ayah" class="form-label">Tanggal Lahir Ayah / Wali <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tgl_lahir_ayah" name="tgl_lahir_ayah"
                                        required
                                        value="{{ old('tgl_lahir_ayah', $form_data['tgl_lahir_ayah'] ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="agama_ayah" class="form-label">Agama Ayah / Wali <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="agama_ayah" name="agama_ayah"
                                        required value="{{ old('agama_ayah', $form_data['agama_ayah'] ?? '') }}"
                                        placeholder="Masukkan agama">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah / Wali <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pekerjaan_ayah"
                                        name="pekerjaan_ayah" required
                                        value="{{ old('pekerjaan_ayah', $form_data['pekerjaan_ayah'] ?? '') }}"
                                        placeholder="Masukkan pekerjaan ayah / wali">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="penghasilan_ayah" class="form-label">Penghasilan Ayah / Wali <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="penghasilan_ayah" name="penghasilan_ayah">
                                        <option value="">Pilih Penghasilan</option>
                                        <option value="0"
                                            {{ old('penghasilan_ayah', $form_data['penghasilan_ayah'] ?? '') == '0' ? 'selected' : '' }}>
                                            Tidak Berpenghasilan</option>
                                        <option value="Kurang Dari 1.000.000"
                                            {{ old('penghasilan_ayah', $form_data['penghasilan_ayah'] ?? '') == 'Kurang Dari 1.000.000' ? 'selected' : '' }}>
                                            Kurang
                                            Dari
                                            1.000.000</option>
                                        <option value="1.000.000 - 3.000.000"
                                            {{ old('penghasilan_ayah', $form_data['penghasilan_ayah'] ?? '') == '1.000.000 - 3.000.000' ? 'selected' : '' }}>
                                            1.000.000 -
                                            3.000.000</option>
                                        <option value="3.000.000 - 5.000.000"
                                            {{ old('penghasilan_ayah', $form_data['penghasilan_ayah'] ?? '') == '3.000.000 - 5.000.000' ? 'selected' : '' }}>
                                            3.000.000 -
                                            5.000.000</option>
                                        <option value="Lebih Dari 5.000.000"
                                            {{ old('penghasilan_ayah', $form_data['penghasilan_ayah'] ?? '') == 'Lebih Dari 5.000.000' ? 'selected' : '' }}>
                                            Lebih
                                            Dari 5.000.000
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Data Ibu -->
                            <h4 class="text-danger">Data Ibu</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_ibu" class="form-label">Nama Ibu <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                        required value="{{ old('nama_ibu', $form_data['nama_ibu'] ?? '') }}"
                                        placeholder="Masukkan nama lengkap ibu">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nik_ibu" class="form-label">NIK Ibu <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="nik_ibu" name="nik_ibu"
                                        required maxlength="16" oninput="validasiNIK(this)"
                                        title="NIK harus terdiri dari 16 digit angka"
                                        value="{{ old('nik_ibu', $form_data['nik_ibu'] ?? '') }}"
                                        placeholder="Masukkan 16 digit NIK">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status_ibu" class="form-label">Status Ibu <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="status_ibu" name="status_ibu" required>
                                        <option value="Hidup"
                                            {{ old('status_ibu', $form_data['status_ibu'] ?? '') == 'Hidup' ? 'selected' : '' }}>
                                            Hidup</option>
                                        <option value="Meninggal"
                                            {{ old('status_ibu', $form_data['status_ibu'] ?? '') == 'Meninggal' ? 'selected' : '' }}>
                                            Meninggal</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_ibu" class="form-label">No. Telepon Ibu <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_ibu" name="no_ibu"
                                        required pattern="(\+62|62|0)8[1-9][0-9]{7,10}"
                                        title="Nomor telepon harus dimulai dengan 08xx atau +62xx dan memiliki 9-12 digit."
                                        value="{{ old('no_ibu', $form_data['no_ibu'] ?? '') }}"
                                        placeholder="Masukkan no telepon aktif">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tempat_lahir_ibu" class="form-label">Tempat Lahir Ibu <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tempat_lahir_ibu"
                                        name="tempat_lahir_ibu" required
                                        value="{{ old('tempat_lahir_ibu', $form_data['tempat_lahir_ibu'] ?? '') }}"
                                        placeholder="Masukkan kota/tempat lahir">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tgl_lahir_ibu" class="form-label">Tanggal Lahir Ibu <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tgl_lahir_ibu"
                                        name="tgl_lahir_ibu" required
                                        value="{{ old('tgl_lahir_ibu', $form_data['tgl_lahir_ibu'] ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="agama_ibu" class="form-label">Agama Ibu <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="agama_ibu" name="agama_ibu"
                                        required value="{{ old('agama_ibu', $form_data['agama_ibu'] ?? '') }}"
                                        placeholder="Masukkan agama">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pekerjaan_ibu"
                                        name="pekerjaan_ibu" required
                                        value="{{ old('pekerjaan_ibu', $form_data['pekerjaan_ibu'] ?? '') }}"
                                        placeholder="Masukkan pekerjaan">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="penghasilan_ibu" class="form-label">Penghasilan Ibu <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="penghasilan_ibu" name="penghasilan_ibu">
                                        <option value="">Pilih Penghasilan</option>
                                        <option value="0"
                                            {{ old('penghasilan_ayah', $form_data['penghasilan_ayah'] ?? '') == '0' ? 'selected' : '' }}>
                                            Tidak Berpenghasilan</option>
                                        <option value="Kurang Dari 1.000.000"
                                            {{ old('penghasilan_ibu', $form_data['penghasilan_ibu'] ?? '') == 'Kurang Dari 1.000.000' ? 'selected' : '' }}>
                                            Kurang
                                            Dari
                                            1.000.000</option>
                                        <option value="1.000.000 - 3.000.000"
                                            {{ old('penghasilan_ibu', $form_data['penghasilan_ibu'] ?? '') == '1.000.000 - 3.000.000' ? 'selected' : '' }}>
                                            1.000.000
                                            -
                                            3.000.000</option>
                                        <option value="3.000.000 - 5.000.000"
                                            {{ old('penghasilan_ibu', $form_data['penghasilan_ibu'] ?? '') == '3.000.000 - 5.000.000' ? 'selected' : '' }}>
                                            3.000.000
                                            -
                                            5.000.000</option>
                                        <option value="Lebih Dari 5.000.000"
                                            {{ old('penghasilan_ibu', $form_data['penghasilan_ibu'] ?? '') == 'Lebih Dari 5.000.000' ? 'selected' : '' }}>
                                            Lebih Dari
                                            5.000.000
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="alamat_orangtua" class="form-label">Alamat Orang Tua <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat_orangtua" name="alamat_orangtua" required
                                    placeholder="Masukkan alamat lengkap">{{ old('alamat_orangtua', $form_data['alamat_orangtua'] ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <a href="{{ route('ppdb.step1') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Selanjutnya</button>
                        </div>
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validasiForm() {
            let today = new Date().toISOString().split("T")[0];
            if (document.getElementById("tgl_lahir_ayah").value > today || document.getElementById("tgl_lahir_ibu").value >
                today) {
                alert("Tanggal lahir tidak boleh di masa depan!");
                return false;
            }
            return true;
        }

        function validasiNIK(input) {
            input.value = input.value.replace(/[^0-9]/g, '').slice(0, 16);
        }
        document.getElementById('no_ibu').addEventListener('input', function(e) {
            let value = e.target.value;
            let regex = /^(\+62|62|0)8[1-9][0-9]{7,10}$/; // Format nomor Indonesia
            if (!regex.test(value)) {
                e.target.setCustomValidity(
                    "Nomor telepon harus dimulai dengan 08xx atau +62xx dan memiliki 9-12 digit.");
            } else {
                e.target.setCustomValidity("");
            }
        });
        document.getElementById('no_ayah').addEventListener('input', function(e) {
            let value = e.target.value;
            let regex = /^(\+62|62|0)8[1-9][0-9]{7,10}$/; // Format nomor Indonesia
            if (!regex.test(value)) {
                e.target.setCustomValidity(
                    "Nomor telepon harus dimulai dengan 08xx atau +62xx dan memiliki 9-12 digit."
                );
            } else {
                e.target.setCustomValidity("");
            }
            e.target.reportValidity(); // Memunculkan alert validasi
        });
    </script>
</body>

</html>

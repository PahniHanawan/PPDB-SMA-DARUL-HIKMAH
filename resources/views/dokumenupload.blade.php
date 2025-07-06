<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Pendaftaran PSPDB SMA Darul Hikmah</h2>
                <div class="card shadow-sm rounded-3">
                    <div class="card-header bg-primary text-white text-center fw-bold">
                        <i class="fas fa-file-alt me-2"></i> STEP 3/3 - Dokumen
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ppdb.storeStep3') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_user" value="{{ auth()->id() }}">
                            <p class="fw-bold">Silakan unggah dokumen yang diperlukan (maksimal 2MB):</p>

                            <!-- Input File dengan Preview & Batas Ukuran -->
                            <div class="mb-3">
                                <label for="pasfoto" class="form-label">Pas Foto <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="pasfoto" name="pasfoto"
                                    onchange="validateFile(this, 'previewPasfoto')">
                                <small class="text-muted">Ukuran maksimal: 2MB</small>
                                <img id="previewPasfoto" class="mt-2 img-thumbnail"
                                    style="display: none; max-width: 150px;">
                                <span class="text-danger d-none" id="errorPasfoto">Ukuran file terlalu besar!</span>
                            </div>

                            <div class="mb-3">
                                <label for="skl" class="form-label">Surat Keterangan Lulus (SKL) <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="skl" name="skl"
                                    onchange="validateFile(this, 'previewSkl')">
                                <small class="text-muted">Ukuran maksimal: 2MB</small>
                                <img id="previewSkl" class="mt-2 img-thumbnail"
                                    style="display: none; max-width: 150px;">
                                <span class="text-danger d-none" id="errorSkl">Ukuran file terlalu besar!</span>
                            </div>

                            <div class="mb-3">
                                <label for="ijazah" class="form-label">Ijazah (Jika Belum ada tidak perlu di
                                    upload)</label>
                                <input type="file" class="form-control" id="ijazah" name="ijazah"
                                    onchange="validateFile(this, 'previewIjazah')">
                                <small class="text-muted">Ukuran maksimal: 2MB (Jika Belum ada tidak perlu di
                                    upload)</small>
                                <img id="previewIjazah" class="mt-2 img-thumbnail"
                                    style="display: none; max-width: 150px;">
                                <span class="text-danger d-none" id="errorIjazah">Ukuran file terlalu besar!</span>
                            </div>


                            <div class="mb-3">
                                <label for="kk" class="form-label">Kartu Keluarga (KK) <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="kk" name="kk"
                                    onchange="validateFile(this, 'previewKk')">
                                <small class="text-muted">Ukuran maksimal: 2MB</small>
                                <img id="previewKk" class="mt-2 img-thumbnail" style="display: none; max-width: 150px;">
                                <span class="text-danger d-none" id="errorKk">Ukuran file terlalu besar!</span>
                            </div>

                            <div class="mb-3">
                                <label for="akte" class="form-label">Akte Kelahiran <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="akte" name="akte"
                                    onchange="validateFile(this, 'previewAkte')">
                                <small class="text-muted">Ukuran maksimal: 2MB</small>
                                <img id="previewAkte" class="mt-2 img-thumbnail"
                                    style="display: none; max-width: 150px;">
                                <span class="text-danger d-none" id="errorAkte">Ukuran file terlalu besar!</span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('ppdb.step2') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-success" id="submitButton">
                                    <i class="fas fa-check-circle"></i> Daftar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Preview & Validasi Ukuran File -->
    <script>
        function validateFile(input, previewId) {
            var file = input.files[0];
            var errorElement = document.getElementById("error" + previewId.replace('preview', ''));

            if (file) {
                if (file.size > 2 * 1024 * 1024) { // 2MB
                    errorElement.classList.remove('d-none');
                    input.value = ""; // Reset input file
                    return;
                } else {
                    errorElement.classList.add('d-none');
                }

                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = document.getElementById(previewId);
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>

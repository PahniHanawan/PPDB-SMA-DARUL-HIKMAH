<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 0 auto;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            padding: 10px 0;
            position: relative;
        }

        .logo {
            width: 100px;
            height: auto;
            position: absolute;
            left: 0;
            top: -15px;
            /* Geser logo ke atas */
        }

        .header-text {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            width: 100%;
            flex-grow: 1;
        }

        .sub-header {
            text-align: center;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0;
        }

        hr {
            border: 1px solid black;
            width: 100%;
            margin: 10px 0;
        }

        .section-title {
            font-size: 13px;
            font-weight: bold;
            margin-top: 15px;
            border-bottom: 1px solid black;
            padding-bottom: 3px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td {
            padding: 5px;
            vertical-align: middle;
        }

        .table td:first-child {
            width: 40%;
            text-align: left;
            white-space: nowrap;
        }

        .table td:last-child {
            width: 60%;
            text-align: left;
        }

        .signature {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        @if ($logoData)
            <img src="data:image/png;base64,{{ $logoData }}" class="logo">
        @endif
        <div class="header-text">
            YAYASAN PENDIDIKAN ISLAM AL HIKMAH CIKONENG <br>
            <strong>SMA DARUL HIKMAH BOJONGSOANG</strong><br>
            "TERAKREDITASI A"
        </div>
    </div>

    <div class="sub-header">
        Jl. Cikoneng No 99 RT 005 RW 008 Ds/Kec. Bojongsoang Kab. Bandung 40288 Telp. 0838-6695-0699
    </div>
    <hr>
    <div class="title">
        FORMULIR PENERIMAAN PESERTA DIDIK BARU<br>
        TAHUN PELAJARAN 2025/2026
    </div>

    <div class="section-container">
        <div class="section">
            <div class="section-title">A. KETERANGAN CALON PESERTA DIDIK</div>
            <table class="table">
                <tr>
                    <td>1. Nama Lengkap</td>
                    <td>: {{ $pendaftaran->nama }}</td>
                </tr>
                <tr>
                    <td>2. NIK</td>
                    <td>: {{ $pendaftaran->nik }}</td>
                </tr>
                <tr>
                    <td>3. NISN</td>
                    <td>: {{ $pendaftaran->nisn }}</td>
                </tr>
                <tr>
                    <td>4. Jenis Kelamin</td>
                    <td>: {{ $pendaftaran->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td>5. Agama</td>
                    <td>: {{ $pendaftaran->agama }}</td>
                </tr>
                <tr>
                    <td>6. Tempat, Tgl. Lahir</td>
                    <td>: {{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <td>7. Alamat</td>
                    <td>: {{ $pendaftaran->alamat }}</td>
                </tr>
                <tr>
                    <td>8. Sekolah Asal</td>
                    <td>: {{ $pendaftaran->asal_sekolah }}</td>
                </tr>
                <tr>
                    <td>9. No. Telepon / Hp</td>
                    <td>: {{ $pendaftaran->notelp }}</td>
                </tr>
                <tr>
                    <td>10. Nilai Rata-Rata</td>
                    <td>: {{ $pendaftaran->nilai_rata_rata }}</td>
                </tr>
                <tr>
                    <td>11. Status Pendaftaran</td>
                    <td>: {{ $pendaftaran->status_pendaftaran }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">B. KETERANGAN ORANG TUA / Wali</div>
            <table class="table">
                <tr>
                    <td>1. Nama Ayah</td>
                    <td>: {{ $orangtua->nama_ayah }}</td>
                </tr>
                <tr>
                    <td>2. No Telp Ayah</td>
                    <td>: {{ $orangtua->no_ayah }}</td>
                </tr>
                <tr>
                    <td>3. Tempat, Tgl. Lahir</td>
                    <td>: {{ $orangtua->tempat_lahir_ayah }}, {{ $orangtua->tgl_lahir_ayah }}</td>
                </tr>
                <tr>
                    <td>4. Pekerjaan Ayah</td>
                    <td>: {{ $orangtua->pekerjaan_ayah }}</td>
                </tr>
                <tr>
                    <td>5. Penghasilan Ayah</td>
                    <td>: {{ $orangtua->penghasilan_ayah }}</td>
                </tr>
                <tr>
                    <td>6. Nama Ibu</td>
                    <td>: {{ $orangtua->nama_ibu }}</td>
                </tr>
                <tr>
                    <td>7. No Telp Ibu</td>
                    <td>: {{ $orangtua->no_ibu }}</td>
                </tr>
                <tr>
                    <td>8. Tempat, Tgl. Lahir</td>
                    <td>: {{ $orangtua->tempat_lahir_ibu }}, {{ $orangtua->tgl_lahir_ibu }}</td>
                </tr>
                <tr>
                    <td>9. Pekerjaan Ibu</td>
                    <td>: {{ $orangtua->pekerjaan_ibu }}</td>
                </tr>
                <tr>
                    <td>10. Penghasilan Ibu</td>
                    <td>: {{ $orangtua->penghasilan_ibu }}</td>
                </tr>
                <tr>
                    <td>11. Alamat Orang Tua</td>
                    <td>: {{ $orangtua->alamat_orangtua }}</td>
                </tr>
            </table>
        </div>
        <div class="section">
            <hr>
            @foreach ($dokumens->where('kategori_dokumen', 'PasFoto') as $dokumen)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            @if (in_array(pathinfo($dokumen->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ public_path($dokumen->file_path) }}" class="img-fluid rounded"
                                    alt="{{ $dokumen->nama_dokumen }}" style="width: 100px; height: 130px;">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="signature">
            Bandung, {{ now()->format('d-m-Y') }} <br>
            Orang Tua / Wali Siswa, <br><br><br>
            (.....................................)
        </div>


</body>

</html>

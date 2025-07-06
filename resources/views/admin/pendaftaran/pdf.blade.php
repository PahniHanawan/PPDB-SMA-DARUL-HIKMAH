<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Semua Pendaftar Diterima</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
            margin: 10px 30px;
        }

        .page-break {
            page-break-after: always;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header img {
            width: 60px;
            position: absolute;
            left: 40px;
            top: 15px;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        td {
            padding: 3px 5px;
            vertical-align: top;
        }

        .section-title {
            font-weight: bold;
            margin-top: 10px;
            text-decoration: underline;
        }

        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>

<body>

    @foreach ($pendaftarans as $index => $pendaftaran)
        <div class="header">
            @if ($logoData)
                <img src="data:image/png;base64,{{ $logoData }}">
            @endif
            <div>
                <strong>YAYASAN PENDIDIKAN ISLAM AL HIKMAH CIKONENG</strong><br>
                <strong>SMA DARUL HIKMAH BOJONGSOANG</strong><br>
                Terakreditasi A<br>
                Jl. Cikoneng No 99, Bojongsoang - Kab. Bandung, Telp. 0838-6695-0699
            </div>
            <div class="title">Formulir Penerimaan Peserta Didik Baru<br>Tahun Pelajaran 2025/2026</div>
        </div>

        <div class="section-title">A. Data Siswa</div>
        <table>
            <tr>
                <td>Nama</td>
                <td>: {{ $pendaftaran->nama }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $pendaftaran->nik }}</td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>: {{ $pendaftaran->nisn }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $pendaftaran->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>: {{ $pendaftaran->agama }}</td>
            </tr>
            <tr>
                <td>Tempat, Tgl Lahir</td>
                <td>: {{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>Sekolah Asal</td>
                <td>: {{ $pendaftaran->asal_sekolah }}</td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td>: {{ $pendaftaran->notelp }}</td>
            </tr>
            <tr>
                <td>Nilai Rata-Rata</td>
                <td>: {{ $pendaftaran->nilai_rata_rata }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: {{ $pendaftaran->status_pendaftaran }}</td>
            </tr>
        </table>

        <div class="footer">
            Bandung, {{ now()->format('d-m-Y') }}<br>
            Panitia PPDB
        </div>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

</body>

</html>

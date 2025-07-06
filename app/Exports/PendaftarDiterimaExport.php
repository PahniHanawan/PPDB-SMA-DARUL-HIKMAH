<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendaftarDiterimaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pendaftaran::where('status_pendaftaran', 'Diterima')
            ->select('nama', 'nik', 'nisn', 'jenis_kelamin', 'agama', 'notelp', 'nilai_rata_rata', 'status_pendaftaran')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIK',
            'NISN',
            'Jenis Kelamin',
            'Agama',
            'No Telepon',
            'Nilai Rata-Rata',
            'Status',
        ];
    }
}

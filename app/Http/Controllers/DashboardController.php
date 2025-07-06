<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Orangtua;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        // Statistik Umum
        $statistics = [
            'total' => Pendaftaran::count(),
            'accepted' => Pendaftaran::where('status_pendaftaran', 'diterima')->count(),
            'pending' => Pendaftaran::where('status_pendaftaran', 'pending')->count(),
            'rejected' => Pendaftaran::where('status_pendaftaran', 'ditolak')->count(),
        ];

        // Ambil data jumlah pendaftar dalam 12 bulan terakhir per status
        $dataPendaftar = Pendaftaran::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as bulan, COUNT(*) as total")
            ->whereBetween('created_at', [now()->subMonths(11)->startOfMonth(), now()->endOfMonth()])
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get()
            ->keyBy('bulan');

        // Data per status
        $acceptedData = Pendaftaran::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as bulan, COUNT(*) as total")
            ->where('status_pendaftaran', 'diterima')
            ->whereBetween('created_at', [now()->subMonths(11)->startOfMonth(), now()->endOfMonth()])
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get()
            ->keyBy('bulan');

        $pendingData = Pendaftaran::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as bulan, COUNT(*) as total")
            ->where('status_pendaftaran', 'pending')
            ->whereBetween('created_at', [now()->subMonths(11)->startOfMonth(), now()->endOfMonth()])
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get()
            ->keyBy('bulan');

        $rejectedData = Pendaftaran::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as bulan, COUNT(*) as total")
            ->where('status_pendaftaran', 'ditolak')
            ->whereBetween('created_at', [now()->subMonths(11)->startOfMonth(), now()->endOfMonth()])
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get()
            ->keyBy('bulan');

        // Inisialisasi array bulan dan data
        $months = [];
        $totals = [];
        $acceptedCounts = [];
        $pendingCounts = [];
        $rejectedCounts = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i)->startOfMonth();
            $bulanTahun = $date->format('Y-m'); // Format: "2025-01", "2025-02", dst.

            $months[] = $date->translatedFormat('F Y'); // Nama bulan dalam bahasa Indonesia
            $totals[] = $dataPendaftar[$bulanTahun]->total ?? 0;
            $acceptedCounts[] = $acceptedData[$bulanTahun]->total ?? 0;
            $pendingCounts[] = $pendingData[$bulanTahun]->total ?? 0;
            $rejectedCounts[] = $rejectedData[$bulanTahun]->total ?? 0;
        }

        return view('admin.index', compact('statistics', 'months', 'totals', 'acceptedCounts', 'pendingCounts', 'rejectedCounts','title'));
    }

    public function step1()
    {
        $isRegistered = DB::table('pendaftarans')->where('id_user', Auth::id())->exists();

        if ($isRegistered) {
            return redirect('/')->with('error', 'Anda sudah mendaftar dan tidak bisa mendaftar lagi.');
        }
        $form_data = Session::get('step1', []); // Ambil data dari session jika ada
        return view('pendaftaran', compact('form_data'));
    }

    public function storeStep1(Request $request)
    {
       $request->validate([
        'nama' => 'required|string',
        'nik' => 'required|digits:16|numeric|unique:pendaftarans,nik',
        'nisn' => 'required|numeric|unique:pendaftarans,nisn',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'agama' => 'required|string',
        'tempat_lahir' => 'required|string',
        'alamat' => 'required|string',
        'asal_sekolah' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'notelp' => [
        'required',
        'string',
        'max:15',
        'regex:/^(\+62|62|0)8[1-9][0-9]{7,10}$/'
    ],
    'nilai_rata_rata' => 'required|numeric|between:0,100',
], [
    'notelp.regex' => 'Nomor telepon harus dimulai dengan 08xx atau +62xx dan memiliki 9-12 digit.',
]);
        Session::put('step1', array_merge($request->all(), ['user_id' => Auth::id()]));
        return redirect()->route('ppdb.step2');
    }

    public function step2()
    {
        $form_data = Session::get('step2', []); // Ambil data dari session jika ada
        return view('biodataorangtua', compact('form_data'));
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            'nama_ayah' => 'required|string|max:255',
            'nik_ayah' => 'required|digits:16|numeric|unique:orangtuas,nik_ayah',
            'status_ayah' => 'required|in:Hidup,Meninggal',
            'no_ayah' => [
                'required',
                'string',
                'max:15',
                'regex:/^(\+62|62|0)8[1-9][0-9]{7,10}$/'
            ],
            'tempat_lahir_ayah' => 'required|string',
            'tgl_lahir_ayah' => 'required|date',
            'agama_ayah' => 'required|string|max:20',
            'pekerjaan_ayah' => 'required|string|max:255',
            'penghasilan_ayah' => 'nullable|string',

            'nama_ibu' => 'required|string|max:255',
            'nik_ibu' => 'required|digits:16|numeric|unique:orangtuas,nik_ibu',
            'status_ibu' => 'required|in:Hidup,Meninggal',
            'no_ibu' => [
                'required',
                'string',
                'max:15',
                'regex:/^(\+62|62|0)8[1-9][0-9]{7,10}$/'
            ],
            'tempat_lahir_ibu' => 'required|string',
            'tgl_lahir_ibu' => 'required|date',
            'agama_ibu' => 'required|string|max:20',
            'pekerjaan_ibu' => 'required|string|max:255',
            'penghasilan_ibu' => 'nullable|string',

            'alamat_orangtua' => 'nullable|string|max:255',
        ],[
    'no_ayah.regex' => 'Nomor telepon harus dimulai dengan 08xx atau +62xx dan memiliki 9-12 digit.',
    'no_ibu.regex' => 'Nomor telepon harus dimulai dengan 08xx atau +62xx dan memiliki 9-12 digit.',
]);

        Session::put('step2', array_merge($request->all(), ['user_id' => Auth::id()]));
        return redirect()->route('ppdb.step3');
    }

    public function step3()
    {
        return view('dokumenupload');
    }

    public function storeStep3(Request $request)
{
    $request->validate([
        'pasfoto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'skl' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'ijazah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'akte' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    // Simpan data ke database saat terakhir
    $step1 = Session::get('step1');
    $step2 = Session::get('step2');

    $dataDiri = Pendaftaran::create($step1);
    $step2['data_diri_id'] = $dataDiri->id;
    Orangtua::create($step2);

    $user_id = Auth::id();


    $dokumen_kategori = [
        'pasfoto' => 'PasFoto',
        'skl' => 'SKL',
        'ijazah' => 'Ijazah',
        'kk' => 'KK',
        'akte' => 'Akte'
    ];

   foreach ($dokumen_kategori as $input_name => $kategori) {
    if ($request->hasFile($input_name)) {
        $file = $request->file($input_name);
        $filename = time() . '_' . $file->getClientOriginalName(); // Hindari duplikasi nama
        $file->move(public_path('uploads/dokumen'), $filename);

        $path = 'uploads/dokumen/' . $filename;

        Dokumen::create([
            'id_user' => $user_id,
            'nama_dokumen' => $file->getClientOriginalName(),
            'file_path' => $path,
            'kategori_dokumen' => $kategori,
        ]);
    }
}


    // Hapus session setelah data tersimpan
    Session::forget(['step1', 'step2']);

    return redirect()->route('ppdb.success');
}

    public function status()
    {
        // Ambil data pendaftaran berdasarkan user yang sedang login
        $id_user = Auth::id();

        // Ambil data pendaftaran berdasarkan user_id
        $pendaftaran = Pendaftaran::where('id_user', $id_user)->first();

        // Jika belum mendaftar, alihkan ke halaman pengisian formulir
        if (!$pendaftaran) {
            return redirect()->route('pendaftaran.form')->with('warning', 'Silakan lengkapi formulir pendaftaran terlebih dahulu.');
        }

        // Kirim data ke view status.blade.php
        return view('status', compact('pendaftaran'));
    }


    public function success()
    {
        // Ambil ID user yang sedang login
        $id_user = Auth::id();

        // Ambil data pendaftaran berdasarkan user_id
        $pendaftaran = Pendaftaran::where('id_user', $id_user)->first();
        return redirect()->route('status.pendaftaran', compact('pendaftaran'));
    }

    public function downloadPDF($id)
    {
        $pendaftaran = Pendaftaran::with('user')->findOrFail($id);
        $orangtua = Orangtua::where('id_user', $pendaftaran->id_user)->first();
        $dokumens = Dokumen::where('id_user', $pendaftaran->id_user)->get();
        $logoPath = public_path('uploads/dokumen/logo.png');
        $logoData = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;
        // Kirim data ke view PDF
        $pdf = Pdf::loadView('pdf.pendaftaran', compact('pendaftaran','orangtua','dokumens','logoData'));

        return $pdf->download('Pendaftaran_' . $pendaftaran->nama . '.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Orangtua;
use App\Models\Dokumen;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PendaftarDiterimaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    /**
     * Menampilkan daftar pendaftaran (hanya untuk admin)
     */
    public function index()
    {
        $title = 'Data Pendaftar';
        $pendaftarans = Pendaftaran::with('user')->get();
        $pendaftaranspag = Pendaftaran::orderByDesc('nilai_rata_rata')->paginate(10); // Urutkan dari yang tertinggi
        return view('admin.pendaftaran.index', compact('pendaftarans', 'pendaftaranspag','title'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diterima,Ditolak',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status_pendaftaran = $request->status;
        $pendaftaran->save();

        return response()->json([
            'success' => true,
            'message' => 'Status pendaftaran berhasil diperbarui!',
        ]);
    }

    public function show($id)
    {
        $title = 'Detail Pendaftar';
        $pendaftaran = Pendaftaran::with('user')->findOrFail($id);

        $orangtua = Orangtua::where('id_user', $pendaftaran->id_user)->first();
        $dokumens = Dokumen::where('id_user', $pendaftaran->id_user)->get();

        return view('admin.pendaftaran.detail', compact('pendaftaran', 'orangtua', 'dokumens','title'));
    }

    public function showDiterima()
    {
        $pendaftaran = Pendaftaran::where('status_pendaftaran', 'Diterima')->get();
        return view('admin.pendaftaran.diterima', [
            'title' => 'Data Pendaftar Diterima',
            'pendaftaran' => $pendaftaran
        ]);
    }

public function exportDiterimaExcel()
{
    return Excel::download(new PendaftarDiterimaExport, 'Pendaftar_Diterima.xlsx');
}

public function exportPdf()
{
    $pendaftarans = Pendaftaran::where('status_pendaftaran', 'Diterima')->get();

    $pdf = Pdf::loadView('admin.pendaftaran.pdf', compact('pendaftarans'));
    return $pdf->download('pendaftar_diterima.pdf');
}

    /**
     * Menghapus data pendaftaran (hanya admin)
     */
    public function destroy($id)
    {
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            return redirect()->route('pendaftaran.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus data.');
        }

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil dihapus!');
    }
}

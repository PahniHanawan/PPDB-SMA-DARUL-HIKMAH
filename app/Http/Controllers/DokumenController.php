<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    /**
     * Menampilkan daftar dokumen
     */
    public function index()
    {
        $dokumens = Dokumen::where('id_user', Auth::id())->get();
        return view('admin.dokumen.index', compact('dokumens'));
    }

    /**
     * Menghapus dokumen
     */
    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // Hapus file dari storage
        Storage::disk('public')->delete($dokumen->file_path);

        // Hapus data dari database
        $dokumen->delete();

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}

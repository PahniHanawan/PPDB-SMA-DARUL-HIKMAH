<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orangtua;
use Illuminate\Support\Facades\Auth;

class OrangtuaController extends Controller
{
    /**
     * Menampilkan daftar data orang tua (untuk admin)
     */
    public function index()
    {
        $orangtuas = Orangtua::with('user')->get();
        return view('admin.orangtua.index', compact('orangtuas'));
    }
}

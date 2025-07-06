<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        // Ambil data user dengan pagination (10 user per halaman)
        $title = 'Manajemen Pengguna';
        $users = User::paginate(10);
        return view('admin.usermanage', compact('users','title'));
    }

    public function updateRole(Request $request, $id)
    {
        // Validasi input agar role hanya bisa 'admin' atau 'cpd'
        $request->validate([
            'role' => 'required|in:admin,cpd',
        ]);

        // Update role user
        User::where('id', $id)->update(['role' => $request->role]);

        return redirect()->back()->with('success', 'Role user berhasil diperbarui.');
    }
}

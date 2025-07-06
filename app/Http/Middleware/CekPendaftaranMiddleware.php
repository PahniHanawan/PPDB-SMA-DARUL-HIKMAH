<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CekPendaftaranMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $isRegistered = DB::table('pendaftarans')->where('id_user', Auth::id())->exists();

            if ($isRegistered) {
                return redirect('/')->with('error', 'Anda sudah mendaftar dan tidak bisa mendaftar lagi.');
            }
        }

        return $next($request);
    }
}

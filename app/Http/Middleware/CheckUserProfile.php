<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();
        $details = $user->details;

        // Jika ada field wajib yang kosong
        if (
            $user->role_id == 3 && (
                empty($details?->identity) ||
                empty($details?->identity_image) ||
                empty($details?->address) ||
                empty($details?->zip_code) ||
                empty($details?->state) ||
                empty($details?->phone) ||
                empty($details?->gender)
            )
        ) {
            return redirect()->back()->with('error', 'Harap lengkapi profil Anda sebelum membuat laporan');
        }

        // Setelah field wajib terisi, cek status verifikasi
        if ($user->role_id == 3 && $details?->status == 0) {
            return redirect()->back()->with('error', 'Admin sedang memverifikasi akun anda. Anda belum bisa membuat laporan');
        }

        return $next($request);
    }
}

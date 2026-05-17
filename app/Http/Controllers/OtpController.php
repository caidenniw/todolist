<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;

class OtpController extends Controller
{
    public function index()
    {
        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|numeric|digits:6',
        ]);

        $user = Auth::user();

        // Cek kesesuaian dan waktu kedaluwarsa
        if ($user->otp_code == $request->otp_code && now()->lessThanOrEqualTo($user->otp_expires_at)) {
            $user->update([
                'is_verified' => true,
                'otp_code' => null,
                'otp_expires_at' => null,
            ]);

            return redirect()->route('tasks.index')->with('success', 'Akun berhasil diverifikasi!');
        }

        return back()->with('error', 'Kode OTP salah atau sudah kedaluwarsa.');
    }

    public function resend()
    {
        $user = Auth::user();
        $otp = rand(100000, 999999);

        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        Mail::to($user->email)->send(new SendOtpMail($otp));

        return back()->with('success', 'Kode OTP baru telah dikirim ke email kamu.');
    }
}
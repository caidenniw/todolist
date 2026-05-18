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

        try {
            // Kirim via SendGrid API langsung
            $email = new \SendGrid\Mail\Mail();
            $email->setFrom(config('mail.from.address'), config('mail.from.name'));
            $email->setSubject('Kode Verifikasi OTP - Dive');
            $email->addTo($user->email, $user->name);
            
            // Render email template
            $emailContent = view('emails.otp', ['otp' => $otp])->render();
            $email->addContent("text/html", $emailContent);
            
            $sendgrid = new \SendGrid(env('MAIL_PASSWORD'));
            $response = $sendgrid->send($email);
            
            if ($response->statusCode() == 202) {
                return back()->with('success', 'Kode OTP baru telah dikirim ke email kamu.');
            } else {
                return back()->with('error', 'Gagal mengirim email. Coba lagi.');
            }
        } catch (\Exception $e) {
            \Log::error('Failed to resend OTP: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengirim email. Coba lagi.');
        }
    }
}
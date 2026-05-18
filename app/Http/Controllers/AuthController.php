<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('tasks.index');
        }
        return view('auth.login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('tasks.index');
        }
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('tasks.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
            'is_verified' => false,
        ]);

       // 3. Kirim Email OTP via SendGrid API
        try {
            // Set timeout 10 detik untuk kirim email
            ini_set('max_execution_time', 10);
            
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
            
            if ($response->statusCode() != 202) {
                throw new \Exception('SendGrid returned status: ' . $response->statusCode());
            }
            
        } catch (\Exception $e) {
            // Log error tapi tetap lanjut
            \Log::error('Failed to send OTP email: ' . $e->getMessage());
            
            // Simpan info bahwa email gagal dikirim
            session()->flash('email_failed', true);
        }

        // 4. Langsung login-kan session-nya
        Auth::login($user);

        // 5. Arahkan ke halaman verifikasi OTP
        return redirect()->route('otp.verify');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

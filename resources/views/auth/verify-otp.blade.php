<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verifikasi OTP - Dive</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0ea5e9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        
        .otp-container {
            max-width: 480px;
            width: 100%;
        }
        
        .otp-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(30px);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 3rem 2.5rem;
            animation: fadeInUp 0.8s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .logo {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: center;
            margin-bottom: 0.5rem;
            letter-spacing: -1px;
        }
        
        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }
        
        .email-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }
        
        .otp-input {
            width: 100%;
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 1rem;
            padding: 1.25rem;
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }
        
        .otp-input:focus {
            outline: none;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        }
        
        .btn-verify {
            width: 100%;
            background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
            color: white;
            border: none;
            border-radius: 15px;
            padding: 1rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(14, 165, 233, 0.4);
        }
        
        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(14, 165, 233, 0.5);
        }
        
        .resend-section {
            text-align: center;
            margin-top: 1.5rem;
            color: #64748b;
            font-size: 0.9rem;
        }
        
        .btn-resend {
            background: none;
            border: none;
            color: #0ea5e9;
            font-weight: 600;
            cursor: pointer;
            text-decoration: underline;
        }
        
        .btn-resend:hover {
            color: #0284c7;
        }
        
        .alert {
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        
        @media (max-width: 576px) {
            .otp-card {
                padding: 2rem 1.5rem;
            }
            
            .logo {
                font-size: 2rem;
            }
            
            .otp-input {
                font-size: 1.5rem;
                letter-spacing: 0.5rem;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="otp-container">
        <div class="otp-card">
            <div class="logo">Dive</div>
            <div class="subtitle">Verifikasi Akun Kamu</div>
            
            <div class="email-icon">
                <i class="bi bi-envelope-check"></i>
            </div>
            
            <p style="text-align: center; color: #64748b; margin-bottom: 2rem; line-height: 1.6;">
                Kami telah mengirim kode verifikasi 6 digit ke email kamu. 
                Masukkan kode tersebut di bawah ini.
            </p>
            
            <div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 1rem; margin-bottom: 2rem; border-radius: 8px;">
                <p style="margin: 0; color: #856404; font-size: 0.9rem; line-height: 1.5;">
                    <i class="bi bi-info-circle"></i> <strong>Tips:</strong> Jika email tidak masuk dalam 1-2 menit, 
                    <strong>cek folder Spam/Junk</strong> di email kamu. Email mungkin tersaring sebagai spam.
                </p>
            </div>
            
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            
            @if(session('email_failed'))
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i> Email OTP gagal dikirim. Silakan klik "Kirim Ulang" di bawah.
                </div>
            @endif
            
            <form action="{{ route('otp.verify.submit') }}" method="POST">
                @csrf
                <input type="text" 
                       name="otp_code" 
                       class="otp-input" 
                       maxlength="6" 
                       placeholder="000000"
                       pattern="[0-9]{6}"
                       required 
                       autocomplete="off"
                       autofocus>
                
                <button type="submit" class="btn-verify">
                    <i class="bi bi-shield-check"></i> Verifikasi Sekarang
                </button>
            </form>
            
            <div class="resend-section">
                Belum menerima kode?
                <form action="{{ route('otp.resend') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-resend">Kirim Ulang</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi OTP - Dive</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f3f4f6; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%); padding: 30px; text-align: center;">
                            <h1 style="color: white; margin: 0; font-size: 32px; font-weight: bold;">Dive</h1>
                            <p style="color: rgba(255,255,255,0.9); margin: 5px 0 0 0; font-size: 14px;">Task Management App</p>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="color: #111827; margin: 0 0 20px 0; font-size: 24px;">Verifikasi Akun Anda</h2>
                            
                            <p style="color: #4b5563; line-height: 1.6; margin: 0 0 20px 0; font-size: 16px;">
                                Terima kasih telah mendaftar di <strong>Dive</strong>! Untuk melanjutkan, silakan gunakan kode verifikasi berikut:
                            </p>
                            
                            <!-- OTP Box -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 30px 0;">
                                <tr>
                                    <td align="center" style="background-color: #f3f4f6; padding: 25px; border-radius: 8px;">
                                        <div style="font-size: 36px; font-weight: bold; letter-spacing: 12px; color: #0ea5e9; font-family: 'Courier New', monospace;">
                                            {{ $otp }}
                                        </div>
                                        <p style="color: #6b7280; font-size: 13px; margin: 10px 0 0 0;">
                                            Kode berlaku selama 5 menit
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="color: #6b7280; line-height: 1.6; margin: 20px 0 0 0; font-size: 14px;">
                                Jika Anda tidak melakukan pendaftaran ini, abaikan email ini. Akun Anda tetap aman.
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 20px 30px; border-top: 1px solid #e5e7eb;">
                            <p style="color: #9ca3af; font-size: 12px; margin: 0; text-align: center; line-height: 1.5;">
                                Email ini dikirim oleh <strong>Dive App</strong><br>
                                Jika ada pertanyaan, hubungi kami di <a href="mailto:caidentoken@gmail.com" style="color: #0ea5e9; text-decoration: none;">caidentoken@gmail.com</a>
                            </p>
                            <p style="color: #9ca3af; font-size: 11px; margin: 15px 0 0 0; text-align: center;">
                                © 2026 Dive App. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
                
                <!-- Unsubscribe Link (Important for spam score!) -->
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="margin-top: 20px;">
                    <tr>
                        <td align="center">
                            <p style="color: #9ca3af; font-size: 11px; margin: 0;">
                                Email ini dikirim ke alamat yang terdaftar di sistem kami.<br>
                                <a href="#" style="color: #0ea5e9; text-decoration: none;">Berhenti berlangganan</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
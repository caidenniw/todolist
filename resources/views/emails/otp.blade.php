<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi OTP - Dive</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6;">
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; padding: 20px; background-color: white; border: 1px solid #e5e7eb; border-radius: 8px;">
        <h2 style="color: #111827; margin-top: 0;">Verifikasi Akun Kamu</h2>
        <p style="color: #4b5563; line-height: 1.6;">Halo, gunakan kode di bawah ini untuk memverifikasi akun Dive kamu. Kode ini berlaku selama 5 menit.</p>
        <div style="background-color: #f3f4f6; padding: 20px; text-align: center; border-radius: 6px; margin: 30px 0;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 8px; color: #4f46e5;">{{ $otp }}</span>
        </div>
        <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">Jika kamu tidak merasa mendaftar, abaikan saja email ini.</p>
        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 20px 0;">
        <p style="color: #9ca3af; font-size: 12px; text-align: center;">© 2026 Dive App. All rights reserved.</p>
    </div>
</body>
</html>
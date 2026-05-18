# 🔧 Troubleshooting Email OTP di Railway

## 🔴 Problem: Loading Lama + Error 500 Saat Register

### **Gejala:**
- User klik "Buat Akun"
- Loading sangat lama (30-60 detik)
- User berhasil masuk ke database
- Tapi muncul Error 500
- Email OTP tidak terkirim

### **Penyebab:**
Gmail SMTP connection timeout atau blocked oleh Railway/Gmail security.

---

## ✅ **SOLUSI YANG SUDAH DITERAPKAN**

### **1. Error Handling & Timeout Protection**

Sekarang aplikasi akan:
- ✅ Tetap redirect ke halaman verify-otp meskipun email gagal
- ✅ Tampilkan pesan warning jika email gagal
- ✅ User bisa klik "Kirim Ulang" untuk retry
- ✅ Timeout maksimal 10 detik untuk kirim email

### **2. Implementasi ShouldQueue**

Email sekarang bisa dikirim via queue (background job) jika diperlukan.

---

## 🧪 **TESTING & DEBUGGING**

### **Step 1: Aktifkan Debug Mode**

Di Railway Variables, ubah:
```env
APP_DEBUG=true
LOG_LEVEL=debug
```

Restart service, lalu coba register. Sekarang kamu akan lihat error detail.

### **Step 2: Cek Railway Logs**

Buka Railway → Deploy Logs, cari error seperti:
```
Failed to send OTP email: Connection timeout
Failed to send OTP email: SMTP Error
```

### **Step 3: Test Email Configuration**

Coba alternatif port:

**Option A: Port 587 (TLS)**
```env
MAIL_PORT=587
MAIL_ENCRYPTION=tls
```

**Option B: Port 465 (SSL) - Current**
```env
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
```

---

## 🚀 **SOLUSI ALTERNATIF**

### **Option 1: Gunakan Mailtrap (Development)**

Untuk testing, gunakan Mailtrap.io:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
```

### **Option 2: Gunakan SendGrid (Production)**

SendGrid lebih reliable untuk production:

1. Daftar di https://sendgrid.com (Free tier: 100 email/day)
2. Buat API Key
3. Update Railway Variables:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-verified-email@domain.com
MAIL_FROM_NAME=Dive App
```

### **Option 3: Gunakan Mailgun**

1. Daftar di https://mailgun.com
2. Verify domain
3. Update Railway Variables:

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.com
MAILGUN_SECRET=your-mailgun-api-key
MAIL_FROM_ADDRESS=noreply@your-domain.com
MAIL_FROM_NAME=Dive App
```

### **Option 4: Disable OTP Sementara (Emergency)**

Jika urgent dan email tidak bisa jalan, bisa disable OTP sementara:

**Di `AuthController.php`:**
```php
$user = User::create([
    'name' => $validated['name'],
    'email' => $validated['email'],
    'password' => Hash::make($validated['password']),
    'is_verified' => true, // ← Langsung verified
    // 'otp_code' => $otp,
    // 'otp_expires_at' => now()->addMinutes(5),
]);

// Comment kirim email
// Mail::to($user->email)->send(new SendOtpMail($otp));

Auth::login($user);

// Langsung ke dashboard
return redirect()->route('tasks.index');
```

---

## 📊 **CHECKLIST DEBUGGING**

- [ ] Environment variables email sudah benar di Railway
- [ ] `APP_DEBUG=true` untuk lihat error detail
- [ ] Cek Railway logs untuk error message
- [ ] Test dengan port 587 (TLS) sebagai alternatif
- [ ] Pastikan Gmail App Password masih valid
- [ ] Test kirim email manual via Railway console:
  ```bash
  php artisan tinker
  Mail::raw('Test', function($msg) { $msg->to('test@example.com')->subject('Test'); });
  ```
- [ ] Pertimbangkan gunakan SendGrid/Mailgun untuk production

---

## 🎯 **EXPECTED BEHAVIOR SEKARANG**

### **Scenario 1: Email Berhasil Terkirim**
1. User register
2. Loading 2-5 detik
3. Redirect ke verify-otp
4. Email masuk ke inbox
5. User input OTP
6. Redirect ke dashboard

### **Scenario 2: Email Gagal Terkirim**
1. User register
2. Loading maksimal 10 detik (timeout)
3. Redirect ke verify-otp
4. Tampil warning: "Email OTP gagal dikirim"
5. User klik "Kirim Ulang"
6. Retry kirim email
7. Jika berhasil → Email masuk
8. User input OTP
9. Redirect ke dashboard

---

## 🔍 **COMMAND DEBUGGING DI RAILWAY**

### **Test Email Configuration:**
```bash
php artisan tinker

# Test kirim email
Mail::raw('Test OTP Email', function($message) {
    $message->to('your-email@gmail.com')
            ->subject('Test Email from Railway');
});

# Cek queue jobs (jika pakai queue)
DB::table('jobs')->count();
```

### **Cek User di Database:**
```bash
php artisan tinker

# Lihat user terakhir
User::latest()->first();

# Update user jadi verified (emergency)
User::where('email', 'user@example.com')->update(['is_verified' => true]);
```

---

## 📝 **NOTES**

- Gmail SMTP sering di-block di shared hosting/cloud
- SendGrid/Mailgun lebih reliable untuk production
- Queue worker perlu setup terpisah di Railway (butuh worker dyno)
- Untuk development, Mailtrap.io sangat recommended

---

**Last Updated:** May 18, 2026

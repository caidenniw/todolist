# 🚀 Deploy Dive dengan Fitur OTP ke Railway

## 📋 Persiapan Sebelum Deploy

### 1. Pastikan Semua File Sudah Commit
```bash
git add .
git commit -m "Add OTP verification feature"
git push origin main
```

### 2. File-File Penting yang Sudah Disiapkan
✅ `nixpacks.toml` - Konfigurasi build Railway
✅ `Procfile` - Auto migration saat deploy
✅ `.env.example` - Template environment variables
✅ Migration OTP - `database/migrations/2026_05_17_181507_add_otp_columns_to_users_table.php`

---

## 🔧 Langkah Deploy ke Railway

### **STEP 1: Push ke Git Repository**

```bash
# Pastikan semua perubahan sudah di-commit
git status

# Jika ada file yang belum di-commit
git add .
git commit -m "Add OTP email verification system"

# Push ke repository (GitHub/GitLab)
git push origin main
```

### **STEP 2: Railway akan Auto-Deploy**

Karena proyekmu sudah terhubung dengan Railway, setelah push, Railway akan:
1. ✅ Detect perubahan di repository
2. ✅ Trigger build otomatis
3. ✅ Jalankan migration (termasuk migration OTP baru)
4. ✅ Deploy aplikasi

**Proses ini biasanya memakan waktu 3-5 menit.**

---

## ⚙️ Environment Variables yang Harus Ditambahkan di Railway

Buka **Railway Dashboard** → Pilih proyekmu → Tab **Variables**, lalu tambahkan:

### **1. Database Variables (Sudah Ada - Tidak Perlu Diubah)**
```env
DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
```

### **2. Email Variables (BARU - HARUS DITAMBAHKAN!)**

#### **Untuk Gmail:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=caidentoken@gmail.com
MAIL_PASSWORD=pqligywsnqwmtjqj
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=caidentoken@gmail.com
MAIL_FROM_NAME=Dive App
```

> **⚠️ PENTING:** 
> - Gunakan **App Password** Gmail, bukan password biasa
> - Cara buat App Password: Google Account → Security → 2-Step Verification → App passwords

### **3. App Variables (Sudah Ada - Pastikan Benar)**
```env
APP_NAME=Dive
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-actual-railway-url.railway.app
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

---

## 📧 Cara Membuat Gmail App Password

1. Buka: https://myaccount.google.com/security
2. Aktifkan **2-Step Verification** (jika belum)
3. Scroll ke bawah → Klik **App passwords**
4. Pilih **Mail** dan **Other (Custom name)** → Ketik "Dive App"
5. Klik **Generate**
6. Copy password 16 digit yang muncul
7. Paste ke `MAIL_PASSWORD` di Railway

---

## 🔍 Cara Cek Deploy Berhasil

### **1. Cek Build Logs di Railway**
- Buka Railway Dashboard
- Klik tab **Deployments**
- Lihat log build terbaru
- Pastikan tidak ada error

### **2. Cek Migration Berhasil**
Di log Railway, cari baris seperti ini:
```
Running migrations...
Migrating: 2026_05_17_181507_add_otp_columns_to_users_table
Migrated:  2026_05_17_181507_add_otp_columns_to_users_table (XX.XXms)
```

### **3. Test Aplikasi**
1. Buka URL Railway kamu: `https://your-app.railway.app`
2. Klik **Register**
3. Isi form registrasi
4. Klik **Buat Akun**
5. **Cek email** → Harus ada email dengan kode OTP
6. Masukkan kode OTP di halaman verifikasi
7. Seharusnya redirect ke dashboard Dive

---

## 🐛 Troubleshooting

### **Problem 1: Email Tidak Terkirim**
**Solusi:**
- Pastikan `MAIL_MAILER=smtp` (bukan `log`)
- Cek `MAIL_USERNAME` dan `MAIL_PASSWORD` benar
- Pastikan menggunakan **App Password**, bukan password Gmail biasa
- Cek Railway logs untuk error email

### **Problem 2: Migration Error**
**Error:** `SQLSTATE[42S21]: Column already exists: otp_code`

**Solusi:**
```sql
-- Login ke Railway MySQL
-- Hapus kolom yang sudah ada (jika perlu)
ALTER TABLE users DROP COLUMN otp_code;
ALTER TABLE users DROP COLUMN otp_expires_at;
ALTER TABLE users DROP COLUMN is_verified;

-- Atau rollback migration
php artisan migrate:rollback --step=1
php artisan migrate
```

### **Problem 3: Halaman Putih Setelah Register**
**Solusi:**
- Cek Railway logs untuk error
- Pastikan route `otp.verify` terdaftar
- Clear cache: `php artisan optimize:clear`

### **Problem 4: User Lama Tidak Bisa Login**
**Penyebab:** User lama tidak punya kolom `is_verified`

**Solusi:** Update user lama di database:
```sql
UPDATE users SET is_verified = 1 WHERE otp_code IS NULL;
```

Atau lewat Railway MySQL console:
1. Buka Railway → MySQL service → Connect
2. Jalankan query di atas

---

## 📊 Struktur Database Setelah Migration

Tabel `users` sekarang memiliki kolom tambahan:

| Kolom | Type | Keterangan |
|-------|------|------------|
| `otp_code` | string | Kode OTP 6 digit |
| `otp_expires_at` | timestamp | Waktu kedaluwarsa OTP (5 menit) |
| `is_verified` | boolean | Status verifikasi (default: false) |

---

## ✅ Checklist Deploy

- [ ] Commit semua perubahan ke Git
- [ ] Push ke repository (GitHub/GitLab)
- [ ] Tambahkan environment variables email di Railway
- [ ] Tunggu Railway auto-deploy selesai
- [ ] Cek build logs tidak ada error
- [ ] Test register dengan email asli
- [ ] Cek email masuk dengan kode OTP
- [ ] Test verifikasi OTP berhasil
- [ ] Test login user yang sudah verified
- [ ] Update user lama agar `is_verified = true`

---

## 🎯 Command Berguna

```bash
# Cek status git
git status

# Commit dan push
git add .
git commit -m "Add OTP verification"
git push origin main

# Jika perlu rollback migration (di Railway console)
php artisan migrate:rollback --step=1

# Clear cache (di Railway console)
php artisan optimize:clear

# Cek route terdaftar (di Railway console)
php artisan route:list | grep otp
```

---

## 📞 Support

Jika ada masalah saat deploy:
1. Cek Railway logs terlebih dahulu
2. Pastikan semua environment variables sudah benar
3. Test email configuration di local dulu sebelum deploy
4. Pastikan Gmail App Password valid

---

**Good luck with your deployment! 🚀**

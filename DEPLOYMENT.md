# 🚂 Deploy Dive to Railway

Panduan lengkap deploy aplikasi Dive ke Railway.

## 📋 Persiapan

### 1. Push ke GitHub

```bash
# Initialize git (jika belum)
git init

# Add all files
git add .

# Commit
git commit -m "Initial commit - Dive Task Manager"

# Create main branch
git branch -M main

# Add remote (ganti dengan URL repo Anda)
git remote add origin https://github.com/username/dive-todo.git

# Push
git push -u origin main
```

## 🚀 Deploy ke Railway

### Step 1: Buat Project di Railway

1. Buka [railway.app](https://railway.app)
2. Login dengan GitHub
3. Klik **"New Project"**
4. Pilih **"Deploy from GitHub repo"**
5. Pilih repository Anda
6. Railway akan otomatis detect Laravel

### Step 2: Tambah MySQL Database

1. Di project Railway, klik **"New"**
2. Pilih **"Database"**
3. Pilih **"Add MySQL"**
4. Tunggu database selesai dibuat

### Step 3: Configure Environment Variables

Klik service Laravel Anda → **"Variables"** → Tambahkan:

```env
APP_NAME=Dive
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.up.railway.app

# Generate APP_KEY dengan command:
# php artisan key:generate --show
APP_KEY=base64:PASTE_YOUR_KEY_HERE

# Database (Railway auto-fill ini dari MySQL service)
DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQL_HOST}}
DB_PORT=${{MySQL.MYSQL_PORT}}
DB_DATABASE=${{MySQL.MYSQL_DATABASE}}
DB_USERNAME=${{MySQL.MYSQL_USER}}
DB_PASSWORD=${{MySQL.MYSQL_PASSWORD}}

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Log
LOG_CHANNEL=stack
LOG_LEVEL=error
```

### Step 4: Generate APP_KEY

Di local, jalankan:

```bash
php artisan key:generate --show
```

Copy output (contoh: `base64:abc123...`) dan paste ke Railway variable `APP_KEY`.

### Step 5: Deploy!

1. Railway akan otomatis deploy setelah Anda push ke GitHub
2. Atau klik **"Deploy"** manual di Railway dashboard
3. Tunggu build selesai (±3-5 menit)
4. Klik **"View Logs"** untuk monitor progress

### Step 6: Akses Aplikasi

1. Setelah deploy sukses, klik **"Settings"**
2. Scroll ke **"Domains"**
3. Klik **"Generate Domain"**
4. Copy URL (contoh: `dive-todo.up.railway.app`)
5. Update `APP_URL` di Variables dengan URL ini
6. Redeploy (Railway auto-redeploy saat variable berubah)

## ✅ Verifikasi

Buka URL Railway Anda:
- Halaman login harus muncul
- Register akun baru
- Test create/edit/delete tasks
- Test logout/login

## 🔧 Troubleshooting

### Error: "No application encryption key"
- Generate key: `php artisan key:generate --show`
- Paste ke Railway variable `APP_KEY`

### Error: Database connection
- Pastikan MySQL service sudah running
- Cek variable `DB_*` sudah benar
- Format: `${{MySQL.MYSQL_HOST}}` (dengan kurung kurawal ganda)

### Error: 500 Internal Server Error
- Cek logs di Railway: **"View Logs"**
- Set `APP_DEBUG=true` sementara untuk lihat error detail
- Jangan lupa set kembali ke `false` setelah fix

### Migration tidak jalan
Railway otomatis run migration via `nixpacks.toml`. Jika gagal:
1. Buka Railway **"Settings"** → **"Deploy"**
2. Klik **"Redeploy"**

### Assets tidak load (CSS/JS)
Aplikasi ini menggunakan CDN (Bootstrap, Icons) jadi tidak perlu build assets.

## 📊 Monitoring

- **Logs:** Railway Dashboard → Service → "View Logs"
- **Metrics:** Railway Dashboard → Service → "Metrics"
- **Database:** Railway Dashboard → MySQL → "Data"

## 💰 Pricing

Railway Free Tier:
- $5 credit per month
- Cukup untuk aplikasi kecil-menengah
- Auto-sleep jika tidak ada traffic

Upgrade ke Pro jika perlu:
- $20/month
- No sleep
- More resources

## 🔄 Update Aplikasi

Setiap kali push ke GitHub, Railway otomatis deploy:

```bash
git add .
git commit -m "Update feature"
git push
```

Railway akan:
1. Detect changes
2. Build ulang
3. Run migrations
4. Deploy versi baru

## 🎉 Selesai!

Aplikasi Dive Anda sekarang live di internet! 🌊

Share URL ke teman-teman:
`https://your-app.up.railway.app`

---

**Need help?** Check Railway docs: https://docs.railway.app

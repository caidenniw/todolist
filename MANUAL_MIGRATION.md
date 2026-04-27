# 🔧 Cara Migrasi Manual di Railway

Jika Anda **tidak** menggunakan auto-migration (`--force` di start command), berikut cara migrasi manual.

## 🎯 Pilihan Cara:

### ⭐ Cara 1: Via Setup Route (Paling Mudah)

Saya sudah buatkan route khusus untuk setup database.

**Langkah:**

1. **Deploy aplikasi** ke Railway (tanpa auto-migration)
2. **Buka browser** dan akses:
   ```
   https://your-app.railway.app/setup-database-now
   ```
3. Tunggu beberapa detik, akan muncul response JSON:
   ```json
   {
     "status": "success",
     "message": "Database setup completed!",
     "note": "Please delete routes/setup.php file now!"
   }
   ```
4. **Hapus file** `routes/setup.php` dari project
5. **Push ke GitHub** lagi
6. **Done!** Database sudah ter-migrate dan ter-seed

**Keuntungan:**
- ✅ Paling mudah, cukup buka URL
- ✅ Tidak perlu install tools tambahan
- ✅ Bisa dilakukan dari browser

**Kekurangan:**
- ⚠️ Harus hapus route setelah selesai (security)

---

### 🔧 Cara 2: Custom Start Command

**Langkah:**

1. **Railway Dashboard** → Klik service Laravel
2. **Settings** → Scroll ke **"Deploy"**
3. Di **"Custom Start Command"** isi:
   ```bash
   php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT
   ```
4. **Save** (Railway auto-redeploy)
5. **Cek logs** - migration akan jalan
6. Setelah selesai, **hapus Custom Start Command** (kosongkan)
7. **Save** lagi - Railway akan pakai command default

**Keuntungan:**
- ✅ Langsung dari Railway dashboard
- ✅ Tidak perlu edit code

**Kekurangan:**
- ⚠️ Harus manual set/unset command

---

### 💻 Cara 3: Railway CLI

**Install Railway CLI:**

**Windows (PowerShell):**
```powershell
iwr https://railway.app/install.ps1 | iex
```

**Mac/Linux:**
```bash
curl -fsSL https://railway.app/install.sh | sh
```

**Jalankan Migration:**

```bash
# Login
railway login

# Link ke project
railway link

# Pilih service Laravel Anda

# Run migration
railway run php artisan migrate --force

# Run seeder (optional)
railway run php artisan db:seed --force

# Cek database
railway run php artisan tinker
```

**Keuntungan:**
- ✅ Bisa run command apapun
- ✅ Seperti SSH ke server
- ✅ Bisa dipakai berkali-kali

**Kekurangan:**
- ⚠️ Harus install CLI dulu

---

### 🔄 Cara 4: One-Time Migration Service

**Langkah:**

1. **Railway Dashboard** → **"New"** → **"Empty Service"**
2. **Settings** → **"Source"** → Connect ke repo yang sama
3. **Variables** → Copy semua variables dari Laravel service (terutama `DB_*`)
4. **Custom Start Command**:
   ```bash
   php artisan migrate --force && php artisan db:seed --force && echo "Done!" && sleep 3600
   ```
5. **Deploy**
6. **Cek logs** - migration akan jalan
7. Setelah selesai, **delete service ini**

**Keuntungan:**
- ✅ Tidak ganggu service utama
- ✅ Bisa monitor logs dengan jelas

**Kekurangan:**
- ⚠️ Harus buat service baru (temporary)

---

## 🎯 Rekomendasi:

### Untuk Setup Awal:
**Gunakan Cara 1 (Setup Route)** - Paling mudah!

### Untuk Development/Testing:
**Gunakan Cara 3 (Railway CLI)** - Paling fleksibel

### Untuk Production:
**Gunakan Auto-Migration** di `nixpacks.toml`:
```toml
[start]
cmd = 'php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT'
```

---

## ⚠️ Catatan Penting:

### Tentang `--seed`:

**Development/Testing:**
```bash
php artisan migrate --force --seed
```
- Akan create user test + data contoh
- Bagus untuk testing

**Production:**
```bash
php artisan migrate --force
```
- JANGAN pakai `--seed`
- Biarkan user register sendiri
- Data production harus real, bukan dummy

### Tentang `--force`:

Flag `--force` diperlukan di production karena Laravel akan tanya konfirmasi:
```
Do you really wish to run this command? (yes/no)
```

Dengan `--force`, Laravel skip konfirmasi dan langsung run.

---

## 🔍 Cara Cek Migration Berhasil:

### Via Railway CLI:
```bash
railway run php artisan migrate:status
```

### Via Setup Route:
Buka: `https://your-app.railway.app/setup-database-now`

Jika sudah setup, akan muncul:
```
Database already setup!
```

### Via Browser:
Coba register user baru di aplikasi. Jika berhasil = migration sukses!

---

## 🆘 Troubleshooting:

### Error: "Connection refused"
- Cek variables `DB_*` sudah benar
- Format: `${{MySQL.MYSQLHOST}}` (tanpa underscore)

### Error: "Table already exists"
- Migration sudah pernah jalan
- Tidak perlu run lagi

### Error: "SQLSTATE[42S02]: Base table not found"
- Migration belum jalan
- Jalankan salah satu cara di atas

---

## ✅ Checklist:

- [ ] MySQL service status: Active
- [ ] Variables database sudah benar
- [ ] Migration berhasil (cek logs)
- [ ] Bisa register user baru
- [ ] Bisa create/edit/delete tasks
- [ ] File `routes/setup.php` sudah dihapus (jika pakai Cara 1)

---

**Selesai!** Database Anda sudah siap digunakan! 🎉

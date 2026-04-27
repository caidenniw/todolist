# ⚡ Quick Fix - Session Issue di Railway

## 🎯 Langkah Cepat:

### 1. Tambah Variables di Railway

**Railway Dashboard** → Service Laravel → **Variables** → **Raw Editor**

Tambahkan baris ini di bagian bawah:

```env
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
ASSET_URL=https://your-app.railway.app
```

**Ganti `your-app.railway.app` dengan URL Railway Anda!**

### 2. Pastikan APP_URL Pakai HTTPS

Cek variable `APP_URL`, harus:

```env
APP_URL=https://your-app.railway.app
```

BUKAN `http://` tapi `https://`!

### 3. Push Code Baru

Saya sudah tambahkan file `TrustProxies.php` dan update `bootstrap/app.php`.

Push ke GitHub:

```bash
git add .
git commit -m "Fix session for Railway HTTPS"
git push
```

Railway akan auto-redeploy.

### 4. Clear Browser Cache

**Penting!** Setelah deploy selesai:

1. **Chrome/Edge:** Ctrl + Shift + Delete → Clear cache
2. **Firefox:** Ctrl + Shift + Delete → Clear cache
3. Atau buka **Incognito/Private mode**

### 5. Test Login

1. Buka URL Railway
2. Register user baru
3. Seharusnya redirect ke dashboard
4. Coba logout dan login lagi
5. Done! ✅

---

## 📋 Checklist:

- [ ] Variable `SESSION_SECURE_COOKIE=true` sudah ditambah
- [ ] Variable `APP_URL` pakai `https://`
- [ ] Variable `ASSET_URL` sudah ditambah
- [ ] Code sudah di-push ke GitHub
- [ ] Railway sudah redeploy (cek status: Active)
- [ ] Browser cache sudah di-clear
- [ ] Test login berhasil

---

## 🆘 Masih Error?

Baca file **`RAILWAY_SESSION_FIX.md`** untuk troubleshooting lengkap!

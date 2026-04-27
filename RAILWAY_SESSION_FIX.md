# 🔒 Fix Session/Login Issue di Railway

## ❌ Masalah:
- Setelah login, redirect ke halaman tidak aman
- Browser block karena mixed content (HTTP/HTTPS)
- Session tidak tersimpan
- Terus redirect ke login

## ✅ Solusi:

### Step 1: Tambah Environment Variables

Di **Railway Dashboard** → Service Laravel → **Variables** → Tambahkan:

```env
# Existing variables...
APP_NAME=Dive
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.railway.app
APP_KEY=base64:xxxxx

# Database...
DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
# ... dst

# ⭐ TAMBAHKAN INI (Session & Security):
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax

# ⭐ TAMBAHKAN INI (Force HTTPS):
ASSET_URL=https://your-app.railway.app
```

**PENTING:** Ganti `your-app.railway.app` dengan URL Railway Anda yang sebenarnya!

### Step 2: Update APP_URL

Pastikan `APP_URL` menggunakan **HTTPS** (bukan HTTP):

```env
# SALAH ❌
APP_URL=http://your-app.railway.app

# BENAR ✅
APP_URL=https://your-app.railway.app
```

### Step 3: Tambah Trusted Proxies

Buat file baru untuk handle proxy Railway:

**File:** `app/Http/Middleware/TrustProxies.php`

Pastikan isinya seperti ini:

```php
<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies = '*'; // Trust all proxies (Railway)

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
```

### Step 4: Clear Cache & Redeploy

Di Railway, setelah update variables:
1. Railway akan **auto-redeploy**
2. Tunggu deploy selesai
3. **Clear browser cache** (Ctrl + Shift + Delete)
4. Coba login lagi

---

## 🔍 Penjelasan:

### Kenapa Terjadi?

Railway menggunakan **reverse proxy**:
```
Browser (HTTPS) → Railway Proxy (HTTPS) → Laravel App (HTTP)
```

Laravel melihat request sebagai HTTP, padahal user akses via HTTPS.

Akibatnya:
- Cookie tidak bisa di-set (browser block HTTP cookie di HTTPS page)
- Redirect ke HTTP (tidak aman)
- Session hilang

### Solusi:

1. **`SESSION_SECURE_COOKIE=true`** - Cookie hanya dikirim via HTTPS
2. **`APP_URL=https://...`** - Laravel tahu base URL adalah HTTPS
3. **`TrustProxies`** - Laravel trust Railway proxy dan detect HTTPS dengan benar

---

## 📝 Complete Environment Variables

Copy paste ini ke Railway Variables (Raw Editor):

```env
APP_NAME=Dive
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.railway.app
APP_KEY=base64:YOUR_KEY_HERE

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax

CACHE_STORE=database
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=error

BCRYPT_ROUNDS=12

ASSET_URL=https://your-app.railway.app
```

**Jangan lupa ganti:**
- `your-app.railway.app` dengan URL Railway Anda
- `YOUR_KEY_HERE` dengan hasil `php artisan key:generate --show`

---

## ✅ Cara Test:

1. **Clear browser cache** (penting!)
2. Buka URL Railway di **Incognito/Private mode**
3. Coba **register** user baru
4. Seharusnya redirect ke dashboard tasks
5. Coba **logout** dan **login** lagi
6. Seharusnya tidak ada masalah

---

## 🆘 Masih Error?

### Error: "419 Page Expired" atau "CSRF Token Mismatch"

**Solusi:**
1. Clear browser cache
2. Pastikan `SESSION_SECURE_COOKIE=true`
3. Pastikan `APP_URL` pakai HTTPS

### Error: Redirect Loop (terus ke login)

**Solusi:**
1. Cek `TrustProxies` middleware sudah benar
2. Pastikan `$proxies = '*'`
3. Clear cache: `php artisan config:clear`

### Error: "Mixed Content" di browser console

**Solusi:**
1. Pastikan `ASSET_URL=https://...`
2. Pastikan `APP_URL=https://...`
3. Jangan ada hardcoded `http://` di code

---

## 🎉 Selesai!

Setelah fix ini, aplikasi Anda akan:
- ✅ Login/logout lancar
- ✅ Session tersimpan dengan benar
- ✅ Tidak ada warning "not secure"
- ✅ Bisa diakses dari HP/PC dengan aman

---

**Need help?** Check Railway docs tentang HTTPS: https://docs.railway.app/guides/public-networking

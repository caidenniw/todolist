# 🔧 Fix Error "Connection Refused" di Railway

## ❌ Error yang Terjadi:
```
SQLSTATE[HY000] [2002] Connection refused
(Connection: mysql, Host: 127.0.0.1, Port: 3306)
```

## ✅ Solusi:

### 1. Cek Nama MySQL Service

Di Railway dashboard:
1. Klik **MySQL service** Anda
2. Lihat nama di bagian atas (contoh: "MySQL", "mysql", "database")
3. **Catat nama ini** (case-sensitive!)

### 2. Set Variables dengan Format yang BENAR

Klik **Laravel service** → Tab **"Variables"** → **"Raw Editor"**

**Jika nama MySQL service adalah "MySQL":**
```env
APP_NAME=Dive
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_HERE

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
LOG_CHANNEL=stack
LOG_LEVEL=error
```

**PENTING:** 
- Gunakan `MYSQLHOST` BUKAN `MYSQL_HOST` (tanpa underscore!)
- Gunakan `MYSQLUSER` BUKAN `MYSQL_USER`
- Gunakan `MYSQLPASSWORD` BUKAN `MYSQL_PASSWORD`

### 3. Generate APP_KEY

Di local terminal:
```bash
php artisan key:generate --show
```

Copy hasilnya (contoh: `base64:abc123xyz...`) dan paste ke variable `APP_KEY` di Railway.

### 4. Restart Services

1. Klik **MySQL service** → Settings → **Restart**
2. Tunggu status jadi **Active** (hijau)
3. Klik **Laravel service** → Settings → **Restart**

### 5. Cek Logs

Klik Laravel service → **Deployments** → Click deployment terbaru → **View Logs**

Tunggu sampai muncul:
```
Server running on [http://0.0.0.0:xxxx]
```

## 🎯 Checklist

- [ ] MySQL service status: **Active**
- [ ] Variable format: `${{MySQL.MYSQLHOST}}` (tanpa underscore)
- [ ] APP_KEY sudah di-generate dan di-set
- [ ] Kedua service sudah di-restart
- [ ] Logs tidak ada error "Connection refused"

## 📝 Contoh Variables yang Benar

```env
APP_NAME=Dive
APP_ENV=production
APP_DEBUG=false
APP_URL=https://web-production-xxxx.up.railway.app
APP_KEY=base64:abcdefghijklmnopqrstuvwxyz1234567890=

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
LOG_CHANNEL=stack
LOG_LEVEL=error
BCRYPT_ROUNDS=12
```

## 🔍 Cara Cek Variable MySQL

1. Klik **MySQL service**
2. Tab **"Variables"**
3. Lihat variables yang tersedia:
   - `MYSQLHOST`
   - `MYSQLPORT`
   - `MYSQLDATABASE`
   - `MYSQLUSER`
   - `MYSQLPASSWORD`

Gunakan nama yang PERSIS SAMA di Laravel service dengan format `${{NamaService.VARIABLE}}`.

## ✅ Setelah Fix

Aplikasi akan:
1. Connect ke MySQL dengan benar
2. Run migrations otomatis
3. Start server
4. Bisa diakses via URL Railway

Buka URL Railway Anda dan halaman login harus muncul! 🎉

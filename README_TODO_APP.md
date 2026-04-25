# 📝 Modern To-Do List Application

Aplikasi To-Do List yang modern, interaktif, dan elegan dengan Laravel & Bootstrap 5.

## ✨ Fitur Utama

### 🎨 Desain & UI/UX
- **Clean & Modern UI** dengan gradient background yang menarik
- **Dark Mode** otomatis dengan toggle yang smooth
- **Fully Responsive** - sempurna di semua perangkat
- **Smooth Animations** - transisi halus untuk pengalaman premium
- **Glass Morphism Design** - efek kaca modern dan elegan

### 🚀 Fungsionalitas
- **CRUD Lengkap** - Create, Read, Update, Delete tasks
- **AJAX** - Seamless experience tanpa reload halaman
- **Real-time Search** - Pencarian dinamis
- **Priority System** - High (🔴), Medium (🟡), Low (🟢)
- **Categories** - Work (💼), Personal (👤), Shopping (🛒)
- **Deadline Management** - Dengan indikator waktu yang jelas
- **Task Statistics** - Dashboard dengan statistik real-time
- **Filter & Sort** - Filter berdasarkan priority dan category

### 🛠️ Teknologi
- **Laravel 12** - Framework PHP modern
- **Bootstrap 5** - CSS framework via CDN (tanpa NPM!)
- **Bootstrap Icons** - Icon library
- **Vanilla JavaScript** - Tanpa framework JS tambahan
- **Eloquent ORM** - Database management yang elegant
- **SQLite** - Database yang simple dan cepat

## 📦 Instalasi

### 1. Install Dependencies PHP

```bash
composer install
```

### 2. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Setup Database

```bash
# Buat file database SQLite
touch database/database.sqlite

# Jalankan migrations
php artisan migrate

# (Optional) Seed dengan data contoh
php artisan db:seed
```

### 4. Jalankan Server

```bash
php artisan serve
```

Buka browser dan akses: `http://localhost:8000`

## 🎯 Cara Penggunaan

### Menambah Task
1. Isi form "Add New Task"
2. Masukkan judul task (required)
3. Pilih priority dan category
4. Set deadline (optional)
5. Klik "Add Task"

### Menyelesaikan Task
- Klik checkbox di sebelah kiri task untuk menandai selesai/belum selesai

### Menghapus Task
- Klik icon trash di sebelah kanan task

### Filter & Search
- Gunakan search box untuk mencari task
- Filter berdasarkan priority atau category
- Kombinasikan filter untuk hasil yang lebih spesifik

### Dark Mode
- Klik icon bulan/matahari di pojok kanan atas
- Preferensi akan tersimpan di localStorage

## 📁 Struktur File

```
app/
├── Http/Controllers/
│   └── TaskController.php      # Controller untuk CRUD operations
├── Models/
│   └── Task.php                # Model dengan scopes dan helpers

database/
├── migrations/
│   └── 2024_01_01_000003_create_tasks_table.php
└── seeders/
    ├── DatabaseSeeder.php
    └── TaskSeeder.php          # Sample data

resources/
└── views/
    └── tasks/
        └── index.blade.php     # Main view (Bootstrap 5 + Vanilla JS)

routes/
└── web.php                     # API routes
```

## 🎨 Kustomisasi

### Mengubah Warna Gradient
Edit bagian `<style>` di `resources/views/tasks/index.blade.php`:

```css
body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
```

### Menambah Category Baru
1. Update migration: `database/migrations/*_create_tasks_table.php`
2. Update model: `app/Models/Task.php`
3. Update view: tambahkan option di select category

### Menambah Priority Level
Sama seperti menambah category, update di migration, model, dan view.

## 🔒 Best Practices yang Diterapkan

- ✅ **CSRF Protection** - Semua form dilindungi CSRF token
- ✅ **Input Validation** - Validasi ketat di controller
- ✅ **Eloquent ORM** - Query yang aman dan efficient
- ✅ **RESTful API** - Routing yang terstruktur
- ✅ **Responsive Design** - Mobile-first approach
- ✅ **XSS Protection** - HTML escaping di JavaScript
- ✅ **Performance** - Optimized queries, CDN assets
- ✅ **Code Organization** - Separation of concerns

## 🚀 Keuntungan Tanpa NPM

- ✅ **Setup Cepat** - Tidak perlu install Node.js
- ✅ **Lebih Ringan** - Tidak ada node_modules folder
- ✅ **Simple** - Langsung jalankan `php artisan serve`
- ✅ **CDN** - Assets loaded dari CDN (cepat & reliable)
- ✅ **No Build Process** - Tidak perlu compile/build

## 📝 API Endpoints

```
GET    /                      # List all tasks
POST   /tasks                 # Create new task
PUT    /tasks/{id}            # Update task
DELETE /tasks/{id}            # Delete task
PATCH  /tasks/{id}/toggle     # Toggle task completion
```

## 🎓 Teknologi yang Dipelajari

Dengan mengerjakan project ini, Anda akan belajar:
- Laravel routing & controllers
- Eloquent ORM & migrations
- Blade templating
- Bootstrap 5 components & utilities
- Vanilla JavaScript & Fetch API
- AJAX requests tanpa jQuery
- Dark mode implementation
- Responsive design patterns
- Animation & transitions dengan CSS

## 💡 Tips Development

### Debugging
```bash
# Lihat log Laravel
tail -f storage/logs/laravel.log

# Clear cache jika ada masalah
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Database
```bash
# Reset database
php artisan migrate:fresh --seed

# Rollback migration
php artisan migrate:rollback
```

## 🚀 Fitur Tambahan yang Bisa Dikembangkan

- [ ] User Authentication
- [ ] Task Sharing & Collaboration
- [ ] Recurring Tasks
- [ ] Task Tags
- [ ] File Attachments
- [ ] Email Notifications
- [ ] Export to PDF/CSV
- [ ] Drag & Drop Reordering
- [ ] Subtasks
- [ ] Task Comments

## 📄 License

Open-source - Bebas digunakan untuk pembelajaran dan project pribadi.

---

Dibuat dengan ❤️ menggunakan Laravel & Bootstrap 5 (Tanpa NPM!)

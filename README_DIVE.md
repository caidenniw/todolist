# 🌊 Dive - Deep Ocean To-Do List

**"Dive into focused work."**

Aplikasi to-do list modern dengan tema ocean blue yang calming dan fokus. Dive adalah workspace yang tenang dan elegan untuk mengorganisir hari Anda dengan visual yang menenangkan seperti menyelam ke dalam laut yang dalam.

## ✨ Fitur Lengkap

### 🎨 UI/UX Modern
- **Ocean Blue Theme** - Gradient deep blue dengan animated bubbles
- **Glass Morphism** - Efek kaca blur yang modern dan elegan
- **Smooth Animations** - Transisi halus untuk pengalaman premium
- **Floating Bubbles** - Animasi gelembung yang menenangkan
- **Responsive Design** - Sempurna di semua perangkat
- **Clean Interface** - Minimalis dan fokus pada produktivitas

### 🚀 Fitur Fungsional Lengkap

#### ✅ Task Management
- **Quick Add** - Tambah task dengan cepat
- **Edit Task** - Edit task dengan modal yang elegant
- **Delete Task** - Hapus task dengan konfirmasi
- **Toggle Complete** - Tandai selesai/belum selesai dengan satu klik
- **Task Details** - Title, priority, category, deadline

#### 🎯 Priority System
- **High Priority** (🔴) - Untuk task urgent
- **Medium Priority** (🟡) - Untuk task normal
- **Low Priority** (🟢) - Untuk task tidak urgent

#### 📁 Categories
- **Personal** (👤) - Task pribadi
- **Work** (💼) - Task pekerjaan
- **Shopping** (🛒) - Daftar belanja
- **Health** (💪) - Task kesehatan & olahraga
- **Learning** (📚) - Task belajar & pengembangan diri

#### 🔍 Filter & Search
- **Filter Tabs** - All, Active, Done
- **Search Bar** - Cari task berdasarkan judul
- **Real-time Filtering** - Filter langsung saat mengetik

#### 📅 Deadline Management
- **Set Deadline** - Tambahkan tanggal deadline
- **Deadline Indicator** - Tampilkan "Today", "Tomorrow", atau tanggal
- **Overdue Warning** - Badge merah untuk task yang terlambat
- **Sort by Date** - Urutkan berdasarkan deadline

#### ⚡ Quick Actions
- **Clear Completed** - Hapus semua task yang sudah selesai
- **Complete All** - Tandai semua task sebagai selesai
- **Sort by Priority** - Urutkan berdasarkan prioritas
- **Sort by Date** - Urutkan berdasarkan deadline

#### 📊 Statistics
- **Total Tasks** - Jumlah semua task
- **Active Tasks** - Task yang belum selesai
- **Done Tasks** - Task yang sudah selesai
- **Real-time Update** - Stats update otomatis

#### 🎨 User Experience
- **AJAX Operations** - Seamless tanpa reload halaman
- **Instant Feedback** - Notifikasi untuk setiap aksi
- **Smooth Animations** - Hover effects dan transitions
- **Keyboard Friendly** - Enter to add task
- **Modal Edit** - Edit task dengan popup yang elegant

## 📦 Instalasi

### Requirements
- PHP 8.2+
- Composer
- SQLite (atau database lain)

### Setup

```bash
# 1. Install dependencies
composer install

# 2. Setup environment
cp .env.example .env
php artisan key:generate

# 3. Setup database
touch database/database.sqlite
php artisan migrate
php artisan db:seed  # Optional: data contoh

# 4. Jalankan server
php artisan serve
```

Buka browser: `http://localhost:8000`

**Tidak perlu NPM!** Semua assets via CDN.

## 🎯 Cara Penggunaan

### Menambah Task
1. Ketik task di input "What needs to get done?"
2. Pilih priority (High/Medium/Low)
3. (Optional) Set deadline
4. (Optional) Pilih category
5. Klik "Add Task" atau tekan Enter

### Edit Task
1. Klik icon pensil (✏️) di task
2. Edit title, deadline, category, atau priority
3. Klik "Save Changes"

### Menyelesaikan Task
- Klik pada task card atau checkbox untuk toggle complete/incomplete

### Menghapus Task
- Klik icon trash (🗑️) di sebelah kanan task

### Filter Tasks
- **All**: Tampilkan semua tasks
- **Active**: Hanya tasks yang belum selesai
- **Done**: Hanya tasks yang sudah selesai

### Search Tasks
- Ketik di search bar untuk mencari task berdasarkan judul

### Quick Actions
- **Clear Completed**: Hapus semua task yang sudah selesai
- **Complete All**: Tandai semua task sebagai selesai
- **Sort by Priority**: Urutkan High → Medium → Low
- **Sort by Date**: Urutkan berdasarkan deadline terdekat

## 🎨 Design System

### Color Palette (Ocean Blue Theme)
```css
Deep Ocean:     #0f172a (Dark Blue)
Ocean Depth:    #1e3a8a (Medium Blue)
Sky Blue:       #0ea5e9 (Bright Blue)
Cyan:           #06b6d4 (Accent)
White:          #ffffff (Text & Cards)

Priority Colors:
High:           #dc2626 (Red)
Medium:         #d97706 (Orange)
Low:            #16a34a (Green)
```

### Typography
- **Font**: Inter (Google Fonts)
- **Weights**: 300, 400, 500, 600, 700, 800

### Animations
- Floating bubbles background
- Smooth hover transitions
- Slide in animations for tasks
- Scale effects on buttons
- Fade in/out notifications

## 📁 Struktur File

```
app/
├── Http/Controllers/
│   └── TaskController.php      # CRUD operations
├── Models/
│   └── Task.php                # Model dengan scopes

database/
├── migrations/
│   └── 2024_01_01_000003_create_tasks_table.php
└── seeders/
    ├── DatabaseSeeder.php
    └── TaskSeeder.php

resources/
└── views/
    └── tasks/
        └── index.blade.php     # Main Dive UI

routes/
└── web.php                     # API routes
```

## 🔒 Security & Best Practices

- ✅ CSRF Protection pada semua form
- ✅ Input validation di controller
- ✅ XSS Protection dengan escapeHtml()
- ✅ Eloquent ORM untuk query safety
- ✅ RESTful API structure
- ✅ Responsive design
- ✅ Accessible UI elements

## 📝 API Endpoints

```
GET    /                      # Main page with tasks
POST   /tasks                 # Create new task
PUT    /tasks/{id}            # Update task
PATCH  /tasks/{id}/toggle     # Toggle task completion
DELETE /tasks/{id}            # Delete task
```

## 🎓 Teknologi yang Digunakan

- **Laravel 12** - PHP Framework
- **Bootstrap 5** - CSS Framework (via CDN)
- **Bootstrap Icons** - Icon library
- **Vanilla JavaScript** - No framework needed
- **Eloquent ORM** - Database management
- **SQLite** - Lightweight database
- **Google Fonts (Inter)** - Typography

## 💡 Tips Produktivitas

1. **Start Small** - Mulai dengan 3-5 tasks per hari
2. **Prioritize** - Gunakan High priority untuk tasks penting
3. **Set Deadlines** - Tambahkan deadline untuk accountability
4. **Use Categories** - Organisir tasks berdasarkan area hidup
5. **Review Daily** - Cek progress di akhir hari
6. **Clear Completed** - Bersihkan tasks yang sudah selesai
7. **Stay Focused** - Interface calming membantu fokus

## 🌊 Filosofi "Dive"

Dive bukan hanya to-do list biasa. Ini adalah workspace yang dirancang untuk:

- **Mengurangi Distraksi** - Warna ocean yang calming
- **Meningkatkan Fokus** - Interface minimalis
- **Visualisasi Progress** - Stats yang jelas
- **Pengalaman Menenangkan** - Seperti menyelam ke laut yang tenang

Ketika Anda "dive" ke dalam pekerjaan, Anda masuk ke zona fokus yang dalam. Interface yang tenang membantu Anda tetap di zona tersebut.

## 🚀 Fitur yang Sudah Ada

- ✅ Add, Edit, Delete tasks
- ✅ Toggle complete/incomplete
- ✅ Priority system (High, Medium, Low)
- ✅ Categories (Personal, Work, Shopping, Health, Learning)
- ✅ Deadline management
- ✅ Filter tabs (All, Active, Done)
- ✅ Search functionality
- ✅ Sort by priority
- ✅ Sort by date
- ✅ Clear completed tasks
- ✅ Mark all as complete
- ✅ Real-time statistics
- ✅ Smooth animations
- ✅ Responsive design
- ✅ Edit modal
- ✅ Overdue indicators

## 📄 License

Open-source - Bebas digunakan untuk pembelajaran dan project pribadi.

---

**Dive into focused work.** 🌊

Dibuat dengan ❤️ menggunakan Laravel & Bootstrap 5

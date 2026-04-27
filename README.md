# 🌊 Dive - Task Management App

Modern task management application with ocean-themed UI built with Laravel and Bootstrap 5.

## ✨ Features

- 🔐 User Authentication (Login/Register)
- ✅ Task Management (CRUD)
- 🎯 Priority System (High, Medium, Low)
- 📁 Categories (Work, Personal, Shopping, Health, Learning)
- 📅 Deadline Management
- 🔍 Search & Filter
- 📊 Statistics Dashboard
- 🎨 Modern Ocean Blue Theme
- 📱 Fully Responsive

## 🚀 Local Installation

### Requirements
- PHP 8.2+
- Composer
- MySQL/MariaDB

### Setup

```bash
# Clone repository
git clone <your-repo-url>
cd todolist

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todolist
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate --seed

# Start server
php artisan serve
```

Visit: `http://localhost:8000`

**Test Account:**
- Email: `test@example.com`
- Password: `password`

## 🚂 Deploy to Railway

### 1. Push to GitHub

```bash
git init
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin <your-github-repo>
git push -u origin main
```

### 2. Deploy on Railway

1. Go to [Railway.app](https://railway.app)
2. Click "New Project"
3. Select "Deploy from GitHub repo"
4. Choose your repository
5. Add MySQL database:
   - Click "New" → "Database" → "Add MySQL"
6. Configure environment variables:
   - Railway will auto-detect Laravel
   - Add these variables in your service settings:

```env
APP_NAME=Dive
APP_ENV=production
APP_KEY=base64:YOUR_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app.railway.app

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQL_HOST}}
DB_PORT=${{MySQL.MYSQL_PORT}}
DB_DATABASE=${{MySQL.MYSQL_DATABASE}}
DB_USERNAME=${{MySQL.MYSQL_USER}}
DB_PASSWORD=${{MySQL.MYSQL_PASSWORD}}

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

7. Deploy!

### 3. Generate APP_KEY

```bash
php artisan key:generate --show
```

Copy the output and paste to Railway's `APP_KEY` variable.

### 4. Run Migrations (First Deploy)

Railway will automatically run migrations on deploy via `nixpacks.toml`.

## 📝 Environment Variables for Railway

Required variables:
- `APP_NAME` - Application name
- `APP_ENV` - Set to `production`
- `APP_KEY` - Generate with `php artisan key:generate --show`
- `APP_DEBUG` - Set to `false` for production
- `APP_URL` - Your Railway app URL
- `DB_*` - Database credentials (auto-filled by Railway MySQL)

## 🎨 Tech Stack

- **Backend:** Laravel 12
- **Frontend:** Bootstrap 5, Vanilla JavaScript
- **Database:** MySQL
- **Hosting:** Railway (recommended)

## 📄 License

Open-source - Free to use for personal and educational projects.

---

**Dive into focused work.** 🌊

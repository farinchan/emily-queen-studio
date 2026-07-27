# 📸 Emily Queen Studio — Web Application Portofolio & Management System

[![Laravel 13](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Livewire 4](https://img.shields.io/badge/Livewire-4.x-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Tests](https://img.shields.io/badge/Tests-45%2F45%20Passed-10B981?style=for-the-badge&logo=phpunit&logoColor=white)](#-testing--quality-assurance)

**Emily Queen Studio** adalah aplikasi web portofolio, manajemen studio foto, dan sistem reservasi kelas atas (*luxury photography & cinematography studio*). Aplikasi ini dibangun dengan teknologi modern **PHP 8.3+**, **Laravel 13.x**, **Livewire 4.x**, Spatie Laravel Permission, visual page builder **GrapesJS**, serta sistem **SEO & Anti-Spam** berlapis.

---

## ✨ Fitur Utama

### 🌟 Front-End & Pengalaman Pengguna (Public UI)
- **Portofolio Editorial Mewah**: Halaman detail portofolio fotografi berbasis susunan galeri foto editorial 2-kolom, 3-kolom, 4-kolom, alur perjalanan (*timeline*), ulasan pengantin, dan profil fotografer.
- **Hero Slider & Dynamic Header**: Slider gambar hero berlayar penuh dengan transisi header transparan ke *solid white* secara otomatis saat di-scroll.
- **Floating WhatsApp Reservation Widget**: Widget melayang melingkar 64px di pojok kanan bawah (`bottom-14 right-6`) dilengkapi animasi lencana tooltip `"RESERVASI SEKARANG"` yang meluncur dari kanan ke kiri saat kursor di-hover.
- **Dynamic Contact Form & 3-Layer Anti-Spam**:
  - *Honeypot Trap* (`website_hp`)
  - *Time-Latch Bot Speed Check* (`form_time` < 2s)
  - *IP Rate Limiting* (Maksimal 3 submisi per 5 menit)
- **Dynamic Site Settings**: Alamat studio, nomor WhatsApp, akun sosial media (Instagram, Facebook, YouTube), serta Google Maps embed terintegrasi secara terpusat dari database.

### 🛠️ Admin Panel & Reaktif Livewire 4
- **Dasbor Analitis**: Statistik jumlah pengguna, portofolio, banner, pesan masuk, serta grafik pengunjung berdasarkan negara, kota, browser, perangkat, dan OS.
- **GrapesJS Visual Page Builder**: Editor visual drag-and-drop HTML untuk merancang dan mengedit halaman detail portofolio fotografi.
- **Manajemen Portofolio & Banner**: Fitur CRUD lengkap untuk galeri fotografi dan banner slide hero.
- **Manajemen Pesan Masuk (Inbox)**: Pengelolaan dan pemantauan pesan reservasi dari formulir kontak publik.
- **Instagram Feed Sync**: Otentikasi OAuth & sinkronisasi otomatis media Instagram resmi ke galeri situs.
- **Spatie Role & Permissions**: Akses kontrol otorisasi tingkat lanjut (Admin / User).

### 🚀 SEO, Sitemap & Social Media Optimization
- **Dynamic Meta Tags**: Tag `<title>`, `description`, `keywords`, `canonical`, `og:title`, `og:description`, `og:image`, `twitter:card`.
- **JSON-LD Schema.org**: Injeksi struktur data `PhotographyBusiness` & `LocalBusiness` untuk Google Knowledge Graph.
- **Dynamic XML Sitemap Generator**: Route `GET /sitemap.xml` yang mendaftar seluruh halaman statis dan halaman portofolio dinamis (`/photography/{slug}`).
- **Robots Guidelines**: Route & file `robots.txt` publik, serta proteksi tag `<meta name="robots" content="noindex, nofollow" />` pada seluruh area admin dan autentikasi.

---

## 💻 Cara Development (Petunjuk Pengembangan Lokal)

### 1. Persyaratan Sistem
- PHP `>= 8.3`
- Composer `>= 2.x`
- Database MySQL `>= 8.0` / MariaDB `>= 10.4`
- Extensions PHP: `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `curl`

### 2. Langkah-Langkah Instalasi Lokal

```bash
# 1. Clone repository
git clone https://github.com/farinchan/emily-queen-studio.git
cd emily-queen-studio

# 2. Install dependensi composer
composer install

# 3. Salin file lingkungan (.env) & generate Application Key
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi kredensial database pada file .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=emily_queen_studio
DB_USERNAME=root
DB_PASSWORD=

# 5. Jalankan migrasi basis data & seeder
php artisan migrate:fresh --seed

# 6. Buat tautan simbolik storage publik
php artisan storage:link

# 7. Jalankan server pengembangan lokal
php artisan serve
```

Aplikasi dapat diakses melalui browser di `http://127.0.0.1:8000`.

### 🔑 Kredensial Default Login Admin
- **URL Admin**: `http://127.0.0.1:8000/login`
- **Email**: `fajri@gariskode.com`
- **Password**: `password`

---

## 🧪 Testing & Quality Assurance

Project ini dilengkapi dengan *Automated Test Suite* berbasis PHPUnit / Laravel Feature & Unit Tests untuk menjamin kualitas kode.

```bash
# Jalankan seluruh pengujian unit & fitur
php artisan test
```

### Hasil Pengujian Saat Ini:
```text
  PASS  Tests\Feature\BannerCrudTest
  PASS  Tests\Feature\DashboardTest
  PASS  Tests\Feature\InboxContactTest
  PASS  Tests\Feature\InstagramFeedFeatureTest
  PASS  Tests\Feature\LoginTest
  PASS  Tests\Feature\PhotographyCrudTest
  PASS  Tests\Feature\ProfileTest
  PASS  Tests\Feature\SeoAndSitemapTest
  PASS  Tests\Feature\SettingTest

  Tests:    45 passed (133 assertions)
  Duration: 0.85s
```

---

## 🌐 Cara Production (Petunjuk Deploy Server Produksi)

> 💡 **Tanpa Perlu Node.js / `npm run build` di Produksi**: 
> Aplikasi ini menggunakan **Livewire 4** di mana skrip komponen reaktif diinjeksikan secara otomatis oleh Livewire, serta seluruh file CSS & JS publik (*front-end & admin*) sudah berstatus *pre-compiled* dan siap saji di dalam direktori `public/assets/` dan `public/back-assets/`. Oleh karena itu, **Anda TIDAK perlu menginstall Node.js atau menjalankan `npm run build` pada server produksi**.

### 1. Konfigurasi File `.env` Produksi
Ubah variabel lingkungan berikut pada server produksi:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.com

# Database Production
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_produksi
DB_USERNAME=user_database
DB_PASSWORD=password_database_kuat

# Session & Driver
SESSION_DRIVER=database
QUEUE_CONNECTION=database
```

### 2. Eksekusi Migrasi & Optimasi Cache Laravel

Jalankan perintah optimasi di server produksi untuk mempercepat *load time*:

```bash
# 1. Migrasi database produksi secara terpaksa
php artisan migrate --force

# 2. Seeding data awal jika basis data masih kosong
php artisan db:seed --class=DatabaseSeeder --force

# 3. Buat tautan storage jika belum ada
php artisan storage:link

# 4. Optimasi cache route, config, view, & event
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

Jika melakukan pembaruan kode di produksi, bersihkan dan perbarui cache dengan perintah:
```bash
php artisan optimize
```

### 3. Konfigurasi Web Server Nginx (Contoh Blok Vhost)

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name domain-anda.com www.domain-anda.com;
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name domain-anda.com www.domain-anda.com;

    root /var/www/emily-queen-studio/public;
    index index.php index.html;

    # SSL Certificates
    ssl_certificate /etc/letsencrypt/live/domain-anda.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/domain-anda.com/privkey.pem;

    charset utf-8;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header X-XSS-Protection "1; mode=block";

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 4. Izin Akses Direktori Server (*Permissions*)
Pastikan folder `storage` dan `bootstrap/cache` dapat ditulis oleh proses web server (`www-data`):

```bash
sudo chown -R www-data:www-data /var/www/emily-queen-studio
sudo chmod -R 775 /var/www/emily-queen-studio/storage
sudo chmod -R 775 /var/www/emily-queen-studio/bootstrap/cache
```

### 5. Konfigurasi Cron Job / Task Scheduler (Opsional)
Tambahkan entri cron job pada server produksi untuk mengeksekusi scheduler Laravel:

```bash
* * * * * cd /var/www/emily-queen-studio && php artisan schedule:run >> /dev/null 2>&1
```

---

## 📄 Lisensi

Project ini dilindungi dan dikembangkan secara eksklusif untuk **Emily Queen Studio**. Hak cipta dilindungi undang-undang.

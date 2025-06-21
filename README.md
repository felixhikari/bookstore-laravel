# 📚 Book Rating Web App

Proyek ini adalah aplikasi web sederhana berbasis Laravel yang memiliki tiga halaman utama:

1. `/book-list` – Menampilkan daftar buku.
2. `/rate-book` – Memberikan rating pada buku.
3. `/top-authors` – Menampilkan penulis terbaik berdasarkan rating yang valid.

---

## ✅ Requirements

Sebelum menginstall, pastikan kamu memiliki:

- PHP ^8.1
- Composer ^2.x
- Laravel ^10.x
- MySQL/MariaDB
- Node.js & NPM (opsional, jika kamu menggunakan asset frontend)

---

## 🌐 URL Halaman

Setelah server dijalankan (`php artisan serve`), berikut URL halaman utama:

- 📖 **List Book**: [http://127.0.0.1:8000/book-list](http://127.0.0.1:8000/book-list)
- ⭐ **Rate Book**: [http://127.0.0.1:8000/rate-book](http://127.0.0.1:8000/rate-book)
- 🏆 **Top Authors**: [http://127.0.0.1:8000/top-authors](http://127.0.0.1:8000/top-authors)

---

## ⚙️ Fitur

### 📖 `/book-list`
- Menampilkan semua buku
- Informasi: judul, kategori, rata-rata rating, dan total voter
- Diurutkan berdasarkan rata-rata rating dimulai dari tertinggi ke terendah

### ⭐ `/rate-book`
- Form untuk memberikan rating buku
- Hanya rating **lebih dari 5** yang dianggap valid

### 🏆 `/top-authors`
- Menampilkan **10 penulis teratas** berdasarkan jumlah voter (rating > 5)

---

## 🧱 Struktur Database

Tabel utama:
- `authors`: data penulis
- `books`: data buku (relasi ke penulis & kategori)
- `categories`: data kategori buku
- `ratings`: data rating yang diberikan ke buku

Relasi:
- `books.author_id` → `authors.id`
- `books.category_id` → `categories.id`
- `ratings.book_id` → `books.id`

---

## Catatan Penting
Seeding menggunakan Faker dengan detail berikut:
- 1000 fakes author
- 3000 fakes book category
- 100.000 fakes books
- 500.000 fakes rating

- Proses seeding membutuhkan waktu yang sangat lama dan memerlukan memory limit yang cukup atau lebih
- Durasi seeding menyesuaikan dengan perangkat, usahakan menggunakan perangkat dengan spesifikasi yang memadai dan mengalokasikan memory limit PHP yang cukup atau lebih.
- Lokasi PHP.ini umumnya ada di 
C:\xampp\php\php.ini

- Konfigurasi memory_limit di php.ini

``
memory_limit = 1G
``

contoh error

``
  PHP Fatal error:  Allowed memory size of 134217728 bytes exhausted (tried to allocate 20480 bytes) in D:\My Job\Apply\Timedoor\bookstore-laravel\vendor\laravel\framework\src\Illuminate\Database\Eloquent\Model.php on line 669
  PHP Fatal error:  Allowed memory size of 134217728 bytes exhausted (tried to allocate 20480 bytes) in D:\My Job\Apply\Timedoor\bookstore-laravel\vendor\symfony\error-handler\Error\FatalError.php on line 14
``

---

## 🚀 Langkah Instalasi

```bash
# 1. Clone repositori
git clone https://github.com/felixhikari/bookstore-laravel.git
cd bookstore-laravel

# 2. Install dependencies Laravel
composer install

# 3. Copy file .env dan generate key
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di file .env
# Contoh:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=bookstore
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Buat database baru di MySQL
# (contoh nama: bookstore)

# 6. Jalankan migrasi database
php artisan migrate

# 7. (Opsional) Jalankan seeder untuk data dummy
php artisan db:seed

# 8. Pastikan memory limit PHP cukup untuk seeding
php -d memory_limit=512M artisan db:seed

# 9. Pastikan memory limit PHP cukup untuk running server di PHP.ini
memory_limit = 1G

# 10. Hidupkan host mySQL di Xampp

# 11. Jalankan server lokal Laravel
php artisan serve

# 12. Akses aplikasi di browser:
# http://127.0.0.1:8000/book-list
# http://127.0.0.1:8000/rate-book
# http://127.0.0.1:8000/top-authors

---
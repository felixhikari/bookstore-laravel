# 📚 Book Rating Web App

Proyek ini adalah aplikasi web sederhana berbasis Laravel yang memiliki tiga halaman utama:

1. `/book-list` – Menampilkan daftar buku.
2. `/rate-book` – Memberikan rating pada buku.
3. `/top-authors` – Menampilkan penulis terbaik berdasarkan rating yang valid.

---

## 🌐 URL Halaman

Setelah server dijalankan (`php artisan serve`), berikut adalah URL masing-masing halaman:

- 📖 **List Book**: [http://127.0.0.1:8000/book-list](http://127.0.0.1:8000/book-list)
- ⭐ **Rate Book**: [http://127.0.0.1:8000/rate-book](http://127.0.0.1:8000/rate-book)
- 🏆 **Top Authors**: [http://127.0.0.1:8000/top-authors](http://127.0.0.1:8000/top-authors)

---

## ⚙️ Fitur

### 📖 /book-list
- Menampilkan daftar semua buku.
- Informasi: judul, kategori, rata-rata rating dan voter.
- Pengurutan berdasarkan rata-rata rating tertinggi 

### ⭐ /rate-book
- Form untuk memberikan rating buku.
- Rating valid hanya jika **lebih dari 5**.
- Disimpan ke dalam tabel `ratings`.

### 🏆 /top-authors
- Menampilkan **10 penulis teratas** berdasarkan jumlah voter (rating > 5).
- Diurutkan dari yang terbanyak.

---

## 🧱 Struktur Database

Tabel utama:

- `authors`: menyimpan data penulis
- `books`: menyimpan data buku (berelasi ke penulis dan kategori)
- `categories`: menyimpan data kategori
- `ratings`: menyimpan data rating buku

Relasi antar tabel:

- `books.author_id` → `authors.id`
- `books.category_id` → `categories.id`
- `ratings.book_id` → `books.id`

---

## 🚀 Cara Menjalankan Proyek

Untuk menjalankan aplikasi ini secara lokal, Mohon ikuti langkah-langkah berikut:

```bash
# 1 Clone repositori
git clone https://github.com/felixhikari/bookstore-laravel.git
cd bookstore-laravel

# 2 Install dependencies Laravel
composer install

# 3 Salin file .env dan generate key
cp .env.example .env
php artisan key:generate

# 4 Konfigurasi database di file .env
# Contoh:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=bookstore
# DB_USERNAME=root
# DB_PASSWORD=

# 5 Buat database kosong di MySQL dengan nama bookstore

# 6 Jalankan migrasi tabel
php artisan migrate

# 7 (Opsional) Jalankan seeder untuk data dummy
php artisan db:seed

# 8 Jalankan server lokal Laravel
php artisan serve

# 9 Akses aplikasi di browser:
# http://127.0.0.1:8000/book-list
# http://127.0.0.1:8000/rate-book
# http://127.0.0.1:8000/top-authors

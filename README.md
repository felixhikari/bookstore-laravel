# 📚 Book Rating Web App

Proyek ini adalah aplikasi web sederhana berbasis Laravel yang memiliki tiga halaman utama:

1. `/list-book` – Menampilkan daftar buku.
2. `/rate-book` – Memberikan rating pada buku.
3. `/top-authors` – Menampilkan penulis terbaik berdasarkan rating yang valid.

---

## 🌐 URL Halaman

Setelah server dijalankan (`php artisan serve`), berikut adalah URL masing-masing halaman:

- 📖 **List Book**: [http://localhost:8000/list-book](http://localhost:8000/list-book)
- ⭐ **Rate Book**: [http://localhost:8000/rate-book](http://localhost:8000/rate-book)
- 🏆 **Top Authors**: [http://localhost:8000/top-authors](http://localhost:8000/top-authors)

---

## ⚙️ Fitur

### 📖 /list-book
- Menampilkan daftar semua buku.
- Informasi: judul, kategori, dan penulis.

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

Untuk menjalankan aplikasi ini secara lokal, ikuti langkah-langkah berikut:

```bash
# Clone repositori
git clone https://github.com/username/nama-repo.git
cd nama-repo

# Install dependencies Laravel
composer install

# Salin file .env dan generate key
cp .env.example .env
php artisan key:generate

# Konfigurasi database di file .env
# Contoh:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=book_app
# DB_USERNAME=root
# DB_PASSWORD=

# Buat database kosong di MySQL dengan nama book_app

# Jalankan migrasi tabel
php artisan migrate

# (Opsional) Jalankan seeder untuk data dummy
php artisan db:seed

# Jalankan server lokal Laravel
php artisan serve

# Akses aplikasi di browser:
# http://localhost:8000/list-book
# http://localhost:8000/rate-book
# http://localhost:8000/top-authors

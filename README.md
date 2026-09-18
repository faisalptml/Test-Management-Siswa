# Management Siswa

Aplikasi CRUD pendataan siswa untuk lembaga **Latiseducation** dan **Tutorindonesia**, dibangun dengan Laravel.

## Fitur

- Login / Logout dengan session management
- CRUD data siswa (dropdown lembaga, NIS unik, validasi email, upload foto JPG/PNG max 100KB)
- Data siswa ditampilkan dengan DataTables (search NIS & Nama, filter lembaga, paginasi)
- Export Excel data siswa (mengikuti hasil pencarian/filter yang sedang aktif)
- Halaman Profile (nama, posisi, foto kandidat)

## Tech Stack

- Laravel 13
- MySQL
- Tailwind CSS
- DataTables
- maatwebsite/excel

## Instalasi (Lokal)

1. Clone repository ini dan masuk ke foldernya:
```bash
   git clone <url-repo>
   cd Test-Management-Siswa
```

2. Install dependency:
```bash
   composer install
   npm install
```

3. Copy file environment dan generate app key:
```bash
   cp .env.example .env
   php artisan key:generate
```

4. Buat database MySQL, misalnya `db_siswa`, lalu sesuaikan kredensial di `.env`:


5. Jalankan migration sekaligus seeder (membuat tabel + akun admin default + data lembaga):
```bash
   php artisan migrate --seed
```

6. Buat symbolic link storage supaya foto siswa bisa tampil:
```bash
   php artisan storage:link
```

7. Build asset front-end:
```bash
   npm run build
```

8. Jalankan server:
```bash
   php artisan serve
```

Buka `http://127.0.0.1:8000` di browser.

## Kredensial Login Default

| Email | Password |
|---|---|
| admin@example.com | admin1234 |

> Disarankan untuk mengganti password ini setelah login pertama kali di lingkungan production.

## Struktur Data Lembaga

Data lembaga (Latiseducation & Tutorindonesia) sudah otomatis terisi lewat `LembagaSeeder` saat menjalankan `php artisan migrate --seed`.
